<script type="text/javascript">
$(function() {
	var seriesOptions = [],
		yAxisOptions = [],
		seriesCounter = 0,
		names = ['canreq', 'cansur'],
		colors = Highcharts.getOptions().colors;

	$.each(names, function(i, name) {

		$.getJSON('<?php echo site_url();?>/stats/get_json_req_vs_sur_diario/' + name, function(data) {

			seriesOptions[i] = {
				name: name,
				data: data
			};

			// As we're loading the data asynchronously, we don't know what order it will arrive. So
			// we keep a counter and create the chart when all the data is loaded.
			seriesCounter++;

			if (seriesCounter == names.length) {
				createChart();
			}
		});
	});



	// create the chart when all data is loaded
	function createChart() {

            chart = new Highcharts.StockChart({
		    chart: {
		        renderTo: 'container'
		    },

		    rangeSelector: {
		        selected: 4
		    },

		    yAxis: {
		    	labels: {
		    		formatter: function() {
		    			return this.value;
		    		}
		    	},
		    	plotLines: [{
		    		value: 0,
		    		width: 2,
		    		color: 'silver'
		    	}]
		    },
		    
		    plotOptions: {
		    	series: {
		    	 
		    	}
		    },
		    
		    tooltip: {
		    	pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
		    	valueDecimals: 0,
                ySuffix: ' Pzas.',
		    },
		    
		    series: seriesOptions
		});
	}

});
		</script>
        <script src="<?php echo base_url();?>js/highstock/highstock.js"></script>