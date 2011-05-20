<?php if(count($answersCollectionForm) > 1){ ?>
<?php echo $answersCollectionForm->renderFormTag(null, array('id' => 'answersForm'));?>
<?php echo $answersCollectionForm['_csrf_token']->render();?>
<?php $i = 0; ?>
<span class="question"><h3>Pytanie: <?php echo $question->question; ?></h3></span>
	<ol>
		<?php foreach($answersCollectionForm as $answerForm){ ?>
			<?php if(get_class($answerForm) === 'sfFormFieldSchema'){ ?>
				<li>
							<?php echo $answerForm['id']->render()?>
							<?php echo $answerForm['value']->render()?>
							<?php if ($question['answer_id'] != $answerForm['id']->getValue()){?>
								<a class="correctAnswer" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'setCorrectAnswer'), true).'?questionId='.$question->id.'&answerId='.$answerForm['id']->getValue() ?>">Ustaw jako poprawną</a>
							<?php }else{?>
								<a class="correctAnswer" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'delCorrectAnswer'), true).'?questionId='.$question->id; ?>">Ustaw jako nie poprawną</a>
							<?php }?> | 
							<a class="deleteAnswer" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'deleteAnswer'), true).'?questionId='.$question->id.'&answerId='.$answerForm['id']->getValue() ?>">Usuń tę odpowiedź</a>
				</li>
			<?php $i++; }?>
		<?php }?>
	</ol>
<input type="submit" value="Zapisz">
</form>
<?php }else{?>
	<h2 style="margin: 20px;">To pytanie nie posiada jeszcze odpowiedzi!</h2>
<?php } ?>

<?php if(count($answersCollectionForm) <= 3){ ?>
<a class="addAnswer" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'addAnswer'), true).'?questionId='.$question->id ?>">Dodaj nową odpowiedź</a>
<?php }?>
<br />
<br />
<a class="addQuestion" style="margin: 20px;" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'dayQuestions'), true).'?nr='.$dayNumber ?>">Wróć do pytań</a>

<script>
$('.deleteAnswer').live('click', function(){
	if (!confirm("Czy na pewno usunąć tą odpowiedź?"))
		return false;
});
</script>