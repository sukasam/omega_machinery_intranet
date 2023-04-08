<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("config.php");

  $sql = "SELECT * FROM `s_project_product` ORDER BY `id` DESC";
  $qu = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($qu)){
    if($row['camount'] > 1){
      $dev = $row['ccost'] / $row['camount'];
      mysqli_query($conn,"UPDATE `s_project_product` SET `ccost` = '".$dev."' WHERE `s_project_product`.`id` = ".$row['id'].";");
    }
  }


	