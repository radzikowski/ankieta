<?php echo $addAnswerForm->renderFormTag(null, array('id' => 'addAnswerForm')); ?>
	<h3>Dodaj nową odpowiedź dla pytania:</h3>
	<p><?php echo $question->question ?></p>
	<?php echo $addAnswerForm['_csrf_token']->render(); ?>
	<?php echo $addAnswerForm['id_question']->render() ?>
	<h4>Odpowiedź: </h4>
	<?php echo $addAnswerForm['value']->render() ?>
	<?php if($addAnswerForm['value']->hasError()){ ?>
		<span class="error"><?php echo $addAnswerForm['value']->getError() ?></span>
	<?php } ?>
	<input type="submit" name="saveAnswer" value="Zapisz">
</form>