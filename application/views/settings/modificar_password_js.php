<script language="javascript" type="text/javascript">
$(document).ready(function(){
   
   $('#contra_act').focus();
   
   $('#cc_form').submit(function(event){
        
        
        event.preventDefault();

        var pa = $('#contra_act').attr('value');
        var pn1 = $('#contra_nue1').attr('value');
        var pn2 = $('#contra_nue2').attr('value');
        
        if(pa.length >=1 && pn1.length >= 5 && pn2.length >= 5 && pn1 == pn2){
            
            var url = "<?php echo site_url();?>/settings/submit_modificar_password";
        
            var variables = {
                pa: pa,
                pn1: pn1
            };
            
            $.post( url, variables, function(data) {
                                                
                if(data > 0){
                    $('#mensaje').html('El password cambio correctamente.');
                    $('#contra_act').val('');
                    $('#contra_nue1').val('');
                    $('#contra_nue2').val('');
                }else{
                    $('#mensaje').html('No se Pudo ejecutar el cambio, tal vez el password actual no coincide.');
                }
                                                
            });
        
        }else{
            alert('Verifica que el nuevo password 1 y 2 sean iguales y de longitud mayor o igual a 5 !!!');
            return false;
        }
        
   });
    
});
</script>