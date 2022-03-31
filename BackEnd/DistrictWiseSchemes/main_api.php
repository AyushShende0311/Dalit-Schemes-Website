<?php 
    
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    require_once '../Schemes/Schemes.php';
    require_once '../Images/Images.php';
    require_once '../Taluka/Taluka.php';
    require_once '../Districts/Districts.php';
    require_once 'DistrictWiseSchemes.php';

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

    function getTalukaOfScheme($scheme_id,$district_id){
        $result = array();
        if($talukas = DistrictWiseSchemes::get_taluka_from_scheme($scheme_id,$district_id)){
            foreach($talukas as $taluka){
                array_push($result, $taluka);
            }
        }
        return $result;
    }

    function getImagesOfTaluka($district_id, $scheme_id,$taluka_id){
        
        if($images = DistrictWiseSchemes::get_images_of_taluka($district_id, $scheme_id,$taluka_id)){
            return $images;
        }
        return array();
    }

    if($districts = Districts::get()){
        foreach($districts as $district){
            $schemes_result = array();
            $schemes = getSchemesForDistrict($district->id);

            foreach($schemes as $scheme){
                $talukas_result = array();
                $talukas = getTalukaOfScheme($scheme->id, $district->id);
                foreach($talukas as $taluka){
                    $images_result = array();
                    $images = getImagesOfTaluka($district->id,$scheme->id,$taluka->id);
                    $talukas_result[$taluka->name] = $images;
                }
                $schemes_result[$scheme->name] = $talukas_result;
            }
            $result[$district->name] = $schemes_result;
        }
    }
    $response['data'] = $result;
    echo json_encode($response);
?>
