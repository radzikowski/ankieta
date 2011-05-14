<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
   	  <ul id="menu">
		  <li><a href="<?php echo url_for2('default_index', array('module' => 'users'), true) ?>">Użytkownicy</a></li>
		  <li><a href="<?php echo url_for2('default_index', array('module' => 'stories'), true) ?>">Historie</a></li>
<!--		  <li><a href="<?php // echo url_for2('default_index', array('module' => 'questions'), true) ?>">Pytania (odpowiedzi)</a></li>-->
		  <li style="float:right"><a href="<?php echo url_for2('default', array('module' => 'login', 'action'=>'logout'), true) ?>">Wyloguj</a></li>
	  </ul>
    <?php echo $sf_content ?>
  </body>
</html>
