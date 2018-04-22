<?php if(!isset($Translation)){ @header('Location: index.php'); exit; } ?>
<?php include_once("{$currDir}/header2.php"); ?>
<?php @include("{$currDir}/hooks/links-home.php"); ?>

<?php
	/*
		Classes of first and other blocks
		---------------------------------
		For possible classes, refer to the Bootstrap grid columns, panels and buttons documentation:
			Grid columns: http://getbootstrap.com/css/#grid
			Panels: http://getbootstrap.com/components/#panels
			Buttons: http://getbootstrap.com/css/#buttons
	*/
	$block_classes = array(
		'first' => array(
			'grid_column' => 'col-sm-12 col-md-8 col-lg-6',
			'panel' => 'panel-warning',
			'link' => 'btn-warning'
		),
		'other' => array(
			'grid_column' => 'col-sm-6 col-md-4 col-lg-3',
			'panel' => 'panel-info',
			'link' => 'btn-info'
		)
	);
	
	$arrTables = getTableList();

	if(empty($arrTables)){
		
		echo "<script>window.location='index.php?signIn=1';</script>";		
			
	}

	if(isset($_SESSION['spg_type'])){

		if($_SESSION['spg_type'] == 'insert'){
			$spg_class  = 'alert-success';
			$spg_msg 	= 'The new widget has been saved successfully';
		}
		else if($_SESSION['spg_type'] == 'delete'){
			$spg_class  = 'alert-success';
			$spg_msg 	= 'The widget has been deleted successfully';
		}

		echo showNotifications($spg_msg, $spg_class, $fadeout = true);
		unset($_SESSION['spg_type']);
	}
	
?>

<style>
	.panel-body-description{
		margin-top: 10px;
		height: 100px;
		overflow: auto;
	}
	.panel-body .btn img{
		margin: 0 10px;
		max-height: 32px;
	}
