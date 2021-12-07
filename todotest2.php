<?php $postarray= your $_POST JSON ;

//read and decode the file
$current = json_decode( file_get_contents($file) , true );

//SET ID FROM THE POST JSON
$current['uid']=$postarray[$uid];

//LOOP THE POST QUESTION AND PUT THEM IN THE ARRAY
foreach($postarray['selected'] as $q){

   $current[ 'question' ][ $q[ 'questionsid' ] ]= $q[ 'val' ]; 

}
?>

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