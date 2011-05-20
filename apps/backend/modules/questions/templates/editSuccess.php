<?php echo $editForm->renderFormTag(null, array('id' => 'editQuestion')); ?>
	<h3>Pytanie:</h3>
	<?php echo $editForm['_csrf_token']->render(); ?>
	<?php echo $editForm['id']->render() ?>
	<?php echo $editForm['question']->render() ?>
	<?php if ($editForm['question']->hasError()){ ?>
		<span class="error"><?php echo $editForm['question']->getError(); ?></span>
	<?php } ?>
	<input type="submit" name="saveQuestion" value="Zapisz">
</form>