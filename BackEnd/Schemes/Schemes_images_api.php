<?php 
    
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    require_once 'Schemes.php';
    require_once '../Images/Images.php';
    require_once '../Taluka/Taluka.php';
    require_once '../Districts/Districts.php';

    $response = array();
    $result = array();
    $schemes = Schemes::get();
    $taluka = Taluka::get();
    $image = Images::get();

    function getSchemesForDistrict($district_id){
        $result = array();
        if($schemes = DistrictWiseSchemes::get_schemes_for_district($district_id)){
            foreach($schemes as $scheme){
                array_push($result, $scheme);
            }
        }
        return $result;
    }

    function getTalukaOfScheme($scheme_id){
        $result = array();
        if($talukas = Taluka::get_with_scheme_id($scheme_id)){
            foreach($talukas as $taluka){
                array_push($result, $taluka);
            }
        }
        return $result;
    }

    function getImagesOfTaluka($taluka_id){
        $result = array();
        if($images = Images::get_with_taluka_id($taluka_id)){
            foreach($images as $image){
                array_push($result, $image);
            }
        }
        return $result;
    }

    if($districts = Districts::get()){
        foreach($districts as $district){
            $schemes_result = array();
            $schemes = getSchemesForDistrict($district->id);

            foreach($schemes as $scheme){
                $talukas_result = array();
                // $talukas = getTalukaOfScheme($scheme->id);

                // foreach($talukas as $taluka){
                //     $images_result = array();
                //     $images = getImagesOfTaluka($taluka->id);

                //     foreach($images as $image){
                //         array_push($images_result, $image->url);
                //     }
                //     $talukas_result[$taluka->name] = $images_result;
                // }
                // $schemes_result[$scheme->name] = $talukas_result;
            }
            // $result[$district->name] = $schemes_result;
        }
    }
    // $response['data'] = $result;
    // echo json_encode($response);
?>
