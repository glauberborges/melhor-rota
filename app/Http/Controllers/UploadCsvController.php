<?php

namespace App\Http\Controllers;

use App\CustomersModel;
use App\Services\GeoCoding\GeoCoding;
use function array_push;
use function count;
use function dd;
use function dump;
use function explode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function trim;
use function utf8_decode;
use function utf8_encode;

class UploadCsvController extends Controller
{
    public function process_csv(Request $request, GeoCoding $geoCoding)
    {

        $validator = Validator::make($request->all(), [
            'file'      => 'required|mimes:csv,txt',
            'adress_cd' => 'required',
        ],
        [
            'required'  => 'O :attribute é obrigátorio',
            'mimes'     => 'O :attribute deve ser do tipo: csv.',
        ]);

        $validator->setAttributeNames([
            "file"          => "arquivo",
            "adress_cd"     => "endereço",
        ]);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $csv = $request->file('file');

            $data_csv = [];
            foreach (file($csv) as $key => $line) {
                $line           = utf8_encode($line);
                $line_array     = explode(";",  $line);

                if(count($line_array) < 6){
                    return redirect()
                        ->back()
                        ->withErrors(["Ops..", "Parece que a linha <b><p>{$line}</p></b> está com formato inválido"]);
                }

                array_push($data_csv, $line_array);
            }

            unset($data_csv[0]);
            foreach ($data_csv as $dada) {
                $result_geocoding = $geoCoding->getAdress($dada[4]);

                if ($result_geocoding->status != "OK"){
                    $adress_utf8 = utf8_decode($dada[4]);
                    return redirect()
                        ->back()
                        ->withErrors(["Ops..", "O endereço <b><p>{$adress_utf8} </p></b> está com formato inválido ou incompleto"]);
                }

//                $geoCoding_parsing =  $geoCoding->parsing($result_geocoding->results[0]->address_components);
//
//                $customer = new CustomersModel();
//                $customer->name 	    = $dada[0];
//                $customer->email 	    = $dada[1];
//                $customer->birthDate 	= $dada[2];
//                $customer->cpf 	        = $dada[3];
//                $customer->street 	    = (isset($geoCoding_parsing['street']))         ? $geoCoding_parsing['street']        : " ";
//                $customer->number 	    = (isset($geoCoding_parsing['number']))         ? $geoCoding_parsing['number']        : " ";
//                $customer->complements 	= (isset($geoCoding_parsing['complements']))    ? $geoCoding_parsing['complements']   : " ";
//                $customer->neighborhood = (isset($geoCoding_parsing['neighborhood']))   ? $geoCoding_parsing['neighborhood']  : " ";
//                $customer->zip 	        = (isset($geoCoding_parsing['zip']))            ? $geoCoding_parsing['zip']           : " ";
//                $customer->city 	    = (isset($geoCoding_parsing['city']))           ? $geoCoding_parsing['city']          : " ";
//                $customer->states 	    = (isset($geoCoding_parsing['states']))         ? $geoCoding_parsing['states']        : " ";
//                $customer->lat 	        = $result_geocoding->results[0]->geometry->location->lat;
//                $customer->lng 	        = $result_geocoding->results[0]->geometry->location->lng;
//
//                $customer->save();

            }

            $delivery_routes = $geoCoding->deliveryRoutes(
                $request->input('adress_cd'),
                $data_csv
            );

            if (!$delivery_routes){
                return redirect()
                    ->back()
                    ->withErrors(["Ops..", "Aconteceu um erro inesperado ao calcular as melhores rotas, tente novamente."]);
            }

            return view('list',compact("data_csv"), compact("delivery_routes") );
        }
    }
}
