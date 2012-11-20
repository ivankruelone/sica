<link rel="stylesheet" href="<?php echo base_url();?>css/themes/base/jquery.ui.all.css">
<script src="<?php echo base_url();?>js/ui/jquery.ui.core.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.widget.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.position.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.autocomplete.min.js"></script>
<script language="javascript" type="text/javascript">
$('#sucursal').focus();

$(function() {
        
        var fuente = "<?php echo site_url();?>/sucursales/busca_sucursales_autocomplete";

		$( "#sucursal" ).autocomplete({
			source: fuente
		});
	});
</script>
