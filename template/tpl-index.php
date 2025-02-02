<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?= SITE_TITLE ?></title>
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link 
  href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
  rel="stylesheet"  type='text/css'>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">John Doe </span><img src="./assets/img/man.jpg" width="40" height="40"/></div>
  </div>
  <div class="main"> 
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      
      <div class="menu">
        <div class="title">Folders</div>
        <ul class="folder-list">
        <li class="<?=isset($_GET['folder_id']) ? '' : 'active'?>">
          <a href="<?= site_url() ?>"><i class="fa fa-folder"></i>All</a>
          </li>

          <?php foreach ($folders as $folder): ?>
            
          <li class="<?php
          if (isset($_GET['folder_id'])) {
            $folder_id == $folder->id;
            echo $_GET['folder_id'] == $folder->id ? 'active' : '';
            } else {
            $folder_id = null; 
          }
          ?>">
          <a href="?folder_id=<?= $folder->id ?>"><i class="fa fa-folder"></i><?=$folder->name?></a>
          <a href="?delete_folder=<?= $folder->id ?>">
          <i class="fa fa-trash-alt second-a" onclick="return confirm('Are you sure to delete this Item?\n<?= $folder->name ?>')"></i></a>
          </li>
          <?php endforeach;?>

        </ul>
      </div>
      <div>
        <input type="text" id="addFolderInput" placeholder="Add New Folder"/>
        <button class="btn clickable" id="addFolderBtn">+</button>
      </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title" style="width:50%;">
          
          <input type="text" id="taskNameInput" placeholder="Add New Task" style="line-height:30px;width:100%;margin-left:3%;margin-top:3%;">
          
          
        </div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
          <div class="button inverz"><i class="fa fa-trash-o"></i></div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
            <?php if (sizeof($tasks) > 0): ?>
            <?php foreach ($tasks as $task): ?>
            <li class="<?= $task->is_done ? 'checked' : ''; ?>">
              
            <i class="fa <?= $task->is_done ? 'fa-check-square-o' : 'fa-square-o'; ?>" ></i>

            <span><?= $task->title ?></span>
              <div class="info">
                <span class="created_at">Created At <?= $task->created_at ?></span>
                <a href="?delete_task=<?= $task->id ?>"><i class="fa fa-trash-alt second-a" onclick="return confirm('Are you sure to delete this Item?\n<?= $task->title ?>');"> </i></a>
              </div>
            </li>
            <?php endforeach; ?>  
            <?php else: ?>  
              <li>No Task Here ..</li>
            <?php endif; ?>  
            
          </ul>
        </div>
        
      </div>
    </div>
  </div>
</div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script>
    $(document).ready(function(){
      $('#addFolderBtn').click(function(e){
          var input = $('input#addFolderInput');
          $.ajax({
            url : "process/ajaxHandler.php",
            method : "post",
            data : {action: "addFolder",folderName: input.val()},
            success : function(response){
              if(response == '1'){
                $('<li> <a href="#"><i class="fa fa-folder"></i>'+input.val()+'</a></li>').appendTo('ul.folder-list');
                
              }else{
                alert(response);
              }
            }
          });
      });
      $('#taskNameInput').on('keypress',function(e){
        e.stopPropagation();
        if(e.which == 13) {
          $.ajax({
            url : "process/ajaxHandler.php",
            method : "post",
            data : {action: "addTask",folderId: <?= $_GET['folder_id'] ?? 0 ?> ,taskTitle: $('#taskNameInput').val()},
            success : function(response){
              // alert(response);
              if(response == '1'){
                location.reload();
                
              }else{
                alert(response);
              }
            }
          });
        }
      });
      $('#taskNameInput').focus();
    });

  </script>
</body>
</html>
