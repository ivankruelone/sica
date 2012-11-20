<script language="javascript" type="text/javascript">
$(document).keypress(function(e){
  
  if(e.keyCode == 113){
    
    if(confirm('Deseas hacer el Ajuste tomando lo que tienes en Inventario subido por CSV ??')){
        
        var palabra = prompt("Escribe la palabra para efectuar el procedimiento: ");
        if (palabra!=null && palabra!="")
        {
            var url = "<?php echo site_url();?>/inv/dkufhsdfksdjfhksdjfhsdfkjsdhf";
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
    
    
  }
});



</script>