<script language="javascript" type="text/javascript">

$(document).ready(function(){
    var url = "<?php echo site_url();?>/pedidos/detalle_embarcado";

    var variables = {
        id: $('input[name="id"]').attr('value'),
        estatus: $('input[name="estatus"]').attr('value')
    };
    
    $.post( url, variables, function(data) {
        $('#tabla_captura').html(data);
        $('#canreq_top').html($('#canreq_bottom').html());
        $('#cansur_top').html($('#cansur_bottom').html());
    });
    

});



</script>