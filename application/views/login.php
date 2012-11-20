<!doctype html>
<!--[if lt IE 8 ]><html lang="en" class="no-js ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie"><![endif]-->
<!--[if (gt IE 8)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title><?php ECHO TITULO_WEB;?></title>
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!-- Global stylesheets -->
	<link href="<?php echo base_url();?>css/reset.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/common.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/form.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/standard.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/special-pages.css" rel="stylesheet" type="text/css">
	
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>favicon.ico">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>favicon-large.png">
	
	<!-- Modernizr for support detection, all javascript libs are moved right above </body> for better performance -->
	<script src="<?php echo base_url();?>js/libs/modernizr.custom.min.js"></script>
	
</head>

<!-- the 'special-page' class is only an identifier for scripts -->
<body class="special-page login-bg dark">

	<section id="message">
		<div class="block-border"><div class="block-content no-title dark-bg">
			<p class="mini-infos">Recuerda utilizar min&uacute;sculas solamente</p>
		</div></div>
	</section>
	
	<section id="login-block">
		<div class="block-border"><div class="block-content">
			
			<!--
			IE7 compatibility: if you want to remove the <h1>, 
			add style="zoom:1" to the above .block-content div
			-->
			<h1>FENIX</h1>
			<div class="block-header">Entrar al Sistema</div>
				
            <?php echo form_open('login/submit', array('class' => 'form with-margin', 'name' => 'login-form', 'id' => 'login-form'));?>
			
				<input type="hidden" name="a" id="a" value="send">
				<p class="inline-small-label">
					<label for="login"><span class="big">Usuario:</span></label>
					<input type="text" name="login" id="login" class="full-width" value="">
				</p>
				<p class="inline-small-label">
					<label for="pass"><span class="big">Password:</span></label>
					<input type="password" name="pass" id="pass" class="full-width" value="">
				</p>
				
				<button type="submit" class="float-right">Ingresar</button>
			<?php echo form_close();?>
            
            <?php echo form_open('login/olvide_password', array('class' => 'form', 'name' => 'password-recovery', 'id' => 'password-recovery'));?>
			
				<fieldset class="grey-bg no-margin collapse">
					<legend><a href="#">Perdiste tu Password?</a></legend>
					<p class="input-with-button">
						<label for="recovery-mail">Ingresa tu e-mail</label>
						<input type="email" name="recovery-mail" id="recovery-mail" value="">
						<button type="button">Enviar</button>
					</p>
				</fieldset>

			<?php echo form_close();?>

		</div></div>
	</section>
	
	<!--
	
	Updated as v1.5:
	Libs are moved here to improve performance
	
	-->
	
	<!-- Generic libs -->
	<script src="<?php echo base_url();?>js/libs/jquery-1.6.3.min.js"></script>
	<script src="<?php echo base_url();?>js/old-browsers.js"></script>		<!-- remove if you do not need older browsers detection -->
	
	<!-- Template libs -->
	<script src="<?php echo base_url();?>js/common.js"></script>
	<script src="<?php echo base_url();?>js/standard.js"></script>
	<!--[if lte IE 8]><script src="js/standard.ie.js"></script><![endif]-->
	<script src="<?php echo base_url();?>js/jquery.tip.js"></script>
	
	<!-- example login script -->
	<script>
	
		$(document).ready(function()
		{
		  $('#login').focus();

		});
	
	</script>
	
</body>
</html>
