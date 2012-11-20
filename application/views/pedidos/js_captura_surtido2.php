<link rel="stylesheet" href="<?php echo base_url();?>css/themes/base/jquery.ui.all.css">
<script src="<?php echo base_url();?>js/ui/jquery.ui.core.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.widget.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.position.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.autocomplete.min.js"></script>
<script language="javascript" type="text/javascript">
$('#surtio').focus();

$(document).ready(function(){
    var url = "<?php echo site_url();?>/pedidos/detalle_surtido2";

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





$('#cierra_surtido_form').submit(function(event){
    
    event.preventDefault();
    
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
        var estado_int = $('#estado_int').html();
        
        var fuente = "<?php echo site_url();?>/pedidos/busca_pedidos_autocomplete/" + "?id=" + id + "&estado_int=" + estado_int;

		$('#clave').autocomplete({
			source: fuente,
            minLength: 2,
            select: function( event, ui ){
                
                $('input[name="lc"]').val(ui.item.lc);
                
                if(ui.item.lc == 0){
                    $('#lote').attr('disabled', true);
                    $('#caducidad').attr('disabled', true);
                }else{
                    $('#lote').removeAttr('disabled');
                    $('#caducidad').removeAttr('disabled');
                }
                
                $('#cansur').focus();
            }
		});
        
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		$( "#surtio" )
			// don't navigate away from the field on tab when selecting an item
			.bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB &&
						$( this ).data( "autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			})
			.autocomplete({
				source: function( request, response ) {
					$.getJSON( "<?php echo site_url();?>/pedidos/busca_personal/", {
						term: extractLast( request.term )
					}, response );
				},
				search: function() {
					// custom minLength
					var term = extractLast( this.value );
					if ( term.length < 2 ) {
						return false;
					}
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					var terms = split( this.value );
					// remove the current input
					terms.pop();
					// add the selected item
					terms.push( ui.item.value );
					// add placeholder to get the comma-and-space at the end
					terms.push( "" );
					this.value = terms.join( ", " );
					return false;
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
        id: $('input[name="id"]').attr('value'),
        lc: $('input[name="lc"]').attr('value')
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