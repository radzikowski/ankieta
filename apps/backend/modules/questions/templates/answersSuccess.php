<?php if(count($answersCollectionForm) > 1){ ?>
<?php echo $answersCollectionForm->renderFormTag(null, array('id' => 'answersForm'));?>
<?php echo $answersCollectionForm['_csrf_token']->render();?>
<?php $i = 0; ?>
<span class="question"><h3>Pytanie: <?php echo $question->question; ?></h3></span>
	<ul>
		<?php foreach($answersCollectionForm as $answerForm){ ?>
			<?php if(get_class($answerForm) === 'sfFormFieldSchema'){ ?>
				<li>
							<?php echo $answerForm['id']->render()?>
							<?php echo $answerForm['value']->render()?>
							<a class="deleteAnswer" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'deleteAnswer'), true).'?questionId='.$question->id.'&answerId='.$answerForm['id']->getValue() ?>">Usuń tą odpowiedź</a>
				</li>
			<?php $i++; }?>
		<?php }?>
	</ul>
<input type="submit" value="Zapisz">
</form>
<?php }else{?>
	<h2 style="margin: 20px;">To pytanie nie posiada jeszcze odpowiedzi!</h2>
<?php } ?>
<a class="addAnswer" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'addAnswer'), true).'?questionId='.$question->id ?>">Dodaj nową odpowiedź</a>

<script>
$('.deleteAnswer').live('click', function(){
	if (!confirm("Czy na pewno usunąć tą odpowiedź?"))
		return false;
});
</script>