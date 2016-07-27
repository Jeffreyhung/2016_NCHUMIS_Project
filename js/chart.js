	//chart0
        $(document).ready(function () {

            var dataPoints = [];

            var chart = new CanvasJS.Chart("chart0",
            {
                    data: [
                    {
						type: "pie",
						showInLegend: true,
						legendText: "{indexLabel}",
                        dataPoints: []
                    }]
            });

            $.getJSON("count.php", function (data) {
                for (var i = 0; i < data.length; i++) {

                    dataPoints.push({ label: data[i].indexLabel, y: data[i].y });
                }
                chart.options.data[0].dataPoints = dataPoints;
                chart.render();
            });
        });
	//chart1
		$(document).ready(function () {

            var dataPoints = [];

            var chart = new CanvasJS.Chart("chart1",
            {
                    data: [
                    {
						showInLegend: true,
						legendText: "{indexLabel}",
                        dataPoints: []
                    }]
            });

            $.getJSON("count1.php", function (data) {
                for (var i = 0; i < data.length; i++) {

                    dataPoints.push({ label: data[i].indexLabel, y: data[i].y });
                }
                chart.options.data[0].dataPoints = dataPoints;
                chart.render();
            });
        });
	//chart2
		$(document).ready(function () {

            var dataPoints = [];

            var chart = new CanvasJS.Chart("chart2",
            {
                    data: [
                    {
                        dataPoints: []
                    }]
            });

            $.getJSON("count2.php", function (data) {
                for (var i = 0; i < data.length; i++) {

                    dataPoints.push({ label: data[i].indexLabel, y: data[i].y });
                }
                chart.options.data[0].dataPoints = dataPoints;
                chart.render();
            });
        });