<div style="">
    <div id="chart_div0"></div>
    <div id="chart_div1"></div>
    <div id="chart_div2"></div>
    <div id="chart_div3"></div>
    <div id="chart_div4"></div>
    <div id="chart_div5"></div>
    <div id="chart_div6"></div>
    <div id="chart_div7"></div>
    <div id="chart_div8"></div>
    <div id="chart_div9"></div>

    Komentarze:
    <div class="comments" style="text-align: center;margin-left: 50px;">
    
    <?php echo $commentForm->renderFormTag(null, array('id' => 'commentForm'));?>
    <?php echo $commentForm['_csrf_token']->render();?>
        <div class="user" style="text-align: left; margin-left: 20px; margin-top: 40px; font-style: italic"><img style="margin-left:5px; margin-right: 5px; margin-bottom: -4px ;height: 30px" alt="<?php echo $user['first_name'].' '.$user['last_name']; ?>" src="http://graph.facebook.com/<?php echo $user['id']?>/picture?type=small" /><?php echo $user['first_name'].' '.$user['last_name'] ?></div>
        <div><?php echo $commentForm['comment']->render() ?>
        <input type="submit" value="Wyślij" /></div>
    </form>
    <?php foreach ($comments as $comment){ ?>
        <div class="user" style="text-align: left; margin-left: 20px; margin-top: 40px; font-style: italic"><img style="margin-left:5px; margin-right: 5px; margin-bottom: -4px ;height: 30px" alt="<?php echo $comment['Users']['first_name'].' '.$comment['Users']['last_name']?>" src="http://graph.facebook.com/<?php echo $comment['user_id']?>/picture?type=small" /><?php echo $comment['Users']['first_name'].' '.$comment['Users']['last_name'] ?></div>
        <hr />
        <div class="comment" ><?php echo $comment['comment'];?> </div>
        
    <?php } ?>
    </div>
</div>

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      <?php for($id=0;$id<count($result);$id++){ ?>
      google.setOnLoadCallback(drawChart<?php echo $id ?>);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart<?php echo $id; ?>() {
      // Create our data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Odpowiedzi');
      data.addColumn('number', 'Głosy');
      data.addColumn('number', 'średnia');
      
      data.addRows(<?php echo count($result[$id]['QuestionsAnswers'])+$poll['self_answers']; ?>);
        <?php $i=0; foreach($result[$id]['QuestionsAnswers'] as $answer){?>
        data.setValue(<?php echo $i; ?>, 0, '<?php echo $answer['value']; ?>');
        data.setValue(<?php echo $i; ?>, 1, <?php echo count($answer['UsersAnswers']);  ?>);
        data.setValue(<?php echo $i; ?>, 2, <?php echo count($answer['UsersAnswers'])/3;  ?>);
        <?php $i++; }?>
        <?php if ($poll['self_answers']){ ?>
        data.setValue(<?php echo $i; ?>, 0, 'Odpowiedź własna');
        data.setValue(<?php echo $i; ?>, 1, <?php echo count($selfAnswer[0]['UsersAnswers']) ?>);
        data.setValue(<?php echo $i; ?>, 2, <?php echo count($selfAnswer[0]['UsersAnswers'])/3 ?>);
          
        <?php } ?>
      // Instantiate and draw our chart, passing in some options.
      
      var chart = new google.visualization.PieChart(document.getElementById('chart_div<?php echo $id ?>'));
//      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
//      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
//http://code.google.com/intl/pl-PL/apis/chart/interactive/docs/gallery.html
      chart.draw(
        data, 
        {width: 760, height: 350,
        title: '<?php echo $result[$id]['question']; ?>'
        }
      );
    }
    <?php } ?>
        </script>

