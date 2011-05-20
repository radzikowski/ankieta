<?php echo $addQuestionForm->renderFormTag(null, array('id' => 'addQuestionForm')); ?>
	<h3>Dodaj nowe pytanie<?php if ($dayNumber){ echo ' dla dnia numer '.$dayNumber; }?>:</h3>
	<?php echo $addQuestionForm['_csrf_token']->render(); ?>
	<?php echo $addQuestionForm['question']->render() ?>
	<?php if($addQuestionForm['question']->hasError()){ ?>
		<span class="error"><?php echo $addQuestionForm['value']->getError() ?></span>
	<?php } ?>
	<input type="submit" name="saveAnswer" value="Zapisz">
</form>