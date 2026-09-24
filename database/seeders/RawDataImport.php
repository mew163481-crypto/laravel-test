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
        $crafting_categories =[];
        $fluid =[];
        $ingredient =[];
        $item = [];
        $recipe =[];
        $subgroup =[];
        $surface_conditions =[];
        foreach ($json as $type => $objects) {
            if($type=="item"){
                $assembling_machines=$objects;
            }if($type=="item"){
                $crafting_categories=$objects;
            }if($type=="fluid"){
                $fluid=$objects;
            }if($type=="ingredient"){
                $ingredient=$objects;
            }if($type=="item"){
                $item=$objects;
            }if($type=="recipe"){
                $recipe=$objects;
            }if($type=="subgroup"){
                $subgroup=$objects;
            }if($type=="item"){
                $surface_conditions=$objects;
            }

            foreach ($objects as $name => $object) {

            }

        }
        dd($item);
    }
}
