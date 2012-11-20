<script language="javascript" type="text/javascript">
$(document).ready(function(){
    $('#nombre').focus();
    
    $('#nuevo_servicio_form').submit(function(event){
        
        event.preventDefault();
        
        var nombre = $('#nombre').attr('value');
        var dire = $('#dire').attr('value');
        var namespace = $('#namespace').attr('value');
        var tipo = $('#tipo').attr('value');
        var estado = $('#estado').attr('value');
        var destino = $(this).attr('action');
        
        var id = $('input[name="id"]').attr('value');
        
        if(parseInt(nombre.length) > parseInt(3) && parseInt(dire.length) > parseInt(3) && parseInt(namespace.length) > parseInt(3) && parseInt(tipo) != parseInt(0) && estado > 0)
        {
            var variables = {
                nombre: nombre,
                url: dire,
                namespace: namespace,
                tipo: tipo,
                id: id,
                estado: estado
            };
            
            
            $.post( destino, variables, function(data) {
                if(data > 0){
                    
                    window.location = "<?php echo site_url();?>/webservices/index/1.1";
                    return true;
                    
                }else{
                    alert('Algo fallo.');
                    return false;
                }
            });

        }else{
            alert('Revisa los valores introducidos, no pueden estar vacios.');
            return false;
        }
        
    });
    
    
});
</script>