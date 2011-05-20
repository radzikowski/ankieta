<?php echo $deleteQuestionForm->renderFormTag(null, array('id' => 'deleteAnswerForm')); ?>
	<h3>Czy na pewno chesz usunąć pytanie:</h3>
	<p><?php echo $question->question; ?></p>
	<?php echo $deleteQuestionForm['_csrf_token']->render(); ?>
	<?php echo $deleteQuestionForm['id']->render() ?>
	<a href="<?php echo url_for2('default_index', array('module' => 'questions'), true) ?>">Nie, anuluj!</a>
	<input type="submit" name="saveQuestion" value="Tak">
</form>