<script src="<?php echo base_url();?>js/jquery.maskedinput-1.3.min.js"></script>
<script language="javascript" type="text/javascript">

$(document).ready(function(){

$('#clave').focus();

$('input[type="text"]').keyup(function(){
    $(this).val($(this).attr('value').toUpperCase());
});

$("#fecnac").mask("9999-99-99");

    $('#nuevo_cliente_form').submit(function(event)
    {
        event.preventDefault();
        //id, clave, rfc, razon, calle, exterior, interior, colonia, referencia, municipio, estado, pais, cp,
        //contacto, tel, email, alta, modificado

        var sexo = $('#sexo').attr('value');
        var programa = $('#programa').attr('value');
        var url = "<?php echo site_url();?>/pacientes/submit_editar_paciente";

        if(sexo == 0){
            alert("Elige el sexo del Paciente.");
            }else{
                
                if(programa == 0){
                    alert("Elige un programa.");
                }else{
        
                    var variables = {
                        id: $('#id').attr('value'),
                        clave: $('#clave').attr('value'),
                        apaterno: $('#apaterno').attr('value'),
                        amaterno: $('#amaterno').attr('value'),
                        nombre: $('#nombre').attr('value'),
                        fecnac: $('#fecnac').attr('value'),
                        sexo: sexo,
                        programa: programa
                    };
                    
                    if(confirm('Estas seguro que deseas guardar los cambios ?')){
                    
                        $.post( url, variables, function(data) {
                           if(data > 0){
                            window.location = "<?php echo site_url();?>/pacientes/catalogo/";
                           }else{
                            alert("No se pudo actualizar.");
                           }
                            
                            
                        });
                    }
        
            }
        }
    }
    );

});
			
</script>
