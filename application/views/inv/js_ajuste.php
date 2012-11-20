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

$('input[id^="inv_"]').blur(function(event){
    
    var a = $( this ).attr('id');
    b = a.split('_');
    
    var id = b[1];
    var valor = $(this).attr('value');
    var url = "<?php echo site_url();?>/inv/ajuste_cambia";
    var invant = $('#invant_' + id).html();
    
    var variables = {
        id: id,
        valor: valor
    };
    
    var alt = valor.split('+');
    var valor_alt = parseInt(0);
    
    for(var i in alt)
    {
        valor_alt = parseInt(valor_alt) + parseInt(alt[i]);
    }
    
    

    $.post( url, variables, function(data) {
        if(data > 0 ){
            $('#invnue_' + id).html(valor_alt);
            $('#dif_' + id).html(parseInt(valor_alt) - parseInt(invant));
        }else{
            $('#invnue_' + id).html(valor_alt);
            $('#dif_' + id).html(parseInt(valor_alt) - parseInt(invant));
        }
    });    
});

$("input").not( $(":button") ).keypress(function (evt){
    if (evt.keyCode == 13) {
        iname = $(this).val();
        if (iname !== 'Submit'){
            var fields = $(this).parents('form:eq(0),body').find('button, input, textarea, select');
            var index = fields.index( this );
            if ( index > -1 && ( index + 1 ) < fields.length ) {
                fields.eq( index + 1 ).focus().select();
            }
            return false;
        }
    }
});

$(document).keypress(function(e){
  
  if(e.keyCode == 113){
    
    if(confirm('Deseas hacer una carga de inventario a partir de un archivo CSV ??')){
        
        window.location = "<?php echo site_url();?>/inv/subida";
        
    }else{
        return false;
    }
    
    
  }
});


//$("input").focus(function(){
    // Select field contents
//    this.select();
//});

</script>