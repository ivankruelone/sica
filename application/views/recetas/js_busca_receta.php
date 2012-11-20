<script language="javascript" type="text/javascript">
$('#folio').focus();


$(document).ready(function(){
    $('#busca_receta_form').submit(function(event){
       event.preventDefault();
       
       var url = "<?php echo site_url();?>/recetas/submit_busca_receta";
       var folio = $('#folio').attr('value');

        var variables = {
            folio:folio
        };
    
        $.post( url, variables, function(data) {
            
            if(data > 0)
            {
                window.location = "<?php echo site_url();?>/recetas/receta/" + data;
            }else{
                alert('No se encuentra la receta o ya esta surtida');
                folio = $('#folio').val('').focus();
            }

        });
 
    });
});
</script>