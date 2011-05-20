<div id="resultSingleModule">
    <a href="<?php echo url_for2('default', array('module' => 'result', 'action'=> 'index'), true); ?>"><div style="text-align: left">wróć</div></a>
    <a href="<?php echo url_for2('poll', array('name' => $poll['name']), true); ?>"><div class="tittle"><?php echo $poll['name'];  ?></div></a>
    <div class="charts">
    <?php for($i=0;$i<count($result);$i++){ ?>
        <?php if ($poll['type'] == 'points'){ ?>
        <div class="tittle<?php echo $i?>"></div><table><tr><td width="300px"><div id="chart_div<?php echo $i?>"></div></td><td width="300px;"><div id="table<?php echo $i ?>"></div></td></tr></table>
        <?php }else{ ?>
        <div class="tittle<?php echo $i?>"></div><div id="chart_div<?php echo $i ?>"></div>
    <?php } ?>
    <?php } ?>

        
    </div>
    
    <?php if(isset($bestAnswers) && count($bestAnswers)){ ?>
    <div class="usersAnswers" style="font-weight: bold;">
        Najciekawsze odpowiedzi własne
    <?php $i=1; foreach($bestAnswers as $question){ ?>
        <div class="" style="font-weight: normal; text-align: left">
            <?php if (count($question['BestAnswers'])){ echo $i.'. '.$question['question'];} ?>
        </div>
        <? foreach($question['BestAnswers'] as $bestAnswer){ ?>
        <div class="" style="font-weight: normal; text-align: left">
            <img class="userImage" alt="<?php echo $bestAnswer['Users']['first_name'].' '.$bestAnswer['Users']['last_name']?>" src="http://graph.facebook.com/<?php echo $bestAnswer['user_id']?>/picture?type=small" /><i><?php echo $bestAnswer['Users']['first_name'].' '.$bestAnswer['Users']['last_name'] ?>:
        </i>odpowiedział/a:
        <?php echo $bestAnswer['answer_text'];?>
        </div>
    <?php } $i++; } ?>
    </div>
    <?php } ?>
    
    <div style='margin-top: 30px; font-weight: bold'>Komentarze:</div>
    <div class="comments">
    
    <?php echo $commentForm->renderFormTag(null, array('id' => 'commentForm'));?>
    <?php echo $commentForm['_csrf_token']->render();?>
        <div class="user" ><img class="userImage" alt="<?php echo $user['first_name'].' '.$user['last_name']; ?>" src="http://graph.facebook.com/<?php echo $user['id']?>/picture?type=small" /><?php echo $user['first_name'].' '.$user['last_name'] ?></div>
        <div><?php echo $commentForm['comment']->render() ?>
        <input type="submit" value="Wyślij" /></div>
    </form>
    <?php foreach ($comments as $comment){ ?>
        <div class="user" ><img class="userImage" alt="<?php echo $comment['Users']['first_name'].' '.$comment['Users']['last_name']?>" src="http://graph.facebook.com/<?php echo $comment['user_id']?>/picture?type=small" /><?php echo $comment['Users']['first_name'].' '.$comment['Users']['last_name'] ?></div>
        <hr />
        <div class="comment" ><?php echo $comment['comment'];?> </div>
        
    <?php } ?>
    </div>
    <div style="height: 200px"></div>
</div>

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1', {'packages':['corechart','table']});
      
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
      <?php if ($poll['type'] == 'points'){ ?>
      data.addColumn('number', 'Średnia');
      <?php } ?>
      data.addRows(<?php echo count($result[$id]['QuestionsAnswers'])+$poll['self_answers']; ?>);
        <?php $i=0; foreach($result[$id]['QuestionsAnswers'] as $answer){?>
            data.setValue(<?php echo $i; ?>, 0, '<?php echo $answer['value']; ?>');
            data.setValue(<?php echo $i; ?>, 1, <?php echo count($answer['UsersAnswers']);  ?>);
        <?php if ($poll['type'] == 'points'){ ?>
            <?php $sum=0; foreach($answer['UsersAnswers'] as $one){ $sum += (int)$one['points']; } ?>
                data.setValue(<?php echo $i; ?>, 2, <?php if (count($answer['UsersAnswers'])){ echo $sum/(count($answer['UsersAnswers'])); }else { echo '0';} ?>);
            <?php } ?>
        <?php $i++; }?>
        
        <?php if ($poll['self_answers']){ ?>
            data.setValue(<?php echo $i; ?>, 0, 'Odpowiedź własna');
            data.setValue(<?php echo $i; ?>, 1, <?php echo count($selfAnswer[$id]['UsersAnswers']) ?>);
        <?php if ($poll['type'] == 'points'){ ?>
            <?php $sum=0; foreach($selfAnswer[$id]['UsersAnswers'] as $one){ $sum += (int)$one['points']; } ?>
                data.setValue(<?php echo $i; ?>, 2, <?php if (count($selfAnswer[$id]['UsersAnswers'])){echo $sum/count($selfAnswer[$id]['UsersAnswers']); }else{echo '0';} ?>);
            <?php } ?>
        <?php } ?>  
      // Instantiate and draw our chart, passing in some options.
      $('.charts .tittle<?php echo $id ?>').append('<?php echo $result[$id]['question']; ?>')
      //var dashboard = new google.visualization.Dashboard(document.getElementById('chart_div<?php echo $id ?>'));
      var chart = new google.visualization.PieChart(document.getElementById('chart_div<?php echo $id ?>'));
//      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
//      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
//http://code.google.com/intl/pl-PL/apis/chart/interactive/docs/gallery.html
      chart.draw(
        data, 
        {   
            width: <?php echo ($poll['type'] == 'points')? '400' : '760'; ?>, 
            height: 300,
            //title: '<?php echo $result[$id]['question']; ?>',
            //pieSliceText: 'value',
            chartArea:{ left:0,top:10,width:"100%",height:"70%"}
        }
      );
      
     <?php if ($poll['type'] == 'points'){ ?>
     var table = new google.visualization.Table(document.getElementById('table<?php echo $id ?>'));
      table.draw(data, {width: 300});
    <?php } ?>
    
    }
    <?php } ?>
        </script>

