<?php
/*
$uid = $_POST['uid'];
$answers = $_POST['selected'];*/

$file = "todo16.json";
$_POST = json_decode(file_get_contents($file), true);
$postarray= $_POST['uid'];
$uid = $_POST['uid'];
//var_dump($_POST);

//read and decode the file
$file1 = "todo15.json";
$current = json_decode( file_get_contents($file1) , true );

//SET ID FROM THE POST JSON
$current['uid']=$postarray[$uid];
var_dump($current);
var_dump($postarray);

//LOOP THE POST QUESTION AND PUT THEM IN THE ARRAY
foreach($postarray['selected'] as $q){

   $current[ 'question' ][ $q[ 'questionsid' ] ]= $q[ 'val' ]; 

}

/*
$postarray= your $_POST JSON ;

//read and decode the file
$current = json_decode( file_get_contents($file) , true );

//SET ID FROM THE POST JSON
$current['uid']=$postarray[$uid];

//LOOP THE POST QUESTION AND PUT THEM IN THE ARRAY
foreach($postarray['selected'] as $q){

   $current[ 'question' ][ $q[ 'questionsid' ] ]= $q[ 'val' ]; 

}*/
?>