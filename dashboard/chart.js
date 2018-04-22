
	$('#chart_table').change(function(){
	
		var table = $(this).val();
		var URL   = './dashboard/others.php';

		$("#chart_field1").val("");
		$("#chart_field2").val("");
					

		$.ajax({
			url: URL,
			type:'POST',
			dataType: 'json',
			data: {'table':table, 'mode':'double'},
			success:function(resp){

				$('#chart_field1').empty();
				$('#chart_field1').append(resp.options);

				$('#chart_field2').empty();
				$('#chart_field2').append(resp.options2);

			}

		});

	});

	function setHighestValue(mn){

		var xr = '';
		var ln = mn.toString().length;
		
		for(var i=1;i<=ln;i++){
			xr = xr+'0';
		}
		
		xr = '1'+xr;
		
		var ks = xr/2;
		
		if(mn < xr && mn > ks)
			return xr;
		 else
			return ks;
			
	}
	
	function lineChart(chartid, days, sales){
         
        dataDailySalesChart = {
            labels: days,
            series: [
                sales
            ]
        };
		
		var hx = Math.max.apply(Math,sales);
		var hs = setHighestValue(hx);
		var ts = sales[sales.length-1];
		$('#today_sales_'+chartid).html(ts);
		

        optionsDailySalesChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: hs,
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            },
        }

        var dailySalesChart = new Chartist.Line('#charts_'+chartid, dataDailySalesChart, optionsDailySalesChart);

        md.startAnimationForLineChart(dailySalesChart);
    }
	
	function barChart(chartid, months, monthly_revenue){

        var dataEmailsSubscriptionChart = {
            labels: months,
            series: [
                monthly_revenue
            ]
        };

        var hx = Math.max.apply(Math,monthly_revenue);
		var hs = setHighestValue(hx);

		var ts = monthly_revenue[monthly_revenue.length-1];
		$('#today_sales_'+chartid).html(ts);

        var optionsEmailsSubscriptionChart = {
            axisX: {
                showGrid: false
            },
            low: 0,
            high: hs,
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        };
        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function(value) {
                        return value[0];
                    }
                }
            }]
        ];
        var emailsSubscriptionChart = Chartist.Bar('#charts_'+chartid, dataEmailsSubscriptionChart, optionsEmailsSubscriptionChart, responsiveOptions);

        //start animation for the Emails Subscription Chart
        md.startAnimationForBarChart(emailsSubscriptionChart);
	}

	jQuery(document).ready(function(){

		$.ajax({
			url: './dashboard/app-charts.php',
			dataType: 'json',
			success:function(resp){ 

				var wdata = resp.line;
				var mdata = resp.bar;
				if(wdata != ''){
					
					for(x in wdata){
						var ch = wdata[x];

						var chartid = ch.chartid;
						var duration= ch.duration;
						var sales 	= ch.sales;
						var color = ch.color;
						var title = ch.title;
						var extra = ch.extra;

						$('#chart_title_'+chartid).html(title);
						$('#chart_extra_'+chartid).html(extra);
						$('#chart_color_'+chartid).attr('data-background-color', color);
						$('#span_color_'+chartid).css('color', color);
						lineChart(chartid, duration, sales);

						
					}
				}

				if(mdata != ''){

					for(y in mdata){
						var mh = mdata[y];

						var mchartid = mh.chartid;
						var duration= mh.duration;
						var msales 	 = mh.sales;
						var mcolor   = mh.color;
						var mtitle   = mh.title;
						var mextra   = mh.extra;

						$('#chart_title_'+mchartid).html(mtitle);
						$('#chart_extra_'+mchartid).html(mextra);
						$('#chart_color_'+mchartid).attr('data-background-color', mcolor);
						$('#span_color_'+mchartid).css('color', mcolor);
						barChart(mchartid, duration, msales);
	
					}
				}
			}
		});

	});

	

