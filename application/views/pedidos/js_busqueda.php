<link rel="stylesheet" href="<?php echo base_url();?>css/themes/base/jquery.ui.all.css">
<script src="<?php echo base_url();?>js/ui/jquery.ui.core.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.widget.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.position.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.autocomplete.min.js"></script>

<script language="javascript" type="text/javascript">
$(document).ready(function(){
   $('#sucursal').focus();
   
   $('#busqueda_form').submit(function(event){
    event.preventDefault();
   });
   
   $('#busca_pedido').click(function(){
    var pedido = $('#pedido').attr('value');
    var url = "<?php echo site_url();?>/pedidos/busqueda_pedido";
    var variables = {
        pedido: pedido
    };
    
    $.post( url, variables, function(data) {
        $('#resultado_busqueda').html(data);
    });
    
   });
   
   

   
});

function busca_sucursales(sucursal){
    var url = "<?php echo site_url();?>/pedidos/busqueda_sucursal";
    var variables = {
        sucursal: sucursal
    };
    
    $.post( url, variables, function(data) {
        $('#resultado_busqueda').html(data);
    });

}

$(function() {
        
        var fuente = "<?php echo site_url();?>/sucursales/busca_sucursales_autocomplete";

		$( "#sucursal2" ).autocomplete({
			source: fuente,
            select: function(event, ui){
                
                busca_sucursales(ui.item.numsuc);
                $(this).val("");
                return false;
            }
		});
	});
</script>