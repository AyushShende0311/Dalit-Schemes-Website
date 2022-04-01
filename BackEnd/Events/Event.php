<?php
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php'));
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Users/Session.php'));
    require_once str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Districts/Districts.php'));

    class Event{
        public static $table_name = "event";
        public $id;
        public $event_title;
        public $event_details;
        public $district_id;
        public $district_name;
        public $created_datetime;
        public $updated_datetime;
        public $created_by;
        public $updated_by;

        public static function save($name, $district_id, $event_title, $event_details){
            $table = Event::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $curent_username = Session::getUserName();
            $created_datetime = date("y/m/d H:i:s");
            $updated_datetime = date("y/m/d H:i:s");
            $updated_by = $curent_username;
            $created_by = $curent_username;

            $query = "
            insert into $table values(
            default, 
            '$event_title',
            '$event_details', 
            $district_id,
            '$created_datetime', 
            '$updated_datetime', 
            '$created_by',
            '$updated_by'
            )";

            try{
                $conn->query($query);
                    return 1;
                }catch(PDOException $e){
                    return 0;
                }
            
                return 0;
        }

        public static function update($model){
            $table = Event::$table_name;
            $model->updated_by = Session::getUserName();;
            $model->updated_datetime = date("y/m/d H:i:s");
            $query = " update $table
            set 
            event_title='$model->event_title',
            event_details = '$model->event_details', 
            district_id = $model->district_id,
            updated_by='$model->updated_by', 
            updated_datetime='$model->updated_datetime' 
            where id=$model->id ";

            $db = new Database();
            $conn = $db->connect();

            try{
                $conn->query($query);
                return 1;
            }
            catch(PDOException $e){
                return 0;
            }
        }

        public static function get(){
            $table = Event::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $result = array();

            $query = "select * from $table";
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = Event::load($row);
                    array_push($result,$model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        
            return $result;
        }

        public static function get_with_id($id){
            $table = Event::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $query = "select * from $table where id=$id";
            try{
                $ans = $conn->query($query);
                if(count($rows = $ans->fetchAll())){
                    return Event::load($rows[0]);
                }
                else{
                    return 0;
                }
                
            }catch(PDOException $e){
                return 0;
            }
        }

        public static function get_with_join(){
            $table = Event::$table_name;
            $table_district = Districts::$table_name;

            $db = new Database();
            $conn = $db->connect();

            $result = array();
            
            $query = "select 
            $table.id, 
            $table.event_title as 'event_title',
            $table.event_details as 'event_details', 
            $table_district.name as 'district_name',
            $table.district_id , 
            $table.created_by, 
            $table.updated_by, 
            $table.created_datetime, 
            $table.updated_datetime
            from $table inner join $table_district 
            where $table.district_id=$table_district.id
            order by $table.id";
            
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = Event::load_with_join($row);
                    array_push($result,$model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $result;
        }

        public static function delete($id){
            $table = Event::$table_name;
            $db = new Database();
            $conn = $db->connect();

            $query = "delete from $table where id=$id";
            
            try{
                $conn->query($query);
                return 1;
            }
            catch(PDOException $e){
                return 0;
            }
        }

        public static function load($row){
            $object = new Event();
            $object->id = $row['id'];
            $object->event_title = $row['event_title'];
            $object->event_details = $row['event_details'];
            $object->district_id = $row['district_id'];
            $object->created_datetime = $row['created_datetime'];
            $object->updated_datetime = $row['updated_datetime'];
            $object->created_by = $row['created_by'];
            $object->updated_by = $row['updated_by'];
            return $object;
        }

        public static function load_with_join($row){
            $object = new Event();
            $object->id = $row['id'];
            $object->event_title = $row['event_title'];
            $object->event_details = $row['event_details'];
            $object->district_id = $row['district_id'];
            $object->district_name = $row['district_name'];
            $object->created_datetime = $row['created_datetime'];
            $object->updated_datetime = $row['updated_datetime'];
            $object->created_by = $row['created_by'];
            $object->updated_by = $row['updated_by'];
            return $object;
        }

        public static function get_events_for_district($id){
            $table = Event::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $query = "select * from $table where district_id = $id";
            $result = array();
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = Event::load($row);
                    array_push($result,$model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        
            return $result;
        }

    }
?>
