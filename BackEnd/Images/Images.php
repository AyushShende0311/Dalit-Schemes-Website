<?php
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Districts/Districts.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../LocalAreas/LocalAreas.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Taluka/Taluka.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Schemes/Schemes.php')));

    class Images{
        public static $table_name = "images";
        public $id;
        public $url;
        public $main_id;
        public $district_id;
        public $district_name;
        public $taluka_id;
        public $taluka_name;
        public $localarea_id;
        public $localarea_name;
        public $scheme_id;
        public $scheme_name;
        public $created_datetime;
        public $updated_datetime;
        public $created_by;
        public $updated_by;

        public static function save($main_id,$url){
            $table = Images::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $created_datetime = date("y/m/d H:i:s");
            $updated_datetime = date("y/m/d H:i:s");
            $updated_by = 'admin';
            $created_by = 'admin';

            $query = "
            insert into $table values(
            default, 
            '$url',
             $main_id,
            '$created_datetime', 
            '$updated_datetime', 
            '$created_by',
            '$updated_by'
            )";

            try{
                $conn->query($query);
                return 1;
            }catch(PDOException $e){
                echo $e->getMessage();
                return 0;
            }
            return 0;
        }

        public static function get(){
            $table = Images::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $result = array();

            $query = "select * from $table";
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = Images::load($row);
                    array_push($result, $model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $result;
        }

        public static function get_with_join(){
            $table = Images::$table_name;
            $table_district = Districts::$table_name;
            $table_taluka = Taluka::$table_name;
            $table_localarea = LocalAreas::$table_name;
            $table_schemes = Schemes::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $result = array();

            $query = 
                "select images.id,
                images.url, 
                district.name as 'district_name' ,
                taluka.name as 'taluka_name',
                localarea.name as 'localarea_name', 
                schemes.name as 'scheme_name',
                images.created_datetime, 
                images.updated_datetime,
                images.created_by,
                images.updated_by 
                from images inner join main on images.main_id=main.id
                inner join district on images.main_id=district.id
                inner join taluka on images.main_id=taluka.id
                inner join localarea on images.main_id=localarea.id
                inner join schemes on images.main_id=schemes.id";

            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = Images::load_with_join($row);
                    array_push($result, $model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $result;
        }
  
        public static function get_with_id($id){
            $table = Images::$table_name;
            $db = new Database();
            $conn = $db->connect();

            $query = "select * from $table where id=$id";
            try{
                $ans = $conn->query($query);
                if(count($rows = $ans->fetchAll())){
                    return Images::load($rows[0]);
                }
                else{
                    return 0;
                }             
            }catch(PDOException $e){
                return 0;
            }
        }

        public static function delete($id){
            $table = Images::$table_name;
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
            $object = new Images();
            $object->id = $row['id'];
            $object->url = $row['url'];
            $object->district_id = $row['district_id'];
            $object->taluka_id = $row['taluka_id'];
            $object->localarea_id = $row['localarea_id'];
            $object->scheme_id = $row['schemes_id'];
            $object->created_datetime = $row['created_datetime'];
            $object->updated_datetime = $row['updated_datetime'];
            $object->created_by = $row['created_by'];
            $object->updated_by = $row['updated_by'];
            return $object;
        }

        public static function load_with_join($row){
            $object = new Images();
            $object->id = $row['id'];
            $object->url = $row['url'];
            $object->district_name = $row['district_name'];
            $object->taluka_name = $row['taluka_name'];
            $object->localarea_name = $row['localarea_name'];
            $object->scheme_name = $row['scheme_name'];
            $object->created_datetime = $row['created_datetime'];
            $object->updated_datetime = $row['updated_datetime'];
            $object->created_by = $row['created_by'];
            $object->updated_by = $row['updated_by'];
            return $object;
        }
    }

?>