<div style="min-height: 3000px">
Result
    <div id="chart_div"></div>
    <div id="chart_div2"></div>
</div>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
      google.setOnLoadCallback(drawChart2);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
      // Create our data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Odpowiedźi');
      data.addColumn('number', 'Głosy');
      data.addRows(<?php echo count($result[0]['QuestionsAnswers'])+1; ?>);
        <?php $i=0; foreach($result[0]['QuestionsAnswers'] as $answer){?>
        data.setValue(<?php echo $i; ?>, 0, '<?php echo $answer['value']; ?>');
        data.setValue(<?php echo $i; ?>, 1, <?php echo count($answer['UsersAnswers']) ?>);
        <?php $i++; }?>
        data.setValue(<?php echo $i; ?>, 0, 'Odpowiedź własna');
        data.setValue(<?php echo $i; ?>, 1, <?php echo count($selfAnswer[0]['UsersAnswers']).'.7' ?>);
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
//      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
//      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
//http://code.google.com/intl/pl-PL/apis/chart/interactive/docs/gallery.html
      chart.draw(
        data, 
        {width: 760, height: 350,
        title: '<?php echo $result[0]['question']; ?>'
        }
      );
    }
    
    function drawChart2() {
      // Create our data table.
      var data2 = new google.visualization.DataTable();
      data2.addColumn('string', 'Odpowiedźi');
      data2.addColumn('number', 'Głosy');
      data2.addRows(<?php echo count($result[1]['QuestionsAnswers'])+1; ?>);
        <?php $i=0; foreach($result[1]['QuestionsAnswers'] as $answer){?>
        data2.setValue(<?php echo $i; ?>, 0, '<?php echo $answer['value']; ?>');
        data2.setValue(<?php echo $i; ?>, 1, <?php echo count($answer['UsersAnswers']) ?>);
        <?php $i++; }?>
        data2.setValue(<?php echo $i; ?>, 0, 'Odpowiedź własna');
        data2.setValue(<?php echo $i; ?>, 1, <?php echo count($selfAnswer[1]['UsersAnswers']); ?>);
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
//      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
//      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
//http://code.google.com/intl/pl-PL/apis/chart/interactive/docs/gallery.html
      chart.draw(
        data2, 
        {width: 760, height: 350,
        title: '<?php echo $result[1]['question']; ?>'
        }
      );
    }
    </script>

