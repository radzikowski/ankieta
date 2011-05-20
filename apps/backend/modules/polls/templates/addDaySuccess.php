<div style="margin: 50px">
<?php echo $addDayForm->renderFormTag(null, array('id' => 'addDayForm')); ?>
	<h3>Dzień:</h3>
	
	Numer:<div> <?php echo $addDayForm['day_number']->render() ?></div>
	Podpowiedź:<div> <?php echo $addDayForm['day_tip']->render() ?></div>
	Litera:<div> <?php echo $addDayForm['day_letter']->render() ?></div>
	<h2>Maksymalna szerokość sumaryczna obu zdjęć to 655px, zaś wysokość powinna być równa 255px</h2>
	Podstawowe zdjęcie:<div> <?php echo $addDayForm['image_name']->render() ?></div>
	Dodatowe zdjęcie:<div> <?php echo $addDayForm['image_name2']->render() ?></div>
	
	<?php echo $addDayForm['_csrf_token']->render(); ?>
	<?php if($addDayForm->hasErrors()){?>
	<div class="error">
		<ul>
			<?php foreach($addDayForm->getErrorsArray() as $error){?>
				<li><?php echo $error?></li>
			<?php }?>
		</ul>
	</div>
	<?php }?>
	
	<div style="margin-top: 30px"><input type="submit" value="Zapisz"></div>
</form>
<div style="margin-top:30px; margin-buttom: 30px;"> <a href="<?php echo url_for2('default', array('module' => 'days', 'action' => 'index'),true); ?>">Wróć</a></div>
</div>
