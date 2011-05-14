<div style="margin:20px">
	<h2 style="font-size: 24px; font-weight:bold">Dane zwycięscy:</h2>
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
			<tr>
				<td class="firstName"><a href="<?php  echo 'http://www.facebook.com/profile.php?id='.$user['id']; ?>"><?php echo $user['first_name'] ?></a></td>
				<td class="lastName"><a href="<?php  echo url_for2('default', array('module' => 'users', 'action' => 'single'), true).'/id/'.$user['id']; ?>"><?php echo $user['last_name']; ?></a></td>
				<td class="lastName"><?php echo mb_substr($user['UsersExplains'][0]['answer_text'], 0, 320); ?></td>
				<td class="createdAt"><?php echo $user['UsersExplains'][0]['created_at']; ?></td>
				<td><a href="<?php  echo url_for2('default', array('module' => 'stories', 'action' => 'single'), true).'/id/'.$user['id']; ?>">Szczegóły</a></td>
			</tr>
		</tbody>
	</table>
	
<?php echo $setWinnerForm->renderFormTag(null); ?>
	<?php echo $setWinnerForm; ?>
	<a href="<?php  echo url_for2('default', array('module' => 'stories', 'action' => 'index'), true);?>">Wróć do historii</a>
	<input type="submit" value="Ustaw jako zwycięsce" />
</form>
</div>