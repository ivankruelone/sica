<script language="javascript" type="text/javascript">
$(document).ready(function(){
    $('#surte_form').submit(function(event){
       event.preventDefault();
       var paso = $(this).serialize();

       
       var url = "<?php echo site_url();?>/recetas/submit_surte_receta";
       var folio = $('#folio').attr('value');

        var variables = {
            paso:paso
        };
    
        $.post( url, variables, function(data) {
            if(data > 0)
            {
                window.location = "<?php echo site_url();?>/recetas";
            }else{
                alert('No se pudo surtir.');
            }
        });
 
    });
});
</script>