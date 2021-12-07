<?php
$todo = [['tasks' => '0','libele' => 'Test1', 'statut' => '0'],['tasks' => '1','libele' => 'Test2','statut' => '0']];

function createJson($todo){
    foreach ($todo as $key => $todo){
        foreach($todo as $item => $value){
            echo $item. ' : ' .$value. '<br>';
            $json[$todo["tasks"]] = array("libele" => $todo["libele"], "statut" => $todo["statut"]);              
        }
        echo '<br>';
      }
      return $json; 
}

$json1 = createJson($todo);

$file="todo10.json";
file_put_contents($file, json_encode($json1));

?>