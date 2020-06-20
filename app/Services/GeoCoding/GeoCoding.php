<?php
namespace App\Services\GeoCoding;

use function array_push;
use function dd;
use function dump;
use function end;
use function env;
use function file_get_contents;
use function is_array;
use function json_decode;
use function trim;
use function urlencode;
use function utf8_encode;


// https://maps.googleapis.com/maps/api/directions/json?origin=Disneyland&destination=Miami&key=AIzaSyCIqywOrtInGBQ_ueqt43A5YwgzExpG5Hw

// https://maps.googleapis.com/maps/api/directions/json?origin=Disneyland&destination=Miami&key=AIzaSyCIqywOrtInGBQ_ueqt43A5YwgzExpG5Hw
// https://maps.googleapis.com/maps/api/directions/json?origin=Boston,MA&destination=Concord,MA&waypoints=via:Charlestown,MA|via:Lexington,MA|via:Concord,MA&departure_time=now&key=AIzaSyCIqywOrtInGBQ_ueqt43A5YwgzExpG5Hw
class GeoCoding
{
    private $adress;
    private $key;

    public function __construct()
    {
        $this->key = env('KEY_GEOCODING');
    }

    public function setAdress(string $adress)
    {
        $this->adress = urlencode(utf8_encode($adress));

        return $this;
    }

    public function get()
    {
        $result = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?&address={$this->adress}&key={$this->key}");
        return json_decode($result);

    }

    public function latitudeLongitude()
    {
        $result = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?&address={$this->adress}&key={$this->key}");

        if (json_decode($result)->status != "OK") return json_decode($result)->error_message;

        return json_decode($result)->results[0]->geometry;

    }

    public function parsing(array $address_components)
    {
        $result = [];
        foreach ($address_components as $address_component) {

            if(is_array($address_component->types)){
                foreach ($address_component->types as $type) {
                    switch ($type) {
                        case "route":
                            $result["street"] = $address_component->long_name;
                            break;
                        case "street_number":
                            $result["number"] = $address_component->long_name;
                            break;
                        case "subpremise":
                            $result["complements"] = $address_component->long_name;
                            break;
                        case "sublocality":
                            $result["neighborhood"] = $address_component->long_name;
                            break;
                        case "postal_code":
                            $result["zip"] = $address_component->long_name;
                            break;
                        case "administrative_area_level_1":
                            $result["states"] = $address_component->short_name;
                            break;
                        case "administrative_area_level_2":
                            $result["city"] = $address_component->long_name;
                            break;

                    }
               }
            }

        }

      return $result;
    }

    public function deliveryRoutes(string $origin, array $destinations)
    {
        foreach ($destinations as $key => $destination) {

            $url_build =  http_build_query([
                'origin'        => $origin,
                'destination'   => $destination[4],
                'key'           => $this->key,
            ]);

            $result = file_get_contents("https://maps.googleapis.com/maps/api/directions/json?{$url_build}");


            if(!isset(json_decode($result)->routes[0])){
                dd($destination[4],json_decode($result));
            }

            $distance = json_decode($result)->routes[0]->legs[0]->distance->value;

            array_push($destinations[$key], $distance);

       }

        usort($destinations, function($a, $b) {
            return $a[6] <=> $b[6];
        });


        $waypoints = "";
        foreach ($destinations as $dest_adress) {
           $waypoints .= "via:{$dest_adress[4]}|";

        }

        $url_build =  http_build_query([
            'origin'            => $origin,
            'destination'       => end($destinations)[4],
            'waypoints'         => $waypoints,
            'departure_time'    => 'now',
            'key'               => $this->key,
        ]);

        $result = file_get_contents("https://maps.googleapis.com/maps/api/directions/json?{$url_build}");

        return json_decode($result);
    }


}
