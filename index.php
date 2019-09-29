<?php

  // TODO require password

  // upload file
  if($_FILES){
    $target_file = basename($_FILES["upload_file"]["name"]);
    move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file);
  }
  // delete file
  // TODO add confirm dialog before delete
  else if(isset($_GET['del'])){
    if(file_exists($_GET['del'])){
      unlink($_GET['del']);
    }
  }
?>
<html>
  <head>
    <title>Easy File Manager (EFM)</title>
  </head>
  <body>
    <h1><a href='index.php'>Easy File Manager</a></h1>

    <form action="index.php" method="post" enctype="multipart/form-data">
      <input type='file' name='upload_file'>
      <input type='submit' value='Upload'>
    </form>

    <table border='1'>
      <tr>
        <th>Filename</th>
        <th>Uploaded Time</th>
        <th>Link</th>
        <th>Delete</th>
      </tr>
      <?php
        $path = '.';
        $files = scandir($path);
        $files = array_diff(scandir($path), array('.', '..'));
        foreach($files as $f){
          if($f == 'index.php'){
            continue;
          }
          echo "<tr>";
          echo "<td>".$f."</td>";
          echo "<td>".date('Y/m/d H:i:s', filemtime($f))."</td>";
          echo "<td><a href='./".$f."'>Link</a></td>";
          echo "<td><a href='./?del=".$f."'>Delete</a></td>";
          echo "</tr>";
        }
      ?>
    </table>
  </body>
</html>
