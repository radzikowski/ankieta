<div id="userData">
	<span><a href="<?php  echo 'http://www.facebook.com/profile.php?id='.$user['id']; ?>"><?php echo $user['first_name'].' '.$user['last_name'] ?></a></span>
</div>
<div id="storyData">
	<span>Utworzone: <?php echo $user['UsersExplains'][0]['created_at'];?></span><br /><br />
	<h3>Treść: </h3>
	<div class="text">
		<?php echo $user['UsersExplains'][0]['answer_text']; ?>
	</div>
<?php if(!$winner){?>
	<br />
	<a href="<?php echo url_for2('default', array('module' => 'stories', 'action' => 'setWinner'), true).'/userId/'.$user['id'] ;?>"><h1>Ustaw zwycięzce!</h1></a>
<?php }else{?>
	<br />
	<h1>Ten użytkownik znajduje się już na liście zwycięzców</h1>
	<a href="<?php echo url_for2('default', array('module' => 'stories', 'action' => 'removeWinner'), true).'/userId/'.$user['id'] ;?>"><h1>Usuń zwycięzce!</h1></a>
<?php }?>
</div>
