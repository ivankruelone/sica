<!doctype html>
<!--[if lt IE 8 ]><html lang="en" class="no-js ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie"><![endif]-->
<!--[if (gt IE 8)|!(IE)]><!--><html lang="es" class="no-js"><!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title><?php ECHO TITULO_WEB;?></title>
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!--
	
	Note: this file is a variant of the main index.html file,
	just to show the markup required to use the aletrnative menu style
	See documentation for more details
	
	-->
	
	<!-- Global stylesheets -->
	<link href="<?php echo base_url();?>css/reset.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/common.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/form.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/standard-alt.css" rel="stylesheet" type="text/css">
	
	<!-- Comment/uncomment one of these files to toggle between fixed and fluid layout -->
	<!--<link href="css/960.gs.css" rel="stylesheet" type="text/css">-->
	<link href="<?php echo base_url();?>css/960.gs.fluid.css" rel="stylesheet" type="text/css">
	
	<!-- Custom styles -->
	<link href="<?php echo base_url();?>css/simple-lists.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/block-lists.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/planning.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/table.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/calendars.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/wizard.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/gallery.css" rel="stylesheet" type="text/css">
	
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>favicon.ico">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>favicon-large.png">
	
	<!-- Modernizr for support detection, all javascript libs are moved right above </body> for better performance -->
	<script src="<?php echo base_url();?>js/libs/modernizr.custom.min.js"></script>
	
</head>

<body>
	
	<!-- Header -->
	
	<!-- Server status -->
	<header>
    </header>
	<!-- End server status -->
	
	<!-- Sub nav -->
    <?php $this->load->view('menu');?>
	<!-- End sub nav -->
	
	<!-- Status bar -->
	<div id="status-bar">
        <div class="container_12">
	
    		<ul id="status-infos">
                <li><img src="<?php echo base_url();?>images/iqfa.png" width="40px"/></li>
                <li class="spaced">CENTRO DE ATENCION TELEFONICA | </li>
    			<li class="spaced">Ingreso al Sistema como: <strong><?php echo $this->session->userdata('nombre');?></strong></li>
    			<li><?php echo anchor('login/logout', '<span class="smaller">CERRAR SESION</span>', 'class="button red" title="Cerrar Sesi&oacute;n"');?></li>
    		</ul>
    		
    	</div>
     </div>
	<!-- End status bar -->
	
	<div id="header-shadow"></div>
	<!-- End header -->
	
	
	<!-- Content -->
	<article class="container_12">
		

		<?php
        
        if(isset($contenido))
        {
            $this->load->view($contenido);
        }
        
        ?>

		
		<div class="clear"></div>
		
	</article>
	
	<!-- End content -->
	
	<footer>
		
		<div class="float-right">
			<a href="#top" class="button"><img src="<?php echo base_url();?>images/icons/fugue/navigation-090.png" width="16" height="16" /> Arriba</a>
		</div>
		
	</footer>
	
	<!--
	
	Updated as v1.5:
	Libs are moved here to improve performance
	
	-->
	
	<!-- Generic libs -->
	<script src="<?php echo base_url();?>js/libs/jquery-1.6.3.min.js"></script>
	<script src="<?php echo base_url();?>js/libs/jquery.hashchange.js"></script>
	<script src="<?php echo base_url();?>js/libs/modernizr.custom.min.js"></script>
	
	<!-- Template libs -->
	<script src="<?php echo base_url();?>js/jquery.accessibleList.js"></script>
	<script src="<?php echo base_url();?>js/common.js"></script>
	<script src="<?php echo base_url();?>js/standard.js"></script>
	<script src="<?php echo base_url();?>js/jquery.tip.js"></script>
	<script src="<?php echo base_url();?>js/jquery.contextMenu.js"></script>
    <script src="<?php echo base_url();?>js/libs/jquery.dataTables.min.js"></script>

		<?php
        
        if(isset($js))
        {
            $this->load->view($js);
        }
        
        ?>

</body>
</html>