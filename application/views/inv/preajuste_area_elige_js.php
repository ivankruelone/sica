<script language="javascript" type="text/javascript">
$(document).keypress(function(e){
  
  if(e.keyCode == 113){
    
    if(confirm('Deseas hacer el Ajuste tomando lo que llevas capturado en Pre-Ajuste ??')){
        
        var palabra = prompt("Escribe la palabra para efectuar el procedimiento: ");
        if (palabra!=null && palabra!="")
        {
            var url = "<?php echo site_url();?>/inv/sdjkdfowfjjyuwfjkofhjefqwf";
            var variables = {
                palabra: palabra
            };
                
            $.post( url, variables, function(data) {
                
                  if(data == 1)
                  {
                    alert('Ejecutado Correctamente.');
                    window.location = "<?php echo site_url();?>/inv";
                  }else{
                    alert('Algo salio mal.');
                    window.location = "<?php echo site_url();?>/inv";
                  }
             });
        
        }else{
            return false;
        }
        
        
    }else{
        return false;
    }
    
    
  }else if(e.keyCode == 119){
    if(confirm('Deseas poner en ceros el inventario del pre-ajuste ??')){
        
        var palabra = prompt("Escribe la palabra para efectuar el procedimiento: ");
        if (palabra!=null && palabra!="")
        {
            var url = "<?php echo site_url();?>/inv/sdfkjsdfjkdfjkdfhfdjsdfkjhdfgjkdfgjk";
            var variables = {
                palabra: palabra
            };
                
            $.post( url, variables, function(data) {
                
                  if(data == 1)
                  {
                    alert('Ejecutado Correctamente.');
                    window.location = "<?php echo site_url();?>/inv/preajuste/3.17";
                  }else{
                    alert('Algo salio mal.');
                    window.location = "<?php echo site_url();?>/inv/preajuste/3.17";
                  }
             });
        
        }else{
            return false;
        }
        
        
    }else{
        return false;
    }
  }
});



</script>