<?php

require_once("db_connect.php");

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT * FROM users order by name asc";
                $query = $conn->query($sql);

                echo "$query->num_rows";
?>