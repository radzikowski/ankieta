<table id="users">
	<thead>
		<tr class="header">
			<td>Imię (profil fb)</td>
			<td>Nazwisko (szczegóły)</td>
			<td>Historia (skrót)</td>
			<td>Data utworzenia</td>
			<td>Szczegóły</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach($stories as $key => $story){ ?>
		<tr <?php if(array_key_exists($story['Users']['id'], $sf_data->getRaw('winners')->toArray())){echo 'class="winner"';}?>>
			<td class="firstName"><a href="<?php  echo 'http://www.facebook.com/profile.php?id='.$story['Users']['id']; ?>"><?php echo $story['Users']['first_name'] ?></a></td>
			<td class="lastName"><a href="<?php  echo url_for2('default', array('module' => 'users', 'action' => 'single'), true).'/id/'.$story['Users']['id']; ?>"><?php echo $story['Users']['last_name']; ?></a></td>
			<td class="lastName"><?php echo mb_substr($story['answer_text'], 0, 320); ?></td>
			<td class="createdAt"><?php echo $story['created_at']; ?></td>
			<td><a href="<?php  echo url_for2('default', array('module' => 'stories', 'action' => 'single'), true).'/id/'.$story['Users']['id']; ?>">Szczegóły</a></td>
		</tr>
	<?php }?>
	</tbody>
</table>

<?php if($pager->haveToPaginate()){ ?>
	<ul id="pager">
		<?php  echo $pagerLayout->display(); ?>
	</ul>
<?php } ?>