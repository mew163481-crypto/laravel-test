<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RawDataImport extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //dd('test');
        ini_set('memory_limit', '512M');
        $str = file_get_contents(database_path( 'seeders/data-raw-dump.json' ));
        $json = json_decode($str, true);
/*
        foreach ($json as $key=> $root){
            dump($key);
        }*/
        $assembling_machines =[];
        $fluid =[];
        $ingredients =[];
        $item =[];
        $recipe_categories =[];
        $subgroup =[];
        $surface_conditions =[];
        $results=[];

        foreach ($json as $type => $objects){


            if ($type =="assembling-machine"){
                $assembling_machines =$objects;
            }
            if ($type =="fluid"){
                $fluid =$objects;
            }
            if ($type =="recipe"){
                $ingredients =$objects;
            }
            if ($type =="item") {
                $item =$objects;
            }
            if ($type =="recipe-category"){
                $recipe_categories =$objects;
            }
            if ($type =="item-subgroup"){
                $subgroup =$objects;
            }
            if ($type =="surface-condition"){
                $surface_conditions =$objects;
            }

        }
        foreach ($item as $name => $object) {

            if(isset($object["subgroup"])&&$object["subgroup"]!="parameters"){

                $item[$name] = [
                    "type" => $object["type"],
                    "name" => $object["name"],
                    "icon" => isset($object["icon"]) ? $object["icon"] : null,
                    "subgroup"=> isset($object["subgroup"]) ? $object["subgroup"] : null,
                ];
            }
            if($object["type"]=="fluid" && $object["subgroup"]=="fluid" ){
                $fluid[$name] = [
                    "type" => $object["type"],
                    "name" => $object["name"],
                    "icon" => isset($object["icon"]) ? $object["icon"] : null,
                    "subgroup"=> $object["subgroup"],
                ];
            }
            if($object["type"]=="recipe-category"){
                $recipe_categories[$name] = [
                    "name" => $object["name"],
                ];
            }

            if($object["type"]=="recipe"){
                $ingredients[$name] = [
                    "type" => $object["type"],
                    "name" => $object["name"],
                    "ingredients" => $object["ingredients"],
                    "results"=> $object["results"],
                ];
            }
            if($object["type"]=="assembling-machine"){
                $assembling_machines[$name] = [
                    "type" => $object["type"],
                    "name" => $object["name"],
                    "icon" => isset($object["icon"]) ? $object["icon"] : null,
                    "next_upgrade"=>$object["next_upgrade"],
                ];
            }
            if($object["type"]=="item-subgroup"){
                $subgroup[$name] = [
                    "type" => $object["type"],
                    "name" => $object["name"],
                    "group" => $object["group"],
                ];
            }

        }
        foreach ($item as $name => $object) {

        }
        dump($recipe_categories);
    }

}
