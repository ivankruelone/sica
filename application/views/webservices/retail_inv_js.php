<script language="javascript" type="text/javascript">
$(document).ready(function(){
    $('#sucursal').focus();
    
    $('#retail_form').submit(function(event){
        event.preventDefault();
        
        
            var url = $(this).attr('action');
            
            var variables = {
                sucursal: $('#sucursal').attr('value')
            };
            $.post( url, variables, function(data) {
                $('#resultado').html(data);
            });
    });
    
});
</script>