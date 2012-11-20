<link rel="stylesheet" href="<?php echo base_url();?>css/themes/base/jquery.ui.all.css">
<script src="<?php echo base_url();?>js/ui/jquery.ui.core.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.widget.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.position.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.autocomplete.min.js"></script>

<script language="javascript" type="text/javascript">
$('#clave').focus();

$(document).ready(function(){
    var url = "<?php echo site_url();?>/pedidos/detalle_captura";

    var variables = {
        id: $('input[name="id"]').attr('value'),
        estatus: $('input[name="estatus"]').attr('value')
    };
    
    $.post( url, variables, function(data) {
        $('#tabla_captura').html(data);
        $('#total_top').html($('#total').html());
    });
    
    
    
    
    
});

$('#cerrar_pedido').click(function(){
    
    if(confirm('Deseas cerrar este pedido ?'))
    {
        var url = "<?php echo site_url();?>/pedidos/cerrar_captura";
    
        var variables = {
            id: $('input[name="id"]').attr('value')
        };
        
        $.post( url, variables, function(data) {
            if(data > 0)
            {
                window.location = "<?php echo site_url();?>/pedidos/en_captura/";
            }else{
                alert('No se pudo cerrar el pedido.');
            }
        });
    }
    
});


$(function() {
        var estado = $('#estado').html();
        var fuente = "<?php echo site_url();?>/productos/busca_productos_estado_autocomplete" + '?estado=' + estado;

		$('#clave').autocomplete({
			source: fuente,
            minLength: 2,
            select: function(){
                $('#piezas').focus();
            }
		});
});


$('#captura_clave_form').submit(function(event){
    
    event.preventDefault();
    
    var url = "<?php echo site_url();?>/pedidos/submit_captura_clave";
    var clave = $('#clave').attr('value');
    var a = clave.split('-');

    var variables = {
        clave: a[0].trim(),
        piezas: $('#piezas').attr('value'),
        id: $('input[name="id"]').attr('value'),
        estatus: $('input[name="estatus"]').attr('value')
    };
    
    $.post( url, variables, function(data) {
        $('#tabla_captura').html(data);
        $('#piezas').val('');
        $('#clave').val('').focus();
        $('#total_top').html($('#total').html());
    });

    
});


</script>