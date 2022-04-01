<?php 

        require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php'));
        require_once 'Districts.php';
        require_once '../Taluka/Taluka.php';
        require_once '../LocalAreas/LocalAreas.php';
        $response = array();
        $result = array();

        function getTalukasOfDistrict($district_id){
            $result = array();
            if($talukas = Taluka::get_with_district_id($district_id)){
                foreach($talukas as $taluka){
                    array_push($result, $taluka);
                }
            }
            return $result;
        }

        function getLocalAreasOfTaluka($taluka_id){
            $result = array();
            if($localareas = LocalAreas::get_with_taluka_id($taluka_id)){
                foreach($localareas as $localarea){
                    array_push($result, $localarea);
                }
            }
            return $result;
        }
        
        if($districts = Districts::get()){

           foreach($districts as $district){
               $talukas_result = array();
               $talukas = getTalukasOfDistrict($district->id);

               foreach($talukas as $taluka){
                    $localareas_result = array();
                    $localareas = getLocalAreasOfTaluka($taluka->id);
                    
                    foreach($localareas as $localarea){
                        array_push($localareas_result, $localarea->name);
                    }
                    $talukas_result[$taluka->name] = $localareas_result;
               }
               $result[$district->name] = $talukas_result;
           }
        }
        $response['data'] = $result;
        echo json_encode($response);
?>