</style>
	<div class="content" style="margin-top:0px;">
                <div class="container-fluid">
					<div id="dashboard_data">
                    <div class="row">
					
					<?php 

					$result = sql("SELECT * FROM `meta_table` WHERE `type`='card'", $eo); 

					if(db_num_rows($result) > 0)
					{

						while($rec = db_fetch_assoc($result)){

							$sub_field = $rec['field1'];
							$sub_method = $rec['field2'];

							$gval = $sub_method.'('.$sub_field.')';
							$icon = str_replace(" ","_",$rec['icon']);
							$icon = strtolower($icon);

							$hvalue = sqlValue("SELECT ".$gval." FROM ".$rec['table_name']);

							$cardid = $rec['id'];
							
							$cdl = '';
							if(getLoggedGroupID() == 2){
								$cdl = '<div class="col-md-2">
	                                     <a href="#" data-toggle="element_delete" data-id="'.$cardid.'"><i class="material-icons text-danger">delete</i></a>
	                                    </div>	';
							}
							echo '<div class="col-lg-3 col-md-6 col-sm-6  col-xs-12">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="'.$rec['color'].'">
                                    <span><i class="material-icons">'.$icon.'</i></span>
                                </div>
                                <div class="card-content">
                                    <p class="category">'.$rec['title'].'</p>
                                    <h3 class="title">'.$hvalue.'
                                    </h3>
                                </div>
                                <div class="card-footer">
                                	<div class="col-md-12" style="padding:5px 0">
	                                	<div class="col-md-10" style="padding:0px">
		                                    <div class="stats">
		                                       '.$rec['extra'].'
		                                    </div>
		                                </div>
		                                '.$cdl.'
									</div>
                                   
                                    
                                </div>
                               
                            </div>
                        </div>';
						}
					}
					
					?>
                    </div>
					<div class="row">

					<?php

					$result2 = sql("SELECT * FROM `meta_table` WHERE `type`='chart'", $eo); 

					if(db_num_rows($result2) > 0)
					{
						while($rec2 = db_fetch_assoc($result2)){

							$chartid = $rec2['id'];
							
							$dl = '';
							if(getLoggedGroupID() == 2){
								$dl = ' <div class="col-md-2">
	                                    	<a href="#" data-toggle="element_delete" data-id="'.$chartid.'"><i class="material-icons text-danger">delete</i></a>
	                                    </div>';
							}

							echo '<div class="col-md-4">
                            <div class="card">
                                <div class="card-header card-chart" id="chart_color_'.$chartid.'" data-background-color="green" >
                                    <div class="ct-chart" id="charts_'.$chartid.'"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="title" id="chart_title_'.$chartid.'">Daily Sales</h4>
                                    <p class="category">
                                        <span id="span_color_'.$chartid.'">Present - <span id="today_sales_'.$chartid.'">0</span>
									</p>
                                </div>
                                <div class="card-footer">
                                	<div class="col-md-12" style="padding:5px 0;">
	                                	<div class="col-md-10" style="padding:0px;">
	                                    <div class="stats" id="chart_extra_'.$chartid.'">
	                                      additional info
	                                    </div>
	                                    </div>
	                                    '.$dl.'
                                    </div>
                                </div>
                            </div>
                        </div>';

						}
					}
					?>
                    
                    </div>
					
					</div>
				</div>
			</div>
			<div>
			</div>

	<!-- Modal Core -->
	<div class="modal fade" id="modal_card" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="myCardLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="myCardLabel">Card</h4>
	      </div>
	       <form action="dashboard/card_submit.php" method="post" id="form_card">
	      <div class="modal-body">
	       		<div class="row">
	        
	        		<input type="hidden" id="card_id" name="card_id">
		        	<div class="form-group label-floating col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                    <label class="control-label">Title<span class="text-danger"> *</span></label>
	                     <input type="text" class="form-control" id="card_title" name="card_title" required>
	                </div>

	                <div class="form-group label-floating col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                    <label class="control-label">Icon<span class="text-danger"> *</span></label>
	                     <input type="text" class="form-control" id="card_icon" name="card_icon" required>
	                     <small class="material-input">Material Icon Name. <a href="https://material.io/icons/" target="_blank">Click Here</a></small>
	                </div>
            
            		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            			<label class="control-label">Table<span class="text-danger"> *</span></label>
            			<select id="card_table" name="card_table" class="form-control">
            				<?php
            					$tableslist = getTableList();
            					if(!empty($tableslist)){
            						echo '<option>Choose Table</option>';
            						foreach($tableslist as $table=>$label){
            							echo '<option value="'.$table.'">'.$label[0].'</option>';
            						}
            					}
            					else
            						echo '<option>No Tables Found</option>';
            					
            				?>
            			</select>
            		</div>

            		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                    <label class="control-label">Key Value<span class="text-danger"> *</span>( choose table first )</label>
	                     <select id="card_field1" name="card_field1" class="form-control">
	                     	
	                     </select>

	                </div>
            
            		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            			<label class="control-label">Method<span class="text-danger"> *</span></label>
            			<select class="form-control" id="card_method" name="card_method">
            				<?php
            					$methods = array("COUNT"=>"Total Records Count", "SUM" => "SUM", "AVG" => "Average", "MAX" => "Highest", "MIN" => "Lowest");

            					foreach($methods as $key=>$value){
            						echo "<option value='".$key."'>".$value."</option>";
            					}
            				?>
            			</select>
            		</div>

            		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            			<label class="control-label">Color<span class="text-danger"> *</span></label>
            			<select id="card_color" name="card_color" class="form-control">
            				<?php
            					$colors = ['blue' => 'Blue', 'green' => 'Green', 'orange' => 'Orange', 'red' => 'Red'];

            					foreach($colors as $key=>$value){
            						echo "<option value='".$key."'>".$value."</option>";
            					}

            				?>
            			</select>
            		</div>

            		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                    <label class="control-label">Additional Info</label>
	                    <input type="text" class="form-control" id="card_extra" name="card_extra">
	                </div>
            

	       </div>
	      </div>
	      <div class="modal-footer" style="padding:10px">
				<button type="button" class="btn btn-default " id="card_close" data-dismiss="modal" aria-hidden="true">Close</button>
	       		 <button type="submit" class="btn btn-primary" id="card_submit">Save</button>
			</div>
	      </form>
		
	    </div>
	  </div>
	</div>

	<!-- Modal Chart -->
	<div class="modal fade" id="modal_chart" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="myChartLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="myCardLabel">Chart</h4>
	      </div>
	       <form action="dashboard/chart_submit.php" method="post" id="form_card">
	      <div class="modal-body">
	       		<div class="row">
	        
	        		<input type="hidden" id="chart_id" name="chart_id">
		        	<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                    <label class="control-label">Title<span class="text-danger"> *</span></label>
	                     <input type="text" class="form-control" id="chart_title" name="chart_title" required>
	                </div>

	                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                    <label class="control-label">Chart Type</label>
	                     <select id="chart_type" name="chart_type" class="form-control">
            				<option value="line">Line Chart</option>
            				<option value="bar">Bar Chart</option>
	                     </select>
	                </div>

	                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                    <label class="control-label">View Data<span class="text-danger"> *</span></label>
	                     <select id="chart_info" name="chart_info" class="form-control" required>
            				<option value="week">Current Week</option>
            				<option value="month">Monthly</option>
	                     </select>
	                </div>
            
            		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            			<label class="control-label">Table<span class="text-danger"> *</span></label>
            			<select id="chart_table" name="chart_table" class="form-control">
            				<?php
            					$tableslist = getTableList();
            					if(!empty($tableslist)){
            						echo '<option>Choose Table</option>';
            						foreach($tableslist as $table=>$label){
            							echo '<option value="'.$table.'">'.$label[0].'</option>';
            						}
            					}
            					else
            						echo '<option>No Tables Found</option>';
            					
            				?>
            			</select>
            		</div>

            		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                    <label class="control-label">X-axis<span class="text-danger"> *</span> ( choose table first )</label>
	                     <select id="chart_field1" name="chart_field1" class="form-control">
	                     	
	                     </select>
	                     
	                </div>
            
            		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            			<label class="control-label">Y-axis<span class="text-danger"> *</span> ( choose table first )</label>
            			<select class="form-control" id="chart_field2" name="chart_field2">
            				
            			</select>
            			
            		</div>

            		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                    <label class="control-label">Y-axis Result</label>
	                     <select id="chart_result" name="chart_result" class="form-control">
            				<option value="count">Count</option>
            				<option value="sum">Sum</option>
	                     </select>
	                </div>

            		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            			<label class="control-label">Color</label>
            			<select id="chart_color" name="chart_color" class="form-control">
            				<?php
            					$colors = ['blue' => 'Blue', 'green' => 'Green', 'orange' => 'Orange', 'red' => 'Red'];

            					foreach($colors as $key=>$value){
            						echo "<option value='".$key."'>".$value."</option>";
            					}

            				?>
            			</select>
            		</div>

            		
            		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                    <label class="control-label">Additional Info</label>
	                    <input type="text" class="form-control" id="chart_extra" name="chart_extra">
	                </div>
       
	       </div>
	      </div>
	      <div class="modal-footer" style="padding:10px">
				<button type="button" class="btn btn-default " id="chart_close" data-dismiss="modal" aria-hidden="true">Close</button>
	       		 <button type="submit" class="btn btn-primary" id="chart_submit">Save</button>
			</div>
	      </form>
	    </div>
	  </div>
	</div>

<script>

	$('[data-toggle="tooltip"]').tooltip();
	
	/* Delete Charts & cards */
	
	$('a[data-toggle="element_delete"]').click(function(e){

		e.preventDefault();
		var did = $( this ).attr('data-id');

		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this component",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
			  	location.href = "./dashboard/delete.php?id="+did;
			 }
		});
	});
</script>

<script src="<?php echo PREPEND_PATH; ?>dashboard/card.js"></script>
<script src="<?php echo PREPEND_PATH; ?>dashboard/chart.js"></script>
<?php include_once("$currDir/footer2.php"); ?>