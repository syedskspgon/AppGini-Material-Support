	
	/* Fetching fields w.r.t table */
	$('#card_table').change(function(){

		var table = $(this).val();
		var URL   = './dashboard/others.php';

		$("#card_field1").val("");

		$.ajax({
			url: URL,
			type:'POST',
			dataType: 'json',
			data: {'table':table, 'mode':'fields'},
			success:function(resp){
				$('#card_field1').empty();
				$('#card_field1').append(resp);
			}
		});
	});
