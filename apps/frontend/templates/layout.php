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
     <div id="fb-root"></div>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId : '<?php echo sfConfig::get('app_facebook_app_id'); ?>',
				session : <?php echo json_encode(sfContext::getInstance()->get('fbSession')); ?>, // don't refetch the session when PHP already has it
				status : true, // check login status
				cookie : true, // enable cookies to allow the server to access the session
				xfbml : true // parse XFBML
			});

			setInterval(function(){FB.Canvas.setSize({ width: 760, height: $('#mainContainer').height()})},72);


			// whenever the user logs in, we refresh the page
			FB.Event.subscribe('auth.login', function() {
				//window.location.reload();
			});
			
		};
		(function() {
			var e = document.createElement('script');
			e.src = document.location.protocol + '//connect.facebook.net/pl_PL/all.js';
			e.async = true;
			document.getElementById('fb-root').appendChild(e);
		}());

	</script>
  	<div id="mainContainer">
  		 <?php echo $sf_content ?>
  	</div>
  </body>
</html>
