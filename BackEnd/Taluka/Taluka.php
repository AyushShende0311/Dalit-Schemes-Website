<?php
    class Taluka{
        public $table_name = "taluka";
        public $id;
        public $name;
        public $district_id;
        public $created_datetime;
        public $updated_datetime;
        public $created_by;
        public $updated_by;

        function constructer($name){
            $this->name = $name;
            $this->created_by = 'admin';
            $this->updated_by = 'admin';
            $this->created_datetime = date("y/m/d H:i:s");
            $this->updated_datetime = date("y/m/d H:i:s");
        }
    }

?>
