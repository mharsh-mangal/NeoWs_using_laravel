<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Monolog\Handler\IFTTTHandler;
use Symfony\Component\Console\Input\Input;
use Symfony\Contracts\Service\Attribute\Required;

class AsteroidController extends Controller
{

    public function index(){
        return view('asteroid');
    }

    public function formData(Request $data){
        

        $data->validate([
            "from"=> 'required',
            "to"=>'required'
            ]);

        $from= $data->input('from'); //get from info from form
        $to= $data->input('to'); //get to info from form

        //fetching data from api
        //this fetches in json format
        $ast_data= Http::get("https://api.nasa.gov/neo/rest/v1/feed?start_date=$from&end_date=$to&api_key=DEMO_KEY");
        
        //echo ($ast_data['element_count']); //-> from this we know that we have to put constraints on date too otherwise data will not be fetched due to bad_request error


        $data_asteroid= json_decode($ast_data, true);
        
        foreach ($data_asteroid['near_earth_objects'] as $key => $value) {
            $datewise_astdata[$key] = $value; //gives array of data with date as key
            //echo "<pre>";
            //print_r($datewise_astdata);
            ksort($datewise_astdata);
            
            //running a foreach loop once more to get all the asteroid data into one array as opposed to getting it in the date array
            foreach ($datewise_astdata[$key] as $value) {
                $asteroid_array[] = $value;
                //echo "<pre>";
                //print_r($asteroid_array);
            }
        }

       

        //now we have to fetch the fastest asteroid, closest asteroid and the average asteroid size along with thier ids
       foreach ($asteroid_array as $asteroid_array_filter) {
           
           foreach ($asteroid_array_filter['close_approach_data'] as $ast_details) {
               //gets the velocity array
               foreach ($ast_details['relative_velocity'] as $asr_velocities =>$value) {
                   if ($asr_velocities=='kilometers_per_hour') {
                       $velocities_kmph[]=$value; 
                    }
               }

               //gets miss distance
               foreach ($ast_details['miss_distance'] as $key => $value) {
                   if ($key=='kilometers') {
                       $close_asteroid[]=$value;
                   }
               }
           }
           //get the average size of individual asteroid
           foreach ($asteroid_array_filter['estimated_diameter']['kilometers'] as $sizeDetails=>$value) {
                if ($sizeDetails=='estimated_diameter_min') {
                    $sizes[]=$value;
                }                
           }

           foreach ($asteroid_array_filter['estimated_diameter']['kilometers'] as $sizeDetails=>$value) {
                if ($sizeDetails=='estimated_diameter_max') {
                    $sizes_max[]=$value;
                }
            }
            $sum=array_sum($sizes);
            $average=((array_sum($sizes_max)+$sum)/(2*$ast_data['element_count']));
           
           $asteroid_id[]=$asteroid_array_filter['neo_reference_id']; //gets the id array seperately because we need it multiple times            
       }
       $asteroid_number=array_map("count", $datewise_astdata);
       $asteroid_dates = array_keys($asteroid_number);
       $asteroidfinalNumber=array_values($asteroid_number);
       $asteroid_dates= implode("," , $asteroid_dates);
       $asteroid_dates= explode("," , $asteroid_dates);
       

       

       //print_r($velocities_kmph);
       //print_r($asteroid_id);
       $final_distance = array_combine($close_asteroid, $asteroid_id); //gets array to display miss distance with id
       $final_velocity= array_combine($velocities_kmph, $asteroid_id); //gets array to display the id as well as teh velocity 
       krsort($final_velocity);//sort array
       ksort($final_distance);//sort array

       $velocity=array_key_first($final_velocity); //gets teh velocity of the asteroid

       $distanceFE=array_key_first($final_distance); //gets the distance form earth

       $fastest_ast = "The fastest asteroid in the following time period has the id " . $final_velocity[$velocity] . " with the speed of " . $velocity. " kmph";
       $closest_ast = "The closest asteroid in the following time period has the id " . $final_distance[$distanceFE] . " with the distance of " . $distanceFE. " kms" ;
       $average_size = "The average size of asteroids between the time period is " . $average . " kms";   


       return view('results' , compact('fastest_ast', 'closest_ast' , 'average_size' , 'asteroid_dates' , 'asteroidfinalNumber'));
    }
}
