google.load("visualization", "1", {packages: ["corechart"]});

$(function() {
	
	$.ajax({
		type: "POST",
		url: "dashboard/cuponesComercio",
		dataType:'json',
		success: function(data){
			
	    	var arrayD = new Array();
	    	arrayD.push(['Comercios', 'Cupones']);
	    	for(var i = 0; i < data.length; i++){
	    		arrayD.push([data[i].nombre, parseInt(data[i].total)]);
	    	}
	    	
	        var options = {
	            title: 'Cupones x Comercio',
	            legend: 'none',
	            pieSliceText: 'label',
	            slices: {4: {offset: 0.2},
	                12: {offset: 0.3},
	                14: {offset: 0.4},
	                15: {offset: 0.5},
	            },
	        };
	        var data1 = google.visualization.arrayToDataTable(arrayD);
	        var chart1 = new google.visualization.PieChart(document.getElementById('piechart'));
	        chart1.draw(data1, options);
		}
	});

	$.ajax({
		type: "POST",
		url: "dashboard/cuponesIndustria",
		dataType:'json',
		success: function(data){
			var arrayD = new Array();
	    	arrayD.push(['Industrias', 'Cupones']);
	    	for(var i = 0; i < data.length; i++){
	    		arrayD.push([data[i].nombre, parseInt(data[i].total)]);
	    	}

	        var options = {
	            title: 'Cupones x Industria'
	        };
	        var data2 = google.visualization.arrayToDataTable(arrayD);
	        var chart2 = new google.visualization.PieChart(document.getElementById('piechart12'));
	        chart2.draw(data2, options);
		}
	});
	
	$.ajax({
		type: "POST",
		url: "dashboard/cuponesTipo",
		dataType:'json',
		success: function(data){
			$("#tipo0").html(parseInt(data[0].total) + parseInt(data[1].total));
			$("#tipo1").html(parseInt(data[0].total));
			$("#tipo2").html(parseInt(data[1].total));
		}
	});

});
