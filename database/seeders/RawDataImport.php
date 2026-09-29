<?php

namespace Database\Seeders;

use App\Models\AssemblingMachine;
use App\Models\CraftingCategory;
use App\Models\Fluid;
use App\Models\Item;
use App\Models\Recipe;
use App\Models\Result;
use App\Models\Subgroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;
class RawDataImport extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //dd('test');
        ini_set('memory_limit', '512M');
        $str = file_get_contents(database_path('seeders/data-raw-dump.json'));
        $json = json_decode($str, true);
        /*
                foreach ($json as $key=> $root){
                    dump($key);
                }*/
        $assembling_machines = [];
        $fluid = [];
        $ingredients = [];
        $item = [];
        $recipe_categories = [];
        $subgroup = [];




/*
        foreach ($json as $type => $objects) {
            if ($type == "assembling-machine") {
                $assembling_machines = $objects;
            } elseif ($type == "fluid") {
                $fluid = $objects;
            } elseif ($type == "recipe") {
                $ingredients = $objects;
            } elseif ($type == "item") {
                $item = $objects;
            } elseif ($type == "recipe-category") {
                $recipe_categories = $objects;
            } elseif ($type == "item-subgroup") {
                $subgroup = $objects;
            }
        }*/




        $this ->item_loop($json,"item-with-entity-data",$item);
        $this ->item_loop($json,"repair-tool",$item);
        $this ->item_loop($json,"armor",$item);
        $this ->item_loop($json,"gun",$item);
        $this ->item_loop($json,"rail-planner",$item);
        $this ->item_loop($json,"capsule",$item);
        $this ->item_loop($json,"ammo",$item);
        $this ->item_loop($json,"module",$item);
        $this ->item_loop($json,"item",$item);
        $this ->item_loop($json,"space-platform-starter-pack",$item);
        $this ->item_loop($json,"blueprint",$item);
        $this ->item_loop($json,"blueprint-book",$item);
        $this ->item_loop($json,"deconstruction-item",$item);
        $this ->item_loop($json,"selection-tool",$item);
        $this ->item_loop($json,"tool",$item);
        $this ->item_loop($json,"upgrade-item",$item);
        foreach ($json['fluid'] as $name => $object) {
            $fluid[$name] = [
                "name" => $object["name"],
                "icon" => !empty($object["icon"]) ? $object["icon"] : null,
                "subgroup" => !empty($object["subgroup"]) ? $object["subgroup"] : null,
            ];
        }

        foreach ($json['recipe-category'] as $name => $object) {
            if ($object["type"] == "recipe-category") {
                $recipe_categories[$name] = [
                    "name" => $object["name"],
                ];
            }
        }
        foreach ($recipe_categories as $key => $object) {
            $model = CraftingCategory::create([
                "name" => $object["name"],
            ]);

            $recipe_categories[$key]["id"] = $model->id;
        }

        foreach ($json['recipe'] as $name => $object) {
            if ($object["type"] == "recipe") {
                $ingredients[$name] = [
                    "name" => $object["name"],
                    "ingredients" => !empty($object["ingredients"]) ? $object["ingredients"] : null,
                    "results" => !empty($object["results"]) ? $object["results"] : null,

                ];
            }
        }

        foreach ($json['assembling-machine'] as $name => $object) {
            $assembling_machines[$name] = [
                "name" => $object["name"],
                "icon" => !empty($object["icon"]) ? $object["icon"] : null,
                "next_upgrade" => !empty($object["next_upgrade"]) ? $object["next_upgrade"] : null,
            ];
        }
        foreach ($assembling_machines as $key => $object) {
            $model = AssemblingMachine::create([
                "name" => $object["name"],
                "icon" => $object["icon"],
                "next_upgrade" => $object["next_upgrade"],
                "stack_size" => !empty($object["stack_size"]) ? $object["stack_size"] : 1,
                "crafting_speed" => !empty($object["crafting_speed"]) ? $object["crafting_speed"] : 1,
            ]);

            $assembling_machines[$key]["id"] = $model->id;
        }

        foreach ($json['item-subgroup'] as $name => $object) {
            if ($object["type"] == "item-subgroup") {
                $subgroup[$name] = [
                    "name" => $object["name"],
                    "group" => $object["group"],
                ];
            }
        }
        foreach ($subgroup as $key => $object){
            $model = Subgroup::create($object);
            $subgroup[$key]["id"] = $model-> id;
        }
        foreach ($item as $key => $object){
            $object["subgroup_id"] = !empty($subgroup[$object["subgroup"]])? $subgroup[$object["subgroup"]]["id"] : null;
            unset($object["subgroup"]);
            $model = Item::create($object);
            $item[$key]["id"] = $model-> id;
        }
        foreach ($fluid as $key => $object){
            unset($object["subgroup"]);
            $model = Fluid::create($object);
            $fluid[$key]["id"] = $model-> id;
        }

        foreach ($ingredients as $key => $object) {

            $recipe = Recipe::create([
                "name" => $object["name"],
                "icon" => !empty($object["icon"]) ? $object["icon"] : null,
            ]);
            $ingredients[$key]["id"] = $recipe->id;

            foreach ($object["ingredients"] ?? [] as $ingredient) {
                if ($ingredient["type"] == "item") {
                    $model = Ingredient::create([
                        "recipe_id" => $recipe->id,
                        "object_id" => $item[$ingredient["name"]]["id"],
                        "object_type" => Item::class,
                        "amount" => $ingredient["amount"],
                        "fluidbox_multiplier" => null,

                    ]);
                }
                elseif ($ingredient["type"] == "fluid") {
                    $model = Ingredient::create([
                        "recipe_id" => $recipe->id,
                        "object_id" => $fluid[$ingredient["name"]]["id"],
                        "object_type" => Fluid::class,
                        "amount" => $ingredient["amount"],
                        "fluidbox_multiplier" => !empty($ingredient["fluidbox_multiplier"]) ?$ingredient["fluidbox_multiplier"] : null,
                    ]);
                }
            }
            foreach ($object["results"] ?? [] as $result) {
                if ($result["type"] == "item") {
                    Result::create([
                        "recipe_id" => $recipe->id,
                        "object_id" => $item[$result["name"]]["id"],
                        "object_type" => Item::class,
                        "amount" => $result["amount"],
                        "fluidbox_multiplier" => null,
                    ]);
                }
                elseif ($result["type"] == "fluid") {
                     Result::create([
                        "recipe_id" => $recipe->id,
                        "object_id" => $fluid[$result["name"]]["id"],
                        "object_type" => Fluid::class,
                        "amount" => $result["amount"],
                        "fluidbox_multiplier" => !empty($result["fluidbox_multiplier"]) ?$result["fluidbox_multiplier"] : null,
                    ]);
                }
            }


        }



    }
    protected function item_loop($input,$type, &$output){
        foreach ($input[$type] as $name => $object) {
            $output[$name] = [
                "name" => $object["name"],
                "type" => $object["type"],
                "icon" => !empty($object["icon"]) ? $object["icon"] : "",
                "subgroup" => !empty($object["subgroup"]) ? $object["subgroup"] : null,
                "stack_size" => !empty($object["stack_size"]) ? $object["stack_size"] : 1,
            ];
        }

    }
}




