<?php
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Districts/Districts.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../LocalAreas/LocalAreas.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Taluka/Taluka.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Schemes/Schemes.php')));
    require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../DistrictWiseSchemes/DistrictWiseSchemes.php')));
    require_once "../DistrictWiseSchemes/DistrictWiseSchemes.php";

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
            echo $query;
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

        public static function get_with_main_id($main_id){
            $table = Images::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $result = array();

            $query = "select * from $table where main_id = $main_id";
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
            $table_main = DistrictWiseSchemes::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $result = array();

            $query = 
                "select images.id, images.url,district.name as 'district_name',
                taluka.name as 'taluka_name',
                localarea.name as 'localarea_name',
                schemes.name as 'scheme_name',
                main.created_datetime,
                main.updated_datetime,
                main.created_by,
                main.updated_by
                from  
                (
                    (
                        (
                            (
                                (main inner join images on main.id=images.main_id)
                                inner join district on main.district_id=district.id
                            )
                            inner join taluka on main.taluka_id=taluka.id
                        )
                        inner join localarea on main.localarea_id=localarea.id
                    )
                    inner join schemes on main.schemes_id=schemes.id
                )";

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

            if($model = Images::get_with_id($id)){
                $delete_url = $model->url;

                // genrating file path
                $root = str_replace("\\","/",$_SERVER['DOCUMENT_ROOT']);
                $real = str_replace("\\","/",realpath("../uploads"));
                $uploads_folder = str_replace($root,"",$real);
                $filename = str_replace($uploads_folder,"",$delete_url);

                // if file is already deleted
                if(!file_exists("../uploads/".$filename)){
                    echo "deleted without record";
                    try{
                        $conn->query($query);
                        return 1;
                    }
                    catch(PDOException $e){
                        
                        return 0;
                    }
                }
                if(unlink("../uploads".$filename)){
                    echo "deleted";
                    try{
                        $conn->query($query);
                        return 1;
                    }
                    catch(PDOException $e){
                        
                        return 0;
                    }
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
           
        }

        public static function delete_with_main_id($main_id){
            $table = Images::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $query = "delete from $table where main_id=$main_id";
            if($models = Images::get_with_main_id($main_id)){
                foreach($models as $model){
                    Images::delete($model->id);
                }
              
            }else{
                echo "erroe im get_with_main_id";
                return 0;
            }
           
        }

        // public static function get_with_taluka_id($id){
        //     $table = DistrictWiseSchemes::$table_name;
        //     $table_name = Images::$table_name;
        //     $db = new Database();
        //     $conn = $db->connect();
        //     $query = 
        //         "select $table.id, 
        //         $table.district_id, 
        //         $table.taluka_id, 
        //         $table.schemes_id, 
        //         $table.localarea_id, 
        //         $table_name.url, 
        //         $table.created_datetime, 
        //         $table.updated_datetime,
        //         $table.created_by, 
        //         $table.updated_by
        //         from $table 
        //         inner join $table_name 
        //         on $table.id=$table_name.main_id";
            
        //     $result = array();
        //     try{
        //         $ans = $conn->query($query);
        //         while($row = $ans->fetch()){
        //             $model = DistrictWiseSchemes::load_with_join_image($row);
        //             array_push($result,$model);
        //         }
        //     }catch(PDOException $e){
        //         echo $e->getMessage();
        //     }       
        //     return $result;
        // }

        public static function load($row){
            $object = new Images();
            $object->id = $row['id'];
            $object->url = $row['url'];
            $object->main_id = $row['main_id'];
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

        public static function load_with_images($row){
            $object = new Images();
            $object->id = $row['id'];
            $object->scheme_id = $row['scheme_id'];
            $object->url = $row['url'];
            return $object;
        }

        public static function get_images_of_schemes($scheme_id){ 
            $table = Images::$table_name;
            $db = new Database();
            $conn = $db->connect();
            $result = array();

            $query = "
            select schemes.id as 'scheme_id',
            images.url
            from 
                (
                    (main inner join schemes on main.schemes_id=schemes.id)
                    inner join images on images.main_id=main.id
                );";
            try{
                $ans = $conn->query($query);
                while($row = $ans->fetch()){
                    $model = Images::load_with_images($row);
                    array_push($result,$model->$scheme_id);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            return $result;

        }
    }

?>