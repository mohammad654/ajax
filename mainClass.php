<?php


if (isset($_GET) and !empty($_GET)){
    $database= new database();
    $database->insertDatat();
}


class database{

        public function  __construct(){
           $this->con = mysqli_connect("localhost","root","","test");

            if(! $this->con){
                die('Connection Failed'. mysqli_connect_error());
            }
        }

        public function  insertDatat(){
            $artist = mysqli_real_escape_string($this->con, $_POST['artist']);
            $song = mysqli_real_escape_string($this->con, $_POST['song']);

            $query = "INSERT INTO artists  (artist,song) VALUES ('$artist','$song')";
            $query_run = mysqli_query($this->con, $query);

            if ($query_run){
              echo "Successfully inserted data";
            }else{
                echo "Failed to insert data ";
            }
        }
        public function  index(){
            $query = " SELECT * FROM artists";
            $result = mysqli_query($this->con, $query);
            return   $result;

        }
}


