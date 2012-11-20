            <?php
            if(isset($insert_id))
            {
                if($insert_id == 0)
                {
            ?>
            <p class="message error">No se Puede agregar, no existe la clave o esta repetida.</p>
            <?php
                }
            }
            ?>
            <div>
            <table class="table sortable" id="productos">
            <caption>Total de Registros: <?php echo count($query);?></caption>
            <thead>
            <tr>
            <th>Id</th>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Piezas</th>
            <th>Borrar</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $can = 0;
            foreach($query as $row){
            ?>
            <tr>
            <td><?php echo $row->id;?></td>
            <td><?php echo $row->clave;?></td>
            <td><?php echo $row->descripcion;?></td>
            <td align="right"><?php echo number_format($row->canreq, 0);?></td>
            <td align="center">
            <?php if($estatus == 0){?>
            <button id="borrar_<?php echo $row->id;?>" class="small red" value="<?php echo $row->id;?>">Borra</button>
            <?php }?>
            </td>
            </tr>
            <?php
            $can = $can + $row->canreq;
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
            <td colspan="3" align="right">Totales</td>
            <td align="right"><?php echo number_format($can, 0);?></td>
            <td>&nbsp;</td>
            </tr>
            </tfoot>
            </table>
            </div>
            <script language="javascript" type="text/javascript">
            $('button[id^="borrar_"]').click(function(){

                var url = "<?php echo site_url();?>/pedidos/borra_detalle";
            
                var variables = {
                    id: $(this).attr('value')
                };
                
                $.post( url, variables, function(data) {
                    actualiza_tabla();
                });
                
            });
            
            function actualiza_tabla()
            {
                    var url = "<?php echo site_url();?>/pedidos/detalle_captura";

                    var variables = {
                        id: $('input[name="id"]').attr('value'),
                        estatus: $('input[name="estatus"]').attr('value')
                    };
                    
                    $.post( url, variables, function(data) {
                        $('#tabla_captura').html(data);
                        $('#total_top').html($('#total').html());
                    });
            }
            
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
            </script>
