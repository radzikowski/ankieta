<?php if(sfContext::getInstance()->getUser()->getFlash('editSuccess') == true){ ?>
	<h3>Pytanie zostało zapisanie poprawnie.</h3>
<?php }?>
<table id="questions" style="width:auto;">
	<thead>
		<tr class="header">
			<td>Dzień</td>
			<td>Numer</td>
			<td>Pytanie</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</thead>
	<tbody">
	<?php foreach($questions as $question){ ?>
		<tr <?php if ($question['QuestionsOrder'][0]['question_number'] == 0){ echo 'style="background-color: silver;"'; } ?> >
			<td><?php echo $question['QuestionsOrder'][0]['day_number']; ?></td>
			<td><?php echo $question['QuestionsOrder'][0]['question_number']+1; ?></td>
			<td class="question"><?php echo $question['question'] ?></td>
			<td><a href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'edit'), true).'?id='.$question->id ?>">Edytuj</a></td>
			<td><a href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'answers'), true).'?id='.$question->id ?>">Odpowiedzi</a></td>
			<td><a href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'deleteQuestion'), true).'?id='.$question->id ?>">Usuń</a></td>
		</tr>
	<?php }?> 
	</tbody>
</table>
<!-- <a style="margin-left:20px; display: block" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'addQuestion'), true)?>">Dodaj pytanie</a>  -->
<?php if($pager->haveToPaginate()){ ?>
		<ul id="pager">
				<?php  echo $pagerLayout->display(); ?>
		</ul>
<?php } ?>