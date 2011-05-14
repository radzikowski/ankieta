<?php if(sfContext::getInstance()->getUser()->getFlash('editSuccess') == true){ ?>
	<h3>Pytanie zostało zapisanie poprawnie.</h3>
<?php }?>
<table id="questions" style="width:auto;">
	<thead>
		<tr class="header">
			<td>Pytanie</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</thead>
	<tbody">
	<?php foreach($questions as $question){ ?>
		<tr>
			<td class="question"><?php echo $question->question ?></td>
			<td><a href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'edit'), true).'?id='.$question->id ?>">Edytuj</a></td>
			<td><a href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'answers'), true).'?id='.$question->id ?>">Odpowiedzi</a></td>
			<td><a href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'deleteQuestion'), true).'?id='.$question->id ?>">Usuń</a></td>
		</tr>
	<?php }?> 
	</tbody>
</table>
<a style="margin-left:20px; display: block" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'addQuestion'), true)?>">Dodaj pytanie</a>
<a style="margin-left:20px; display: block" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'editResults'), true)?>">Edytuj wyniki quizu</a>
<?php if($pager->haveToPaginate()){ ?>
		<ul id="pager">
				<?php  echo $pagerLayout->display(); ?>
		</ul>
<?php } ?>