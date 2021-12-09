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

</head>

<?php

/*var_dump($_POST);*/

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
  
  /*var_dump($task);*/
  $dataToChek = $task; 
  /*var_dump($dataToChek);*/

  if(count((array)$dataToChek)) {

  foreach($task as $item){?>
    <form id="todo-add" action="todo.php" method="post"> 
      <div class="todo-row" id="<?php (int)$item['taskid'] ?>">
        <div class="todo-item cx"><?php echo $item['libele']; ?>
          <input type="button" class="todo-cx" value="&#10006;">
          <input type="button" class="todo-ok" value="&#10004;">
      </div>
    </div>
    </form>
  <?php }      
  }
}

var_dump($libTask);
if(!$libTask==""){

  addTask($libTask,$statusTask);

}

function loadTask(){

  $file="taskfile.json";
  $jsonString = file_get_contents($file);
  $tasklist = json_decode($jsonString, true); 
  return $tasklist;
  
}

function addTask($libTask,$statusTask){
  
  $task = loadTask(); 
  $dataToChek = $task; 
  $newTaskid = (count((array)$dataToChek));

  $taskToAdd = array(['taskid'=>$newTaskid,'libele'=>$libTask,'status'=>$statusTask]);
   
  $taskfile = "taskfile.json";
  $jsonString = file_get_contents($taskfile);
  $task = (json_decode($jsonString, true));
  /*var_dump($task);
  var_dump($taskToAdd);*/
  $task = array_merge($task, $taskToAdd);
     
  file_put_contents($taskfile, json_encode($task,TRUE));
}
?> 

    <body>
    <div id="todo-wrap">
      <h1>TO DO LIST</h1>
  
      <form id="todo-add" action="todo.php" method="post"> 
        <input type="text" id="Additem" placeholder="New Item" name="addfield" required />
        <input type="submit" id="todo-save" value="&#10010;" name="commande"/>
      </form>
      
      <div id="todo-del">
        <input type="button" value="Delete All" id="todo-delall" />
        <input type="button" value="Delete Completed" id="todo-delcom"/>
        <input type="submit" id="todo-delete" name="clear"/>
      </div>

      <div id="todo-list"></div>
      <?php displayTask() ?>
    </div>
  </body>
  <script>
  </script>
</html>
