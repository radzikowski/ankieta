<?php echo $deleteDayForm->renderFormTag(null, array('id' => 'deleteDayForm')); ?>
	<h3>Czy na pewno chesz usunąć dzień:</h3>
	<table border="1" id="users" style="width:auto;" >
	<thead>
		<tr class="header">
			<td>Dzien</td>
			<td>Podpowiedź(skrót)</td>
			<td>Litera</td>
			<td>Podstawowy obrazek</td>
			<?php if ($day->image_name2){ ?><td>Dodatkowy obrazek</td><?php }?>			
		</tr>
	</thead>
	<tbody">
		<tr>
			<td class="day"><?php echo $day->day_number ?></td>
			<td class="tip"><?php echo mb_substr($day->day_tip, 0, 120); ?>...</td>
			<td class="letter"><?php echo $day->day_letter ?></td>
			<td class="image"><img src="/uploads/<?php echo $day->image_name ?>" alt="Podstawowy obrazek" width="100px" /></td>
			<?php if ($day->image_name2){ ?> <td class="image"><img src="/uploads/<?php echo $day->image_name2 ?>" alt="Podstawowy obrazek" width="100px" /></td><?php }?>
		</tr>
	</tbody>
</table>

	<?php echo $deleteDayForm['_csrf_token']->render(); ?>
	<?php echo $deleteDayForm['id']->render() ?>
	<a href="<?php echo url_for2('default_index', array('module' => 'days'), true) ?>">Nie, anuluj!</a>
	<input type="submit" name="saveQuestion" value="Tak">
</form>