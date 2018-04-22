<?php
	
	class Dashboard {
		
		public function view ()
		{
			$query = "SELECT * FROM `meta_table`";
			$result = sql($query, $eo);
			
			if(db_num_rows($result) == 0)
				return 0;
			else
				return $result;
		}

		public function cardSubmit($data)
		{
			if(empty($data['card_id'])){

				$qry = "INSERT INTO `meta_table`(`type`, `title`, `table_name`, `field1`, `field2`, `icon`, `color`, `extra`) VALUES ('card', '".$data['card_title']."', '".$data['card_table']."', '".$data['card_field1']."', '".$data['card_method']."', '".$data['card_icon']."', '".$data['card_color']."', '".$data['card_extra']."')";

				$_SESSION['spg_type'] = 'insert';
			}
			else{

				$qry = "UPDATE `meta_table` SET `title`='".$data['card_title']."',`table_name`='".$data['card_table']."',`field1`='".$data['card_field1']."',`field2`='".$data['card_method']."',`icon`='".$data['card_icon']."',`color`='".$data['card_color']."',`extra`='".$data['card_extra']."' WHERE `id`='".$data['card_id']."'";

				$_SESSION['spg_type'] = 'edit';
			}

			sql($qry, $eo);
			
			return TRUE;
		}

		public function chartSubmit($data){

			if(empty($data['chart_id'])){

				$qry = "INSERT INTO `meta_table`(`type`, `title`, `table_name`, `field1`, `field2`, `color`, `extra`, `icon`, `result`, `chart_type`) VALUES ('chart', '".$data['chart_title']."', '".$data['chart_table']."', '".$data['chart_field1']."', '".$data['chart_field2']."', '".$data['chart_color']."', '".$data['chart_extra']."', '".$data['chart_info']."', '".$data['chart_result']."', '".$data['chart_type']."')";

				$_SESSION['spg_type'] = 'insert';
			}
			else{

				$qry = "UPDATE `meta_table` SET `title`='".$data['chart_title']."',`table_name`='".$data['chart_table']."',`field1`='".$data['chart_field1']."',`field2`='".$data['chart_field2']."',`color`='".$data['chart_color']."',`extra`='".$data['chart_extra']."',`icon`='".$data['chart_info']."',`result`='".$data['chart_result']."',`chart_type`='".$data['chart_type']."' WHERE `id`='".$data['chart_id']."'";

				$_SESSION['spg_type'] = 'edit';
			}

			sql($qry, $eo);
			return TRUE;
		}

	}

	


?>