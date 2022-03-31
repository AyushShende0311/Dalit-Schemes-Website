<?php
  require_once 'DistrictWiseSchemes.php';
  require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Images/Images.php')));
  require_once $_SERVER['DOCUMENT_ROOT'].(str_replace($_SERVER['DOCUMENT_ROOT'], " ", realpath('../Database.php')));
  session_start();
?>

   
    
<?php
    $target_dir = "../uploads/";
    $allowed_types = array("jpeg",'jpg','png',"gif");

    if(isset($_POST['submit'])){
        $district_id = $_POST['district'];
        $taluka_id = $_POST['taluka'];
        $localarea_id = $_POST['area'];
        $scheme_id = $_POST['scheme'];
        if(DistrictWiseSchemes::save($district_id,$taluka_id,$localarea_id,$scheme_id)){
<<<<<<< HEAD
            
=======

            $main_id = DistrictWiseSchemes::get_last_id();
            
            //upload files
>>>>>>> f18afbe5bc2937f324216c4463ce68ad3b032be5
            if(!empty(array_filter($_FILES['files']['name']))){

                foreach($_FILES['files']['tmp_name'] as $key=>$value){
                    $file_tmpname = $_FILES['files']['tmp_name'][$key];
                    $file_name = $_FILES['files']['name'][$key];
                    $file_size = $_FILES['files']['size'][$key];
                    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                    $filepath = $target_dir.$file_name;

                    if(in_array(strtolower($file_ext), $allowed_types)){
                        if(file_exists($filepath)){
                            $filepath = $target_dir.time().$file_name;
                            $file_name = time().$file_name;

                            if(move_uploaded_file($file_tmpname, $filepath)){
                                $root = str_replace("\\","/",$_SERVER['DOCUMENT_ROOT']);
                                $real = str_replace( "\\","/",realpath('../uploads'));
                                $fileUrl = (str_replace($root, "", $real))."/".$file_name;
                                
                                if(Images::save($main_id,$fileUrl)){
                                    $_SESSION['message'] = "Record has been saved ";
                                    $_SESSION['msg_type'] = "success";
                                }else{
                                    DistrictWiseSchemes::delete($main_id);
                                    $_SESSION['message'] = $file_name." Something went Wrong!Image cannot be added";
                                    $_SESSION['msg_type'] = "danger";
                                    break;
                                }
                    
                            }else{
                                DistrictWiseSchemes::delete($main_id);
                                $_SESSION['message'] = $file_name." File Not uploaded";
                                $_SESSION['msg_type'] = "danger";
                                break;
                            }
                        }else{
                            if(move_uploaded_file($file_tmpname, $filepath)){
                                $root = str_replace("\\","/",$_SERVER['DOCUMENT_ROOT']);
                                $real = str_replace( "\\","/",realpath('../uploads'));
                                $fileUrl = (str_replace($root, "", $real))."/".$file_name;

                                if(Images::save($main_id,$fileUrl)){
                                    $_SESSION['message'] = "Record has been saved ";
                                    $_SESSION['msg_type'] = "success";
                                }else{
                                    DistrictWiseSchemes::delete($main_id);
                                    $_SESSION['message'] = $file_name."Something went Wrong!Image cannot be added";
                                    $_SESSION['msg_type'] = "danger";
                                    break;
                                }
                            }else{
                                DistrictWiseSchemes::delete($main_id);
                                $_SESSION['message'] = $file_name." File Not uploaded";
                                $_SESSION['msg_type'] = "danger";
                                break;
                            }
                        }
                    }else{
                        DistrictWiseSchemes::delete($main_id);
                        $_SESSION['message'] = $file_name." File Type Not Allowed ! fail to upload file";
                        $_SESSION['msg_type'] = "danger";
                        break;
                    }
                }
            }else{
                $_SESSION['message'] = "Image Not Uploaded";
                $_SESSION['msg_type'] = "danger";
            }
        }else{
            $_SESSION['message'] = "Something went wrong!";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }

    if(isset($_POST['update'])){
        $district_id = $_POST['district'];
        $taluka_id = $_POST['taluka'];
        $localarea_id = $_POST['area'];
        $scheme_id = $_POST['scheme'];
        $serialized_model = $_POST["model"];
        $model = unserialize($serialized_model);
        $model->district_id = $district_id;
        $model->taluka_id = $taluka_id;
        $model->localarea_id = $localarea_id;
        $model->scheme_id = $scheme_id;
        if(DistrictWiseSchemes::update($model)){
            $_SESSION['message'] = "Record has been updated";
            $_SESSION['msg_type'] = "success";
        }else{
            $_SESSION['message'] = "Something went wrong!";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        if(DistrictWiseSchemes::delete($id)){
            $_SESSION['message'] = "Record has been deleted";
            $_SESSION['msg_type'] = "success";
        }
        else {
            $_SESSION['message'] = "Something went wrong can not be deleted!";
            $_SESSION['msg_type'] = "danger";
        }
        header("location:index.php");
    }