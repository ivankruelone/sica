<script language="javascript" type="text/javascript">
$('#busca').focus();

$(document).ready(function(){
   
   $('#kardex_form').submit(function(event){
    event.preventDefault();
    
    var url = "<?php echo site_url();?>/inv/submit_kardex";
    var clave = $('#clave').attr('value');

    var variables = {
        clave: clave
    };
    
    $.post( url, variables, function(data) {
        $('#tabla_kardex').html(data);
    });
   });
    
});

</script>