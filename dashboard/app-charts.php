<?php

	include('../lib.php');

	$charts = array();
	$wk = 1; $mt = 1;
	$result = sql("SELECT * FROM `meta_table` WHERE `type`='chart'", $eo);
	if(db_num_rows($result) > 0){

		while($rec = db_fetch_assoc($result)){

			
			$cur_month = date('m');
			$data = array(); $data2 = array();
			
			$chartid = $rec['id'];
			$info  = $rec['icon'];
			$table = $rec['table_name'];
			$title = $rec['title'];
			$field1 = $rec['field1'];
			$field2 = $rec['field2'];
			$color  = $rec['color'];
			$extra  = $rec['extra'];
			$meta_result  = $rec['result'];
			$type = $rec['chart_type'];

			if($info == 'week'){
				
				$duration = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];

				$monday = strtotime("last monday");
				$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
				$ldate  = strtotime(date("Y-m-d",$monday)." +7 days");

				$start_date = date("Y-m-d", $monday);
				$end_date 	= date("Y-m-d", $ldate);

				$period = createDateRange($start_date, $end_date);
			}
			else
				$duration = ['JA', 'FE', 'MA', 'AP', 'MA', 'JU', 'JL', 'AU', 'SE', 'OC', 'NV', 'DE'];


			$ds = 0;
				

			/* start */
			if($meta_result == 'count' && $info == 'week'){
					
					foreach($period as $date){
					
						$data['sales'][] = sqlValue("SELECT count(*) FROM ".$table." WHERE DATE(".$field1.") = '".$date."'", $eo);

						if($date == date('Y-m-d')) break;
						
						$ds++;
					}
				
				}
				else if($meta_result == 'count' && $info == 'month'){

					for($m=1; $m<=$cur_month; $m++){

						$cnt = sqlValue("SELECT count(*) FROM ".$table." WHERE MONTH(date) = ".$m." AND YEAR(".$field1.") = YEAR(CURRENT_DATE())", $eo);
						$data['sales'][] = $cnt;
					}
				}
				else if($meta_result == 'sum' && $info == 'week'){

					foreach($period as $date){

						$sm = sqlValue("SELECT SUM(".$field2.") FROM ".$table." WHERE DATE(".$field1.") = '".$date."'", $eo);

						if(empty($sm)) $data['sales'][] = 0;
						else $data['sales'][] = $sm;

						if($date == date('Y-m-d')) break;
						
						$ds++;
					}

				} 
				else{

					for($m=1; $m<=$cur_month; $m++){
						
						$mval = sqlValue("SELECT SUM(".$field2.") FROM ".$table." WHERE MONTH(date) = ".$m." AND YEAR(".$field1.") = YEAR(CURRENT_DATE())", $eo);

						if(empty($mval)) $data['sales'][] = 0;
						else $data['sales'][] = $mval;
					}
				}

				/* End */

			if($ds != 0){
				
				for($i =0; $i<=$ds; $i++){
					$data['duration'][] = $duration[$i]; 
				}
			}
			else{

				for($mn =0; $mn<$cur_month; $mn++){
					$data['duration'][] = $duration[$mn]; 
				}
			}	

			$data['chartid']  = $chartid;
			$data['color']  = $color;  
			$data['title']  = $title;
			$data['extra']  = $extra;  

			if($type == 'line'){

				$charts['line'][$wk] = $data;

				$wk++;
			}
			else{

				$charts['bar'][$mt] = $data;
				$mt++;
			}
		}

	}



	

	echo json_encode($charts);

	function createDateRange($startDate, $endDate, $format = "Y-m-d")
	{
		$begin = new DateTime($startDate);
		$end   = new DateTime($endDate);

		$interval  = new DateInterval('P1D');
		$dateRange = new DatePeriod($begin, $interval, $end);

		$range = [];
		foreach ($dateRange as $date) {
			$range[] = $date->format($format);
		}

		return $range;
	}

	function weekly_sales(){


			if($meta_result == 'count'){
					
					foreach($period as $date){
					
						$data['sales'][] = sqlValue("SELECT count(*) FROM ".$table." WHERE DATE(".$field1.") = '".$date."'", $eo);

						if($date == date('Y-m-d')) break;
						
						$ds++;
					}
				
				}
				else{

					foreach($period as $date){

						$sm = sqlValue("SELECT SUM(".$field2.") FROM ".$table." WHERE DATE(".$field1.") = '".$date."'", $eo);

						if(empty($sm)) $data['sales'][] = 0;
						else $data['sales'][] = $sm;

						if($date == date('Y-m-d')) break;
						
						$ds++;
					}
				}

	}

?>