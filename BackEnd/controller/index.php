<?php
    require "../util/Database.php";
    class API{
        function select(){
            $db = new Database();
            $conn = $db->connect();
            $result = array();
            $districts = array();
            $sql = 'Select * from district';
            // [
            //     {
            //         "id" : 1,
            //         "name" : "nashik"
            //     },
            //     {
            //         "id" : 2,
            //         "name" : "pune"
            //     },

            // ]
            foreach($conn->query($sql) as $row){
                array_push($districts, $row['name']);
            }
            $result['data'] = $districts;
            // $data = $conn->prepare();
            // $data->execute();

            // while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            //     $users[$OutputData['id']] = array(
            //         // 'id' => $OutputData['id'],
            //         'name' => $OutputData['name']
            //     );
            // }
            return json_encode($result);
            }

        }
    $API = new API();
    header('Content-Type: application/json');
    echo $API->select();
?>