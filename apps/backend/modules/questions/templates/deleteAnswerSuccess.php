<?php echo $deleteAnswerForm->renderFormTag(null, array('id' => 'deleteAnswerForm')); ?>
	<h3>Czy na pewno chesz usunąć odpowiedź:</h3>
	<p><?php echo $answer->value; ?></p>
	<h3>Dla pytania </h3>
	<p><?php echo $question->question ?></p>
	<?php echo $deleteAnswerForm['_csrf_token']->render(); ?>
	<?php echo $deleteAnswerForm['id']->render() ?>
	<a href="<?php echo url_for2('default_index', array('module' => 'questions'), true) ?>">Nie, anuluj!</a>
	<input type="submit" name="saveQuestion" value="Tak">
</form>