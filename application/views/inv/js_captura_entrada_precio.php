<link rel="stylesheet" href="<?php echo base_url();?>css/themes/base/jquery.ui.all.css" />
<script src="<?php echo base_url();?>js/ui/jquery.ui.core.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.widget.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.position.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.autocomplete.min.js"></script>
<script language="javascript" type="text/javascript">
$('#clave').focus();

$(document).ready(function(){
    var url = "<?php echo site_url();?>/inv/detalle_entrada_precio";

    var variables = {
        id: $('input[name="id"]').attr('value'),
        estatus: $('input[name="estatus"]').attr('value')
    };
    
    $.post( url, variables, function(data) {
        $('#tabla_captura').html(data);
        $('#total_top').html($('#total_bottom').html());
        $('#rechazadas_top').html($('#rechazadas_bottom').html());
        $('#total_total').html(parseInt($('#rechazadas_bottom').html().replace(',', '')) + parseInt($('#total_bottom').html().replace(',', '')));
    });
});


$('#lote').keyup(function(){
    $(this).val($(this).attr('value').toUpperCase());
});

$('#cerrar_pedido').click(function(){
    
    var importe = $('#importe_bottom').html();
    importe = importe.replace(",", "");
    importe = parseFloat(importe);

    var monto = $('#monto').html();
    monto = monto.replace(",", "");
    monto = parseFloat(monto);

    var diferencia = Math.abs(monto - importe);
    var diferenciareal = monto - importe;
    
    if(diferencia <= 1){

        if(confirm('Deseas cerrar esta entrada de mercancia ?'))
        {
            var url = "<?php echo site_url();?>/inv/cerrar_entrada";
        
            var variables = {
                id: $('input[name="id"]').attr('value')
            };
            
            $.post( url, variables, function(data) {
                window.location = "<?php echo site_url();?>/inv/entradas/3.5";
            });
        }
    }else{
        alert("La diferencia debe ser menos a un peso para pode cerrar la factura.\n La Diferencia actual es: " + diferenciareal);
    }
    
});


$(function() {
    
        var fuente = "<?php echo site_url();?>/productos/busca_productos_autocomplete/";

		$('#clave').autocomplete({
			source: fuente,
            minLength: 2,
            select: function(event, ui){
                $('#piezas').focus();
                //$('input[name="lc"]').val(ui.item.lc);
                //if(ui.item.lc == 0){
                    //$('#lote').attr('disabled', true);
                    //$('#caducidad').attr('disabled', true);
                //}
            }
		});
});


$('#captura_clave_form').submit(function(event){
    
    event.preventDefault();
    
    var url = "<?php echo site_url();?>/inv/submit_captura_clave_entrada_precio";
    var clave = $('#clave').attr('value');
    var a = clave.split('-');

    var variables = {
        p_id: a[0].trim(),
        id: $('input[name="id"]').attr('value'),
        piezas: $('#piezas').attr('value'),
        empresa: $('input[name="empresa"]').attr('value'),
        lote: $('input[name="lote"]').attr('value'),
        caducidad: $('input[name="caducidad"]').attr('value'),
        estatus: $('input[name="estatus"]').attr('value'),
        lc: $('input[name="lc"]').attr('value'),
        precio: $('#precio').attr('value')
    };
    
    $.post( url, variables, function(data) {
        $('#tabla_captura').html(data);
        $('#lote').removeAttr('disabled');
        $('#caducidad').removeAttr('disabled');
        $('#piezas').val('');
        $('#lote').val('');
        $('#caducidad').val('');
        $('#precio').val('');
        //$('input[name="lc"]').val('');
        $('#clave').val('').focus();
        $('#total_top').html($('#total_bottom').html());
        $('#rechazadas_top').html($('#rechazadas_bottom').html());
        $('#total_total').html(parseInt($('#rechazadas_bottom').html().replace(',', '')) + parseInt($('#total_bottom').html().replace(',', '')));
    });

    
});
</script>