            <table class="table sortable" id="productos">
            <caption>Total de Registros: <?php echo count($query);?></caption>
            <thead>
            <tr>
            <th>Id</th>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Requeridas</th>
            <th>Surtidas</th>
            <th>Lote</th>
            <th>Caducidad</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $can = 0;
            $sur = 0;
            foreach($query as $row){
            ?>
            <tr>
            <td><?php echo $row->id;?></td>
            <td><?php echo $row->clave;?></td>
            <td><?php echo $row->descripcion;?></td>
            <td align="right"><?php echo number_format($row->canreq, 0);?></td>
            <td align="right"><?php echo $row->cansur; ?></td>
            <td><?php echo $row->lote; ?></td>
            <td><?php echo $row->caducidad; ?></td>
            </tr>
            
            <?php
            $can = $can + $row->canreq;
            $sur = $sur + $row->cansur;
            
            $this->db->where('d_id', $row->id);
            $q2 = $this->db->get('detalle_lotes');
            
            foreach($q2->result() as $r2)
            {
            ?>
            

            
            <?php
                
            }
            
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
            <td colspan="3" align="right">Totales</td>
            <td align="right" id="canreq_bottom"><?php echo number_format($can, 0);?></td>
            <td align="right" id="cansur_bottom"><?php echo number_format($sur, 0);?></td>
            <td colspan="3">&nbsp;</td>
            </tr>
            </tfoot>
            </table>
            
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
        aaSorting: [[ 1, "asc" ]],
                
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
