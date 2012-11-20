<script src="<?php echo base_url();?>js/jquery.maskedinput-1.3.min.js"></script>
<script language="javascript" type="text/javascript">

$(document).ready(function(){
    $('#cia').focus();
    elige_juris();
    
    $('#estado_int').change(function(){
        actualiza_juris();
    });
});


$('input[type="text"]').blur(function(){
    $(this).val($(this).attr('value').toUpperCase());
});

$("#cp").mask("99999");

$('#nuevo_cliente_form').submit(function(event)
{
    event.preventDefault();
    if(cia() && estado_int() && juris() && diaped()){
        
    var url = "<?php echo site_url();?>/sucursales/submit_editar_sucursal";
    
    //cia, juris, numsuc, sucursal, calle, exterior, interior, colonia, referencia, municipio, estado_int, cp, diaped, cad_min

    var variables = {
        id: $('#id').attr('value'),
        cia: $('#cia').attr('value'),
        juris: $('#juris').attr('value'),
        numsuc: $('#numsuc').attr('value'),
        sucursal: $('#sucursal').attr('value'),
        calle: $('#calle').attr('value'),
        exterior: $('#exterior').attr('value'),
        interior: $('#interior').attr('value'),
        colonia: $('#colonia').attr('value'),
        referencia: $('#referencia').attr('value'),
        municipio: $('#municipio').attr('value'),
        estado_int: $('#estado_int').attr('value'),
        cp: $('#cp').attr('value'),
        diaped: $('#diaped').attr('value'),
        cad_min: $('#cad_min').attr('value')
    };
    
    $.post( url, variables, function(data) {
        if(data > 0)
        {
            alert('Actualizado correctamente.');
            window.location = "<?php echo site_url();?>/sucursales/catalogo/";
        }else{
            alert('No se pudo actualizar.');
        }
        
        
    });
    }else{
        
    }
    
}
);


function cia(){
    var cia = $('#cia').attr('value');
    if(cia == 0)
    {
        alert('Selecciona una Compañia');
        return false;
    }else
    {
        return true;
    }
}

function estado_int(){
    var estado_int = $('#estado_int').attr('value');
    if(estado_int == 0)
    {
        alert('Selecciona un Estado');
        return false;
    }else
    {
        return true;
    }
}

function juris(){
    var juris = $('#juris').attr('value');
    if(juris == 0)
    {
        alert('Selecciona una Jurisdiccion');
        return false;
    }else
    {
        return true;
    }
}

function diaped(){
    var diaped = $('#diaped').attr('value');
    if(diaped == 0)
    {
        alert('Selecciona un Dia de Pedido');
        return false;
    }else
    {
        return true;
    }
}

function actualiza_juris(){
    var url = "<?php echo site_url();?>/welcome/get_juris_combo";
    var variables = {
            estado: $('#estado_int').attr('value')
        };
    $.post( url, variables, function(data) {
        $('#juris').html(data);
    });
}

function elige_juris()
{
    $('#juris').val('<?php echo $row->juris; ?>');
}

</script>
