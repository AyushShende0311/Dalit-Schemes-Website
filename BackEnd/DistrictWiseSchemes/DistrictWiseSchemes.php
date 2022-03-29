<?php
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Districts/Districts.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../LocalAreas/LocalAreas.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Taluka/Taluka.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Schemes/Schemes.php')));

    class DistrictWiseSchemes{
        public static $table_name = "main";
        public $id;
        public $name;
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

        public static function save($district_id,$taluka_id,$localarea_id,$scheme_id){
            $table = DistrictWiseSchemes::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $created_datetime = date("y/m/d H:i:s");
            $updated_datetime = date("y/m/d H:i:s");
            $updated_by = 'admin';
            $created_by = 'admin';

            $query = "
            insert into $table values(
            default, 
             $district_id,
             $taluka_id,
             $scheme_id,
             $localarea_id,
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

        public static function update($model){
            $table = DistrictWiseSchemes::$table_name;
            $model->updated_by = 'admin';
            $model->updated_datetime = date("y/m/d H:i:s");
            $query = " update $table
            set 
            district_id = $model->district_id,
            taluka_id = $model->taluka_id,
            localarea_id = $model->localarea_id,
            schemes_id = $model->scheme_id,
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
                echo $e->getMessage();
                return 0;
            }
        }

        public static function get(){
            $table = DistrictWiseSchemes::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $result = array();

            $query = "select * from $table";
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = DistrictWiseSchemes::load($row);
                    array_push($result, $model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $result;
        }

        public static function get_with_join(){
            $table = DistrictWiseSchemes::$table_name;
            $table_district = Districts::$table_name;
            $table_taluka = Taluka::$table_name;
            $table_localarea = LocalAreas::$table_name;
            $table_schemes = Schemes::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $result = array();

            $query = "select $table.id,
            $table.district_id,
            $table_district.name as 'district_name', 
            $table.taluka_id,
            $table_taluka.name as 'taluka_name',
            $table.localarea_id,
            $table_localarea.name as 'localarea_name',
            $table.schemes_id,
            $table_schemes.name as 'scheme_name', 
            $table.created_datetime,
            $table.updated_datetime,
            $table.created_by,
            $table.updated_by 
            from $table 
            inner join $table_district on $table.district_id=$table_district.id 
            inner join $table_taluka on $table.taluka_id=$table_taluka.id
            inner join $table_schemes on $table.schemes_id=$table_schemes.id
            inner join $table_localarea on $table.localarea_id=$table_localarea.id
            order by $table.id";

            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = DistrictWiseSchemes::load_with_join($row);
                    array_push($result, $model);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $result;
        }
  
        public static function get_with_id($id){
            $table = DistrictWiseSchemes::$table_name;
            $db = new Database();
            $conn = $db->connect();

            $query = "select * from $table where id=$id";
            try{
                $ans = $conn->query($query);
                if(count($rows = $ans->fetchAll())){
                    return DistrictWiseSchemes::load($rows[0]);
                }
                else{
                    return 0;
                }             
            }catch(PDOException $e){
                return 0;
            }
        }

        public static function delete($id){
            $table = DistrictWiseSchemes::$table_name;
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
            $object = new DistrictWiseSchemes();
            $object->id = $row['id'];
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
            $object = new DistrictWiseSchemes();
            $object->id = $row['id'];
            $object->district_id = $row['district_id'];
            $object->district_name = $row['district_name'];
            $object->taluka_id = $row['taluka_id'];
            $object->taluka_name = $row['taluka_name'];
            $object->localarea_id = $row['localarea_id'];
            $object->localarea_name = $row['localarea_name'];
            $object->scheme_id = $row['schemes_id'];
            $object->scheme_name = $row['scheme_name'];
            $object->created_datetime = $row['created_datetime'];
            $object->updated_datetime = $row['updated_datetime'];
            $object->created_by = $row['created_by'];
            $object->updated_by = $row['updated_by'];
            return $object;
        }
    }

?>