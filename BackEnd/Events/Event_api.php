<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    require_once 'Event.php';
    require_once '../Districts/Districts.php';

    $response = array();
    $result = array();

    function getEventsForDistrict($district_id){
        $result = array();
        if($events = Event::get_events_for_district($district_id)){
            foreach($events as $event){
                array_push($result, $event);
            }
        }
        return $result;
    }

    if($districts = Districts::get()){
        foreach($districts as $district){
            $event_array = array();
            $events_result = array();
            $events = getEventsForDistrict($district->id);
    
            foreach($events as $event){
                $events_result['title'] = $event->event_title;
                $events_result['detail'] = $event->event_details;
                array_push($event_array, $events_result);
            }
          
            $result[$district->name] = $event_array;
        }
    }
    $response['data'] = $result;
    echo json_encode($response);

                 
?>