<?php

define("HOST","localhost");
define("USER","root");
define("DB","course_finder");
define("PASS","");

$connect = mysqli_connect(HOST,USER,PASS,DB) or die("db connection fail");

function insert($table,$array){
        global $connect;

        $cols=implode(",",array_keys($array));
        $value=implode("','" , array_values($array));

        $data=mysqli_query($connect, "insert into $table($cols) value ('$value')");

}
//calling
function calling($table){
        global $connect;
        $array=[];
        $query = "select * from $table";
        $row = mysqli_query($connect,$query);
        while ($data = mysqli_fetch_array($row)){
                $array[]= $data;
        }
        return $array;
}


?>