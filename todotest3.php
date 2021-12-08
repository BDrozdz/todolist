<?php
$json = '{
  "uid":1,
  "selected":[
     {
        "questionsid":1,
        "val":"1"
     },
     {
        "questionsid":2,
        "val":"1"
     }
  ]
}';

$_POST = json_decode($json, true);

$uid = $_POST['uid'];
$answers = $_POST['selected'];

$current = ''; // fgc 

// start building your expected output
$current .= "uid: $uid\n";
foreach ($answers as $item) {
    $line = '';
    foreach ($item as $key => $value) {
        $line .= "$key: $value, ";
    }
    $current .= rtrim($line, ', ')."\n";
}
print_r($current);
$file="todo12.json";
file_put_contents($file, json_encode($current,TRUE));

?>