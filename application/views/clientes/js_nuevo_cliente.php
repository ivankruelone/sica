<script src="<?php echo base_url();?>js/jquery.maskedinput-1.3.min.js"></script>
<?php
	$mal = array(
                                      'src' => base_url().'images/icons/web-app/24/error.png',
                                      'width' => '18',
                                      'height' => '18',
                            );
	$bien = array(
                                      'src' => base_url().'images/icons/web-app/24/good_or_tick.png',
                                      'width' => '18',
                                      'height' => '18',
                            );
?>
<script language="javascript" type="text/javascript">

$(document).ready(function(){
    
    var url = "<?php echo site_url();?>/welcome/get_plaza_combo";
    var variables = {
        zona: $('#zona').attr('value')
    };
    $.post( url, variables, function(data) {
        $('#plaza').html(data);
    });
});

$('#zona').change(function(){
    
    var url = "<?php echo site_url();?>/welcome/get_plaza_combo";
    var variables = {
        zona: $('#zona').attr('value')
    };
    $.post( url, variables, function(data) {
        $('#plaza').html(data);
    });
});

$('#clave').focus();

$('#rfc').blur(function(){
    valida_rfc();
});

$('input[type="text"]').blur(function(){
    $(this).val($(this).attr('value').toUpperCase());
});

$("#cp").mask("99999");

$('#nuevo_cliente_form').submit(function(event)
{
    event.preventDefault();
    //id, clave, rfc, razon, calle, exterior, interior, colonia, referencia, municipio, estado, pais, cp,
    //contacto, tel, email, alta, modificado
    
    var url = "<?php echo site_url();?>/clientes/submit_nuevo_cliente";
    
    var variables = {
        clave: $('#clave').attr('value'),
        rfc: $('#rfc').attr('value'),
        razon: $('#razon').attr('value'),
        calle: $('#calle').attr('value'),
        exterior: $('#exterior').attr('value'),
        interior: $('#interior').attr('value'),
        colonia: $('#colonia').attr('value'),
        referencia: $('#referencia').attr('value'),
        municipio: $('#municipio').attr('value'),
        estado: $('#estado').attr('value'),
        pais: $('#pais').attr('value'),
        cp: $('#cp').attr('value'),
        contacto: $('#contacto').attr('value'),
        tel: $('#tel').attr('value'),
        email: $('#email').attr('value'),
        zona: $('#zona').attr('value'),
        plaza: $('#plaza').attr('value'),
        condiciones: $('#condiciones').attr('value'),
        limite: $('#limite').attr('value'),
        precio: $('#precio').attr('value'),
        descuento1: $('#descuento1').attr('value'),
        descuento2: $('#descuento2').attr('value'),
        iva: $('#iva').attr('value'),
        cad_min: $('#cad_min').attr('value'),
        exclu: $('#exclu').attr('value'),
        prioridad: $('#prioridad').attr('value')
    };
    
    $.post( url, variables, function(data) {
        $('#formato').html(data);
        //alert("Registros actualizados: " + data);
        
        
    });
}
);

function valida_rfc(){
    
    var valor = $( '#rfc' ).attr('value');
    var largo = $( '#rfc' ).attr('value').length;

    if(largo == 12){
        
        var siglas = valor.substring(0, 3);
        var clave = valor.substring(9, 12);
        var RegExPattern = /[a-zA-Z]{3}/;
        var RegExPattern2 = /[a-zA-Z0-9]{3}/;
        
        var anio = valor.substring(3, 5);
        var mes = valor.substring(5, 7);
        var dia = valor.substring(7, 9);
        
        if(valida_fecha(anio, mes, dia) && siglas.match(RegExPattern) && clave.match(RegExPattern2)){
            $('#span_rfc').html('<?php echo img($bien);?>');
            return true;
        }else{
            $('#span_rfc').html('<?php echo img($mal);?>');
            return false;
        }
        
    }else if(largo == 13){

        var siglas = valor.substring(0, 4);
        var clave = valor.substring(10, 13);
        var RegExPattern = /[a-zA-Z]{4}/;
        var RegExPattern2 = /[a-zA-Z0-9]{3}/;
        
        var anio = valor.substring(4, 6);
        var mes = valor.substring(6, 8);
        var dia = valor.substring(8, 10);
        
        if(valida_fecha(anio, mes, dia) && siglas.match(RegExPattern) && clave.match(RegExPattern2)){
            $('#span_rfc').html('<?php echo img($bien);?>');
            return true;
        }else{
            $('#span_rfc').html('<?php echo img($mal);?>');
            return false;
        }
        
    }else{
        $('#span_rfc').html('<?php echo img($mal);?>');
        return false;
    }

}

function valida_fecha(anio, mes, dia){
    
    if(anio <= 99 && anio >= 0){
        
        
        if(mes >= 1 && mes <=12){
            
            if((mes == 1 || mes == 3 || mes == 5 || mes == 7 || mes == 8 || mes == 10 || mes == 12) && dia >= 1 && dia <= 31){
                return true;
            }else if((mes == 4 || mes == 6 || mes == 9 || mes == 11) && dia >= 1 && dia <= 30){
                return true;
            }else if(mes == 2 && dia >= 1 && dia <= 29){
                return true;
            }else{
                return false;
            }
            
        }else{
            return false;
        }
        
    }else{
        return false;
    }
    
}

				
</script>
