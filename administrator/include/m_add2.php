<?php 
		$field = $value = "";
		reset($fieldlist2);
			 while(list(,$s_key) = each($fieldlist2))
			 {
				  $field .= ", " . $s_key;
				  $value .= ", '" . $_POST[$s_key] . "'";
			}
		$field = substr ($field,1, strlen ($field));
		$field .= " ,create_date, create_by ";
		$value = substr ($value,1, strlen ($value));
		$value .= ",'" . date ("Y-m-d H:i:s")  . "', '" . $_SESSION["login_name"] . "'";
		$sql = "insert into $tbl_name2 ( " . $field . ")  values (". $value . ")";
		// echo $sql."<br>";
		// exit();
		@mysqli_query($conn,$sql);
		$id = mysqli_insert_id($conn);
		
		?>