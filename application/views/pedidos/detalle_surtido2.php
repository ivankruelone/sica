            <table class="table sortable" id="productos">
            <caption>Total de Registros: <?php echo count($query);?></caption>
            <thead>
            <tr>
            <th>Id</th>
            <th>Area</th>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Requeridas</th>
            <th>Cansur</th>
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
            <td><?php echo $row->subtipo_producto;?></td>
            <td><?php echo $row->clave;?></td>
            <td><?php echo $row->descripcion;?></td>
            <td align="right"><?php echo number_format($row->canreq, 0);?></td>
            <td align="right">
                <span id="verificada_<?php echo $row->id;?>"><?php echo number_format($row->cansur, 0);?></span><br />
                <span id="lotever_<?php echo $row->id;?>"><?php echo $row->lote;?></span><br />
                <span id="caduver_<?php echo $row->id;?>"><?php echo formato_caducidad($row->caducidad);?></span>
            </td>
            <td align="right"><input type="number" name="cansur_<?php echo $row->id;?>" id="cansur_<?php echo $row->id;?>" required="required" placeholder="Surtidas" value="<?php echo $row->cansur; ?>" /></td>
            <td><input type="text" name="lote_<?php echo $row->id;?>" id="lote_<?php echo $row->id;?>" placeholder="Lote" pattern="[A-Z0-9]+" value="<?php echo $row->lote; ?>" /></td>
            <td><input type="date" name="caducidad_<?php echo $row->id;?>" id="caducidad_<?php echo $row->id;?>" placeholder="Caducidad" value="<?php echo formato_caducidad($row->caducidad); ?>" /></td>
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
            <td colspan="4" align="right">Totales</td>
            <td align="right" id="canreq_bottom"><?php echo number_format($can, 0);?></td>
            <td align="right" id="cansur_bottom"><?php echo number_format($sur, 0);?></td>
            <td colspan="3">&nbsp;</td>
            </tr>
            </tfoot>
            </table>
            <script language="javascript" type="text/javascript">
            
            $('input[name^="cansur_"]').change(function(){
                var valor = $(this).attr('value');
                var nombre = $(this).attr('name');
                nombre = nombre.split('_');
                var id = nombre[1];
                var columna = nombre[0];
                
                var url = "<?php echo site_url();?>/pedidos/detalle_captura_cambio";
                
                var variables = {
                        id: id,
                        valor: valor,
                        columna: columna
                };
                
                $.post( url, variables, function(data) {
                        
                        $('#verificada_'+ id).html('<font color="#DC143C">' + data +'</font>');
                        
                });
                
            });

            $('input[name^="lote_"]').change(function(){
                var valor = $(this).attr('value');
                var nombre = $(this).attr('name');
                nombre = nombre.split('_');
                var id = nombre[1];
                var columna = nombre[0];
                
                var url = "<?php echo site_url();?>/pedidos/detalle_captura_cambio_lote_caucidad";
                
                var variables = {
                        id: id,
                        valor: valor.toUpperCase(),
                        columna: columna
                };
                
                $.post( url, variables, function(data) {
                        
                        $('#lotever_'+ id).html('<font color="#DC143C">' + data +'</font>');
                });
                
            });
            
            
            $('input[name^="caducidad_"]').change(function(){
                var valor = $(this).attr('value');
                var nombre = $(this).attr('name');
                nombre = nombre.split('_');
                var id = nombre[1];
                var columna = nombre[0];
                
                var RegExPattern = /(ene|feb|mar|abr|may|jun|jul|ago|sep|oct|nov|dic|ENE|FEB|MAR|ABR|MAY|JUN|JUL|AGO|SEP|OCT|NOV|DIC|01|02|03|04|05|06|07|08|09|10|11|12)\/(<?php echo $anios_validos;?>)|SC|sc/;
                
                var url = "<?php echo site_url();?>/pedidos/detalle_captura_cambio_lote_caucidad";
                
                var variables = {
                        id: id,
                        valor: valor,
                        columna: columna
                };
                
                if(valor.match(RegExPattern)){
                
                    $.post( url, variables, function(data) {
                        $('#caduver_'+ id).html('<font color="#DC143C">' + data +'</font>');
                    });
                }else{
                    alert("Escribe la caducidad en formato valido, ejemplos: sep/2015, sc, 09/2015...")
                }
                
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
                        $('#canreq_top').html($('#canreq_bottom').html());
                        $('#cansur_top').html($('#cansur_bottom').html());
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
