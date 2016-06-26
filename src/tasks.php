<?php
/**
 * Created by PhpStorm.
 * User: vicky
 * Date: 27.06.16
 * Time: 00:49
 */
$link = mysqli_connect("localhost", "root", "root");

// CHECK CONNECTION
if($link === false){
    die("Error: " . mysqli_connect_error());
}

//ATTEMPT TO CREATE DATABASE QUERY EXECUTION
$sql = "CREATE DATABASE IF NOT EXISTS tasks";
if(mysqli_query($link, $sql)){
    echo "Database tasks created successfully"  . "\n";
}else{
    echo "ERROR: could not execute $sql " . mysqli_error($link);
}

//SELECT DB
$selected_db = mysqli_select_db($link, "tasks");

//ATTEMPT TO CREATE TABLE
$sql = "CREATE TABLE IF NOT EXISTS tasks(task_id INT(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
task CHAR(30) NOT NULL)";
if(mysqli_query($link, $sql)){
    echo "Table persons created successfully" . "\n";
} else {
    echo "ERROR: Could not execute $sql." . mysqli_error($link);
}

$task = mysqli_real_escape_string($link, $_POST['task']);

$sql = "INSERT INTO tasks(task) VALUES ('$task')";

if(mysqli_query($link, $sql)){
    echo "Tasks added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


