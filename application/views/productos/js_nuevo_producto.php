<script language="javascript" type="text/javascript">
$(document).ready(function(){
    
    $('#clave').focus();
    
    $('#tipo_producto').change(function(){
        
        var valor = $(this).attr('value');
        
        if(valor == 2){
            $('#iva').val(1);
        }else{
            $('#iva').val(0);
        }
        
    });
    
    $('#editar_producto_form').submit(function(event)
    {
        event.preventDefault();
        //id, tipo_producto, clave, ean, descripcion, unidad, precio_venta, precio_consigna, servicio, iva, lc, min, max, preorden, cuadro
        var tipo_producto = $('#tipo_producto').attr('value');
        var subtipo_producto = $('#subtipo_producto').attr('value');
        var clave = $('#clave').attr('value');
        var ean = $('#ean').attr('value');
        var descripcion = $('#descripcion').attr('value');
        var unidad = $('#unidad').attr('value');
        var iva = $('#iva').attr('value');
        var min = $('#min').attr('value');
        var max = $('#max').attr('value');
        var preorden = $('#preorden').attr('value');
        var lc = $('#lc').attr('value');
        
        var url = "<?php echo site_url();?>/productos/submit_nuevo_producto";
        
        var variables = {
            tipo_producto: tipo_producto,
            subtipo_producto: subtipo_producto,
            clave: clave,
            ean: ean,
            descripcion: descripcion,
            unidad: unidad,
            iva: iva,
            min: min,
            max: max,
            preorden: preorden,
            lc: lc
        };
        
        if(tipo_producto > 0){
            
            if(subtipo_producto > 0){
                
                            if(isNumber(min)){
                                
                                if(isNumber(max)){
                                    
                                    if(isNumber(preorden)){

                                        if(confirm('Seguro que deseas agregar este produto ?')){
                        
                                            $.post( url, variables, function(data) {
                                                
                                                if(data > 0){
                                                    window.location = "<?php echo site_url();?>/productos/detalle/" + data;
                                                }else{
                                                    alert('Verifica los datos.');
                                                }
                                                
                                            });
                                            
                                        }
                                    }else{
                                        alert('No es una cantidad valida !');
                                        $('#preorden').val('').focus();
                                    }
                                    
                                }else{
                                    alert('No es una cantidad valida !');
                                    $('#max').val('').focus();
                                }

                            }else{
                                alert('No es una cantidad valida !');
                                $('#min').val('').focus();
                            }
                

            }else{
                alert('Necesitas elegir el Subtipo de producto.');
                $('#subtipo_producto').focus();
            }
            
        }else{
            alert('Necesitas elegir el Tipo de producto.');
            $('#tipo_producto').focus();
            
        }
    }
    );
    
    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }
				
});
</script>
