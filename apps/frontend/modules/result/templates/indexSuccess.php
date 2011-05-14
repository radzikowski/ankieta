<div style="min-height: 400px">
Result
    <div id="chart_div"></div>
</div>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

      // Create our data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Odpowiedźi');
      data.addColumn('number', 'Głosy');
      data.addRows([
        ['a gdy bedzie bardzo dluga odpowiedz i nie wiem co jeszcze', 3],
        ['Onions', 1],
        ['Olives', 1], 
        ['Zucchini', 1],
        ['Pepperoni', 2]
      ]);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
//      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
//      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
//http://code.google.com/intl/pl-PL/apis/chart/interactive/docs/gallery.html
      chart.draw(
        data, 
        {width: 760, height: 350,
        title: 'Toppings I Like On My Pizza'
        }
      );
    }
    </script>

