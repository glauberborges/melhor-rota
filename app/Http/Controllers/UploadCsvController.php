<?php

namespace App\Http\Controllers;

use App\CustomersModel;
use App\Services\GeoCoding\GeoCoding;
use function array_push;
use function dd;
use function dump;
use function explode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function trim;
use function utf8_encode;

class UploadCsvController extends Controller
{
    public function process_csv(Request $request, GeoCoding $geoCoding)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt'
        ],
        [
            'required'  => 'O :attribute é obrigátorio',
            'mimes'     => 'O :attribute deve ser do tipo: csv.',
        ]);

        $validator->setAttributeNames([
            "file"  => "arquivo",
        ]);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $csv = $request->file('file');

            $data_csv = [];
            foreach (file($csv) as $line) {
                $line = utf8_encode($line);
                array_push($data_csv, explode(";",  $line));
            }


            unset($data_csv[0]);
            foreach ($data_csv as $dada) {

                $result_geocoding = $geoCoding->setAdress($dada[4])->get();

                if ($result_geocoding->status == "OK"){
                    $geoCoding_parsing =  $geoCoding->parsing($result_geocoding->results[0]->address_components);
                }else{
                    dd("O endereço {$dada[4]} é inválido");
                }

                $customer = new CustomersModel();
                $customer->name 	    = $dada[0];
                $customer->email 	    = $dada[1];
                $customer->birthDate 	= $dada[2];
                $customer->cpf 	        = $dada[3];
                $customer->street 	    = (isset($geoCoding_parsing['street']))         ? $geoCoding_parsing['street']        : " ";
                $customer->number 	    = (isset($geoCoding_parsing['number']))         ? $geoCoding_parsing['number']        : " ";
                $customer->complements 	= (isset($geoCoding_parsing['complements']))    ? $geoCoding_parsing['complements']   : " ";
                $customer->neighborhood = (isset($geoCoding_parsing['neighborhood']))   ? $geoCoding_parsing['neighborhood']  : " ";
                $customer->zip 	        = (isset($geoCoding_parsing['zip']))            ? $geoCoding_parsing['zip']           : " ";
                $customer->city 	    = (isset($geoCoding_parsing['city']))           ? $geoCoding_parsing['city']          : " ";
                $customer->states 	    = (isset($geoCoding_parsing['states']))         ? $geoCoding_parsing['states']        : " ";
                $customer->lat 	        = $result_geocoding->results[0]->geometry->location->lat;
                $customer->lng 	        = $result_geocoding->results[0]->geometry->location->lng;

                $customer->save();

            }







            dd(
                $result_geocoding
            );

        }
    }
}
