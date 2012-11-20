<?php
	
                        $image4 = array(
                                  'src' => base_url().'images/icons/fugue/flag.png',
                                  'width' => '16',
                                  'height' => '16',
                        );
                        
                        $image5 = array(
                                  'src' => base_url().'images/icons/fugue/flag_gris.png',
                                  'width' => '16',
                                  'height' => '16',
                        );
                        
                        $bandera0 = img($image5);
                        $bandera1 = img($image4);
?>
<script language="javascript" type="text/javascript">
$.fn.dataTableExt.oStdClasses.sWrapper = 'no-margin last-child';
$.fn.dataTableExt.oStdClasses.sInfo = 'message no-margin';
$.fn.dataTableExt.oStdClasses.sLength = 'float-left';
$.fn.dataTableExt.oStdClasses.sFilter = 'float-right';
$.fn.dataTableExt.oStdClasses.sPaging = 'sub-hover paging_';
$.fn.dataTableExt.oStdClasses.sPagePrevEnabled = 'control-prev';
$.fn.dataTableExt.oStdClasses.sPagePrevDisabled = 'control-prev disabled';
$.fn.dataTableExt.oStdClasses.sPageNextEnabled = 'control-next';
$.fn.dataTableExt.oStdClasses.sPageNextDisabled = 'control-next disabled';
$.fn.dataTableExt.oStdClasses.sPageFirst = 'control-first';
$.fn.dataTableExt.oStdClasses.sPagePrevious = 'control-prev';
$.fn.dataTableExt.oStdClasses.sPageNext = 'control-next';
$.fn.dataTableExt.oStdClasses.sPageLast = 'control-last';
 
/*
 * Apply the plugin to every table with the class 'sortable'
 */
$(document).ready(function()
{
    $('.sortable').each(function(i)
    {
        // DataTable config
        var table = $(this),
            oTable = table.dataTable({
                oLanguage: {
			sLengthMenu: "Mostrando _MENU_ registros por pagina",
			sZeroRecords: "No hay Registros - lo siento",
			sInfo: "Mostrando _START_ hasta _END_ de _TOTAL_ registros",
			sInfoEmpty: "Mostrando 0 hasta 0 de 0 registros",
			sInfoFiltered: "(filtrando de _MAX_ registros en total)",
            sSearch: "Buscar:"
		},
        bPaginate: false,
        aaSorting: [[ 0, "desc" ]],
                
                /*
                 * Set DOM structure for table controls
                 * @url http://www.datatables.net/examples/basic_init/dom.html
                 */
                sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',
                 
                /*
                 * Callback to apply template setup
                 */
                fnDrawCallback: function()
                {
                    this.parent().applyTemplateSetup();
                },
                fnInitComplete: function()
                {
                    this.parent().applyTemplateSetup();
                }
            });
         
        // Sorting arrows behaviour
        table.find('thead .sort-up').click(function(event)
        {
            // Stop link behaviour
            event.preventDefault();
             
            // Find column index
            var column = $(this).closest('th'),
                columnIndex = column.parent().children().index(column.get(0));
             
            // Send command
            oTable.fnSort([[columnIndex, 'asc']]);
             
            // Prevent bubbling
            return false;
        });
        table.find('thead .sort-down').click(function(event)
        {
            // Stop link behaviour
            event.preventDefault();
             
            // Find column index
            var column = $(this).closest('th'),
                columnIndex = column.parent().children().index(column.get(0));
             
            // Send command
            oTable.fnSort([[columnIndex, 'desc']]);
             
            // Prevent bubbling
            return false;
        });
    });
});


$('a[href*="cancela_pedido"]').click(function(event){
   event.preventDefault();
   var url = $(this).attr('href');
   var id = url.split('cancela_pedido/');
   id = id[1];
   if(confirm("Estas seguro que deseas cancelar este pedido ? \n Id. de Pedido: " + id)){
    var motivo = prompt("Escribe el motivo de la cancelacion: ");
    if (motivo!=null && motivo!="")
    {
        var variables = {
            motivo: motivo
        };
            
        $.post( url, variables, function(data) {
              if(data > 0){
                window.location.reload();
              }else{
                return false;
            }
         });
    
    }else{
        return false;
    }
    
   }else{
    return false;
   }
    
});

$('a[href*="regresa_pedido"]').click(function(event){
   event.preventDefault();
   var url = $(this).attr('href');
   var id = url.split('regresa_pedido/');
   id = id[1];
   if(confirm("Estas seguro que deseas regresar este pedido a su estado anterior? \n Id. de Pedido: " + id)){
            
        $.post( url, '', function(data) {
              if(data > 0){
                window.location.reload();
              }else{
                return false;
            }
         });
    
   }else{
    return false;
   }
    
});

$('span[id^="flag_"]').click(function(){
    if(confirm('Seguro que deseas cambiar de urgencia?')){
        var valor = $(this).attr('tittle');
        var nombre = $(this).attr('id');
        nombre = nombre.split('_');
        var id = nombre[1];
        var columna = nombre[0];
        var url = "<?php echo site_url();?>/pedidos/cambiar_pedido_attr";
        var bandera0 = '<?php echo $bandera0;?>';
        var bandera1 = '<?php echo $bandera1;?>';
        var bandera;
        var valor2;
        
        if(valor == 0){
            valor2 = 1;
            bandera = bandera1;
        }else{
            valor2 = 0;
            bandera = bandera0;
        }
                
        var variables = {
            id: id,
            valor: valor2,
            columna: columna
            };
                
        $.post( url, variables, function(data) {
              if(data > 0){
                window.location.reload();
              }else{
                return false;
              }
              
                        
        });
    }
});

</script>