<?php echo $setTimeForm->renderFormTag(null, array('style' => 'margin: 20px;')); ?>
<div>Data startu: <?php echo $setTimeForm['start_time']->render(); ?></div>
<div>Data końca: <?php echo $setTimeForm['end_time']->render(); ?></div>

<?php echo $setTimeForm['_csrf_token']->render(); ?>
<?php if($setTimeForm->hasErrors()){?>
	<div class="error">
		<ul>
			<?php foreach($setTimeForm->getErrorsArray() as $error){?>
				<li><?php echo $error?></li>
			<?php }?>
		</ul>
	</div>
<?php }?>
<input type="submit" value="Wyślij" />
</form>
