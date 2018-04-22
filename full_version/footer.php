			<!-- Add footer template above here -->
		
		

	<script>

	$(document).ready(function() {
			
		$('#Search').addClass('btn-just-icon');
		$('#NoFilter_x').addClass('btn-just-icon');
		$('#Next').removeClass('btn-block');
		$('#Previous').removeClass('btn-block');
		$( "div.form-group" ).next().css( "font-size", "15px" );
		$('#deselect').parent().removeClass('btn-group-lg');
		$('#update').parent().removeClass('btn-group-lg');
		$('#insert').parent().removeClass('btn-group-lg');
		$('#update').removeClass('btn-lg');
		$('button.view_parent').addClass('btn-just-icon');
		$('button.add_new_parent').addClass('btn-just-icon');
		$('button.clear_filter').addClass('btn-white btn-just-icon');
		$('select.option_list').removeClass().addClass('form-control');
		//$('.all_records').removeClass('btn-group-lg');
		
		$('div.panel.panel-default').removeClass().addClass('card');
    	$('div.panel-heading').removeClass().addClass('header card-header text-center');
	    $('div.panel-body').removeClass().addClass('card-content');
		
	
	});


	$( window ).on('load', function (){
		var pathname = location.pathname;
		var spt = pathname.split('/');
		var vl = spt[2];
		if(vl == 'index.php')
		{
			var tbl = 'tbl_syed_dashboard';
		}
		else{
			var tbl = vl.replace("_view.php", "");
			tbl = 'tbl_'+tbl;
		}
		
		$('#'+tbl).addClass("active");
		$('#'+tbl+'_dv_form').removeClass('col-lg-10').addClass('col-lg-9');
		$('#'+tbl+'_dv_action_buttons').removeClass('col-lg-2').addClass('col-lg-3');
	});
	
	</script>

		</div> 
		<div class="clearfix"></div>
			<?php if(!$_REQUEST['Embedded']){ ?>
				<div style="height: 70px;" class="hidden-print"></div>
			<?php } ?>
		</div> 
		<?php if(is_file(dirname(__FILE__) . '/hooks/footer-extras.php')){ include(dirname(__FILE__).'/hooks/footer-extras.php'); } ?>
		<script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/lightbox.min.js"></script>
	</body>
</html>