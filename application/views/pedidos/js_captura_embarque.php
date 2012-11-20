<link rel="stylesheet" href="<?php echo base_url();?>css/themes/base/jquery.ui.all.css">
<script src="<?php echo base_url();?>js/ui/jquery.ui.core.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.widget.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.position.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.autocomplete.min.js"></script>
<script language="javascript" type="text/javascript">
$('#clave').focus();

$(document).ready(function(){
    var url = "<?php echo site_url();?>/pedidos/detalle_en_embarque";

    var variables = {
        id: $('input[name="id"]').attr('value'),
        estatus: $('input[name="estatus"]').attr('value')
    };
    
    $.post( url, variables, function(data) {
        $('#tabla_captura').html(data);
        $('#canreq_top').html($('#canreq_bottom').html());
        $('#cansur_top').html($('#cansur_bottom').html());
    });
    

});


$('#lote').blur(function(){
    $(this).val($(this).attr('value').toUpperCase().trim());
});

$('#cerrar_pedido').click(function(){
    
    if(confirm('Deseas cerrar este pedido ?'))
    {
        var url = "<?php echo site_url();?>/pedidos/cerrar_surtido";
    
        var variables = {
            id: $('input[name="id"]').attr('value')
        };
        
        $.post( url, variables, function(data) {
            $('#hoja_captura').html(data);
            $('#hoja_detalle').html(data);
        });
    }
    
});


$(function() {
        var id = $('input[name="id"]').attr('value');
        var fuente = "<?php echo site_url();?>/pedidos/busca_pedidos_autocomplete/" + id;

		$('#clave').autocomplete({
			source: fuente,
            minLength: 2,
            select: function(){
                $('#cansur').focus();
            }
		});
});


$('#captura_clave_form').submit(function(event){
    
    event.preventDefault();
    
    var url = "<?php echo site_url();?>/pedidos/submit_captura_cansur_clave";
    var clave = $('#clave').attr('value');
    var a = clave.split('-');

    var variables = {
        clave: a[0].trim(),
        cansur: $('#cansur').attr('value'),
        lote: $('#lote').attr('value'),
        caducidad: $('#caducidad').attr('value'),
        id: $('input[name="id"]').attr('value')
    };
    
    $.post( url, variables, function(data) {
        $('#tabla_captura').html(data);
        $('#cansur').val('');
        $('#lote').val('');
        $('#caducidad').val('');
        $('#clave').val('').focus();
        $('#canreq_top').html($('#canreq_bottom').html());
        $('#cansur_top').html($('#cansur_bottom').html());
    });

    
});
</script>