<?php
	if($_GET['action'] === 'replaceSrt'){
		
		$id = $_GET['id'];
		$cpro1 = $_GET['cpro1'];
		$cpro2 = $_GET['cpro2'];
		$remark = $_GET['remark'];
		
		switch ($id) {
			case "2":
				$new_cpro1 = str_replace('เครื่องผลิตน้ำแข็ง', 'เครื่องล้างแก้ว', $cpro1);
				$new_cpro1 = str_replace('อื่นๆ', 'เครื่องล้างแก้ว', $new_cpro1);
				$cpro1 = str_replace('เครื่องล้างจาน', 'เครื่องล้างแก้ว', $new_cpro1);
				
				$new_cpro2 = str_replace('เครื่องผลิตน้ำแข็ง', 'เครื่องล้างแก้ว', $cpro2);
				$new_cpro2 = str_replace('อื่นๆ', 'เครื่องล้างแก้ว', $new_cpro2);
				$cpro2 = str_replace('เครื่องล้างจาน', 'เครื่องล้างแก้ว', $new_cpro2);
				
				$new_remark = str_replace('เครื่องผลิตน้ำแข็ง', 'เครื่องล้างแก้ว', $remark);
				$new_remark = str_replace('อื่นๆ', 'เครื่องล้างแก้ว', $new_remark);
				$remark = str_replace('เครื่องล้างจาน', 'เครื่องล้างแก้ว', $new_remark);
				
				echo "|".$cpro1."|".$cpro2."|".$remark;
				
				break;
			case "3":
				
				$new_cpro1 = str_replace('เครื่องล้างแก้ว', 'เครื่องผลิตน้ำแข็ง', $cpro1);
				$new_cpro1 = str_replace('อื่นๆ', 'เครื่องผลิตน้ำแข็ง', $new_cpro1);
				$cpro1 = str_replace('เครื่องล้างจาน', 'เครื่องผลิตน้ำแข็ง', $new_cpro1);
				
				$new_cpro2 = str_replace('เครื่องล้างแก้ว', 'เครื่องผลิตน้ำแข็ง', $cpro2);
				$new_cpro2 = str_replace('อื่นๆ', 'เครื่องผลิตน้ำแข็ง', $new_cpro2);
				$cpro2 = str_replace('เครื่องล้างจาน', 'เครื่องผลิตน้ำแข็ง', $new_cpro2);
				
				$new_remark = str_replace('เครื่องล้างแก้ว', 'เครื่องผลิตน้ำแข็ง', $remark);
				$new_remark = str_replace('อื่นๆ', 'เครื่องผลิตน้ำแข็ง', $new_remark);
				$remark = str_replace('เครื่องล้างจาน', 'เครื่องผลิตน้ำแข็ง', $new_remark);
				
				echo "|".$cpro1."|".$cpro2."|".$remark;

				break;
			case "4":
			
				$new_cpro1 = str_replace('เครื่องล้างแก้ว', 'อื่นๆ', $cpro1);
				$new_cpro1 = str_replace('เครื่องผลิตน้ำแข็ง', 'อื่นๆ', $new_cpro1);
				$cpro1 = str_replace('เครื่องล้างจาน', 'อื่นๆ', $new_cpro1);
				
				$new_cpro2 = str_replace('เครื่องล้างแก้ว', 'อื่นๆ', $cpro2);
				$new_cpro2 = str_replace('เครื่องผลิตน้ำแข็ง', 'อื่นๆ', $new_cpro2);
				$cpro2 = str_replace('เครื่องล้างจาน', 'อื่นๆ', $new_cpro2);
				
				$new_remark = str_replace('เครื่องล้างแก้ว', 'อื่นๆ', $remark);
				$new_remark = str_replace('เครื่องผลิตน้ำแข็ง', 'อื่นๆ', $new_remark);
				$remark = str_replace('เครื่องล้างจาน', 'อื่นๆ', $new_remark);


				
				echo "|".$cpro1."|".$cpro2."|".$remark;

				break;
			default:
				
				$new_cpro1 = str_replace('เครื่องล้างแก้ว', 'เครื่องล้างจาน', $cpro1);
				$new_cpro1 = str_replace('อื่นๆ', 'เครื่องล้างจาน', $new_cpro1);
				$cpro1 = str_replace('เครื่องผลิตน้ำแข็ง', 'เครื่องล้างจาน', $new_cpro1);
				
				$new_cpro2 = str_replace('เครื่องล้างแก้ว', 'เครื่องล้างจาน', $cpro2);
				$new_cpro2 = str_replace('อื่นๆ', 'เครื่องล้างจาน', $new_cpro1);
				$cpro2 = str_replace('เครื่องผลิตน้ำแข็ง', 'เครื่องล้างจาน', $new_cpro2);
				
				$new_remark = str_replace('เครื่องล้างแก้ว', 'เครื่องล้างจาน', $remark);
				$new_remark = str_replace('อื่นๆ', 'เครื่องล้างจาน', $new_remark);
				$remark = str_replace('เครื่องผลิตน้ำแข็ง', 'เครื่องล้างจาน', $new_remark);

				echo "|".$cpro1."|".$cpro2."|".$remark;
		}
		
		
	}
?>