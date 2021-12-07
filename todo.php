<?PHP
session_start(); 
?>

<!doctype html>
<html>

<head>
    <title>Todo Liste vezsion php</title>
    <meta charset="utf-8">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Bruno DROZDZ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="todo.css">
    <!-- <script src="js/bootstrap.js"></script> -->
    <link href="todo.css" rel="stylesheet">
    <!-- <script src="todo.js"></script> -->

</head>

<?php

var_dump($_POST);

if (isset($POST['clear']))
{
  session_destroy(); 
} 

if (isset($POST['statusTask']))
{
    $_SESSION['statusTask']= 0; 
} 
else
{
  $statusTask = 0;
}

if (isset($_POST['commande']))
{
    $libTask = trim($_POST['addfield']); 
} 
else
{
    $libTask ="";
}

function DisplayTask(){

  $task= loadTask(); 
  
  //var_dump($task);

  foreach($task as $item){?>
    <div class="todo-row" data-id="<?php (int)($item['taskid']) ?>">
      <div class="todo-item cx"><?php echo $item['libele']; ?>
        <input type="button" class="todo-cx" value="&#10006;">
        <input type="button" class="todo-ok" value="&#10004;">
    </div>
    </div>
  <?php }      
}

var_dump($libTask);
if(!$libTask==""){

  addTask($libTask,$statusTask);

}

function loadTask(){

  $file="todo2.json";
  $data = file_get_contents($file);
  $_POST = json_decode($data, true); 
  $tasklist = $_POST['task'];
  return $tasklist;

}

function addTask($libTask,$statusTask){

  
  $task= loadTask(); 
  $newTaskid = count($task) + 1;
  
  //$taskNew = [['taskid'=> $newTaskid, 'libele'=>$libTask, 'status'=>$statusTask],];

   $time = [['selectedtime' => 'Brussels', 'continent' => 'Europe', 'fuseau' => 'UTC', 'decalage' => 'GMT +01:00'],];
  //['selectedtime' => 'Paris','continent' => 'Europe' , 'fuseau' => 'UTC', 'decalage' =>'GMT +01:00'],];
  //$json[$time["selectedtime"]] = array("continent" => $time["continent"], "fuseau" => $time["fuseau"], "decalage" => $time["decalage"]); 

  //var_dump($taskNew);

  //$values[$task["taskid"]] = array("libele"=>$taskNew["libele"], "status"=>$taskNew["status"]);
  //  var_dump($values);
  $json[$time["selectedtime"]] = array("continent" => $time["continent"], "fuseau" => $time["fuseau"], "decalage" => $time["decalage"]); 
  $task = array_merge($task, $json);
     
  $file="todo2.json";
  //file_put_contents($file, json_encode($task,TRUE));
}
?> 

    <body>
    <div id="todo-wrap">
      <!-- (A) HEADER -->
      <h1>TO DO LIST</h1>
      
      <!-- (B) ADD NEW ITEM -->
      <form id="todo-add" action="todo.php" method="post"> 
        <input type="text" id="Additem" placeholder="New Item" name="addfield" required />
        <input type="submit" id="todo-save" value="&#10010;" name="commande"/>
      </form>
      
      <!-- (C) DELETE ITEMS -->
      <div id="todo-del">
        <input type="button" value="Delete All" id="todo-delall" />
        <input type="button" value="Delete Completed" id="todo-delcom"/>
        <input type="submit" id="todo-delete" name="clear"/>
      </div>
      
      <!-- (D) LIST ITEMS -->
      <div id="todo-list"></div>
      <?php displayTask() ?>
    </div>
  </body>
  <script>
  </script>
</html>
<?php

/*$todo = [['tasks' => '0','libele' => 'Test1', 'statut' => '0'],['tasks' => '1','libele' => 'Test2','statut' => '0']];

foreach ($todo as $key => $todo){
  foreach($todo as $item => $value){
      echo $item. ' : ' .$value. '<br>';
      $json[$todo["tasks"]] = array("libele" => $todo["libele"], "statut" => $todo["statut"]);              
  }
  echo '<br>';
}*/
/*
if(!$libTask=="")
{
  var_dump($libTask);
  var_dump($statusTask);
  saveTask($libTask,$statusTask);
}

function saveTask($libTask,$statusTask){
  $file="todo1.json";
  //$todo =  [['task' => 0,'libele' => $libTask, 'statut' => $statusTask]];
  $todo = [$libTask,$statusTask];
  var_dump($todo);
  // $json[$todo['task']] = array('libele'=>$todo['libele'], 'statut' => $todo['statut']);
  // $json[$todo['task']] = array('task' => $todo[0], 'libele'=>$todo[1], 'statut' => $todo[2]);
  //$json[$todo['task']] = array('libele'=>$todo[1], 'statut' => $todo[2]);
  
  file_put_contents($file, json_encode($todo,TRUE));

} */

?>