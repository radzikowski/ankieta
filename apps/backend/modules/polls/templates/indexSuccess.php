<?php if(sfContext::getInstance()->getUser()->getFlash('editSuccess') == true){ ?>
	<h3>Kolejny dzień został zapisany poprawnie.</h3>
<?php }?>
<a href="<?php echo url_for2('default', array('module' => 'days', 'action' => 'setTime'),true); ?>"><h2 style="margin: 30px">Zmień daty konkursu</h2></a>

<table id="users" style="width:auto;" >
	<thead>
		<tr class="header">
			<td>id</td>
			<td>Nazwa (adres URL)</td>
			<td>Typ</td>
			<td>Layout</td>
			<td>Własne odpowiedzi?</td>			
			<td>Część demograficzna</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</thead>
	<tbody">
	<?php foreach($polls as $poll){ ?>
		<tr>
			<td class=""><?php echo $poll->id; ?></td>
			<td class=""><?php echo $poll->name; ?></td>
			<td class=""><?php echo ($poll->type == 'radio') ? 'Jedna odpowiedź' : (($poll->type == 'check') ? 'Wiele odpowiedzi' : 'Punktacja') ?></td>
			<td class="">brak</td>
			<td class=""><?php echo ($poll->self_answers)? 'tak' : 'nie'; ?></td>
                        <td class=""><?php echo ($poll->demographic)? 'tak' : 'nie'; ?></td>
                        
			<td><a href="<?php echo url_for2('default', array('module' => 'polls', 'action' => 'edit'), true).'?id='.$poll->id ?>">Edytuj</a></td>
			<td><a href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'dayQuestions'), true).'?id='.$poll->id ?>">Pokaż pytania</a></td>
			<td><a href="<?php echo url_for2('default', array('module' => 'polls', 'action' => 'deletePoll'), true).'?id='.$poll->id ?>">Usuń</a></td>
		</tr>
	<?php }?> 
	</tbody>
</table>
<a style="margin-left:20px; margin-bottom:50px; display: block" href="<?php echo url_for2('default', array('module' => 'polls', 'action' => 'addPoll'), true)?>">Dodaj kolejną ankietę</a>
<?php if($pager->haveToPaginate()){ ?>
		<ul id="pager">
				<?php  echo $pagerLayout->display(); ?>
		</ul>
<?php } ?>