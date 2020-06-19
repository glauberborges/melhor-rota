<?php
namespace App\Services\GeoCoding;

use function dd;
use function dump;
use function env;
use function file_get_contents;
use function is_array;
use function json_decode;
use function trim;
use function urlencode;
use function utf8_encode;

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

    // https://developers.google.com/maps/documentation/geocoding/intro#ReverseGeocoding
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

}
