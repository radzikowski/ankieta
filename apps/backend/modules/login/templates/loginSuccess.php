<div id="container" style="width: 500px; margin: 40px auto">
	<div class="info">Jeśli potrzebujesz hasła skontaktuj sie z administratorem</div>
	<?php echo $loginForm->renderFormTag(null, array('style' => 'width: 220px; margin: 0 auto')); ?>
		Login: <?php echo $loginForm['username']->render(); ?><br />
		<?php if($loginForm['username']->hasError()){?><div class="error"><?php echo $loginForm['username']->getError();?></div><?php }?>
		Hasło: <?php echo $loginForm['password']->render(); ?><br />
		<?php if($loginForm['password']->hasError()){?><div class="error"><?php echo $loginForm['password']->getError();?></div><?php }?>
		<?php echo $loginForm['_csrf_token']->render(); ?><br />
		<input type="submit" value="Zaloguj" />
	</form>

	<?php if($error){?>
		<div class="error" style="margin-top: 20px; text-align:center">
			<h1><?php echo $error; ?></h1>
		</div>
	<?php }?>
</div>