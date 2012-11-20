<link rel="stylesheet" href="<?php echo base_url();?>css/themes/base/jquery.ui.all.css">
<script src="<?php echo base_url();?>js/ui/jquery.ui.core.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.widget.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.position.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.autocomplete.min.js"></script>
<script language="javascript" type="text/javascript">
$('#clave').focus();


$(document).ready(function(){
    
    resetea_cie();
    
    var url = "<?php echo site_url();?>/pacientes/detalle_captura_receta_temp";

    var variables = {
    };
    
    $.post( url, variables, function(data) {
        $('#tabla_captura').html(data);
    });
    
    
    $('#resetea_cie').click(function(){
            resetea_cie();
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
        var fuente = "<?php echo site_url();?>/productos/busca_productos_autocomplete";

		$('#clave').autocomplete({
			source: fuente,
            minLength: 2,
            select: function(){
                $('#piezas').focus();
            }
		});
});

$(function() {
        var fuente = "<?php echo site_url();?>/pacientes/busca_cie_primaria";

		$('#cieprimaria').autocomplete({
			source: fuente,
            minLength: 2,
            select: function(event, ui){
                rellena_cie_secundaria(ui.item.cie);
            }
		});
});

function rellena_cie_secundaria(cieprimaria)
{
    var url = "<?php echo site_url();?>/pacientes/busca_cie_secundaria";

    var variables = {
        cieprimaria: cieprimaria
    };
    
    $.post( url, variables, function(data) {
        $('#ciesecundaria').html(data).focus();
    });
    
}


function resetea_cie()
{
    $('#cieprimaria').val('');
    $('#ciesecundaria').html('');
}

$('#terminar_receta').click(function(event){
    event.preventDefault();
    
    var cieprimaria = $('#cieprimaria').attr('value');
    var ciesecundaria = $('#ciesecundaria').attr('value');
    var piezas = $('#total_piezas').html();
    var paciente_id = <?php echo $id;?>;
    
    if(cieprimaria.length >= 3){
       if(ciesecundaria.length >= 3){
        if(piezas > 0){
                if(confirm('Seguro que deseas terminar esta receta ?')){
            
                    var url = "<?php echo site_url();?>/pacientes/terminar_receta";
                    var variables = {
                        cieprimaria: cieprimaria,
                        ciesecundaria: ciesecundaria,
                        piezas: piezas,
                        paciente_id: paciente_id
                    };
                    $.post( url, variables, function(data) {
                        
                        if(data > 0){
                            window.location = "<?php echo site_url();?>/pacientes/receta/" + paciente_id + "/" + data;
                        }else{
                            alert('Imposible Cerrar la receta');
                        }
                        
                    });
            
            }
            
        }else{
            alert('No hay Productos. Imposible Terminar.');
            $('#clave').focus();
        }
        
       }else{
        alert('No haz elegido CIE Secundaria. Imposible Terminar.');
        $('#ciesecundaria').focus();
       }
    }else{
        alert('No haz elegido CIE PRIMARIA. Imposible Terminar.');
        $('#cieprimaria').focus();
    }
    
   
})


$('#captura_clave_form').submit(function(event){
    
    event.preventDefault();
    
    var url = "<?php echo site_url();?>/pacientes/submit_captura_clave";
    var clave = $('#clave').attr('value');
    var a = clave.split('-');

    var variables = {
        clave: a[0].trim(),
        piezas: $('#piezas').attr('value')
    };
    
    $.post( url, variables, function(data) {
        $('#tabla_captura').html(data);
        $('#piezas').val('');
        $('#clave').val('').focus();
    });

    
});
</script>