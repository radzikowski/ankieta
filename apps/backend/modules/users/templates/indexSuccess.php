<table id="users">
	<thead>
		<tr class="header">
			<td>Imię</td>
			<td>Nazwisko</td>
			<td>Płeć</td>
			<td>Znajomych</td>
			<td>Data wejścia</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach($users as $key => $user){ ?>
		<tr>
			<td class="firstName"><a href="<?php  echo 'http://www.facebook.com/profile.php?id='.$user['id']; ?>"><?php echo $user['first_name'] ?></a></td>
			<td class="lastName"><a href="<?php  echo url_for2('default', array('module' => 'users', 'action' => 'single'), true).'/id/'.$user['id']; ?>"><?php echo $user['last_name']; ?></a></td>
			<td><?php echo $user['sex'] == 'male' ? 'Mężczyzna':'Kobieta'; ?></td>
			<td><?php echo count(UserService::getUserFriendsIdsArray($users->toArray()->getRaw($key)))?></td>
			<td class="createdAt"><?php echo $user['created_at']; ?></td>
		</tr>
	<?php }?>
	</tbody>
</table>

<?php if($pager->haveToPaginate()){ ?>
	<ul id="pager">
		<?php  echo $pagerLayout->display(); ?>
	</ul>
<?php } ?>