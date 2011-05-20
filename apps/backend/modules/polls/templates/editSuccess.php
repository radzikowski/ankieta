<div style="margin: 50px">
<?php echo $editForm->renderFormTag(null, array('id' => 'editDay')); ?>
	<h3>Dzień:</h3>
	<?php echo $editForm['_csrf_token']->render(); ?>
	Numer: <div>
	<?php echo $editForm['day_number']->render() ?>
	<?php if ($editForm['day_number']->hasError()){ ?>
		<span class="error"><?php echo $editForm['day_number']->getError(); ?></span>
	<?php } ?>
	</div>
	Podpowiedź: <div>
	<?php echo $editForm['day_tip']->render() ?>
	<?php if ($editForm['day_tip']->hasError()){ ?>
		<span class="error"><?php echo $editForm['day_tip']->getError(); ?></span>
	<?php } ?>
	</div>
	Litera: <div>
	<?php echo $editForm['day_letter']->render() ?>
	<?php if ($editForm['day_letter']->hasError()){ ?>
		<span class="error"><?php echo $editForm['day_letter']->getError(); ?></span>
	<?php } ?>
	<h2>Maksymalna szerokość sumaryczna obu zdjęć to 655px, zaś wysokość powinna być równa 255px</h2>
	</div>Podstawowe zdjęcie
	<div><img src="/uploads/<?php echo $day['image_name']; ?>" />
	<?php echo $editForm['image_name']->render() ?>
	<?php if ($editForm['image_name']->hasError()){ ?>
		<span class="error"><?php echo $editForm['image_name']->getError(); ?></span>
	<?php } ?>
	</div>Dodatowe zdjęcie
	<div><?php if ($day['image_name2']){ ?><img src="/uploads/<?php echo $day['image_name2']; ?>" /> <a href="<?php echo url_for2('default', array('module' => 'days', 'action' => 'deleteImage' ),true).'?id='.$editForm['day_number']->getValue(); ?>">Usuń zdjęcie</a><?php }?>
	<?php echo $editForm['image_name2']->render() ?>
	<?php if ($editForm['image_name2']->hasError()){ ?>
		<span class="error"><?php echo $editForm['image_name2']->getError(); ?></span>
	<?php } ?>
	</div>
	
	<div style="margin-top: 30px"><input type="submit" value="Zapisz"></div>
</form>
<div style="margin-top:30px; margin-buttom: 30px;"> <a href="<?php echo url_for2('default', array('module' => 'days', 'action' => 'index'),true); ?>">Wróć do pytań</a></div>
</div>