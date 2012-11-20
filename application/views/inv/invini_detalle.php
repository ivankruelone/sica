            <table class="table" id="productos">
            <thead>
            <tr>
            <th>Id</th>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Piezas</th>
            <th>Lote</th>
            <th>Caducidad</th>
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
            <td align="right"><?php echo number_format($row->piezas, 0);?></td>
            <td><?php echo $row->lote;?></td>
            <td><?php echo $row->caducidad;?></td>
            <td align="center">
            <?php if($estatus == 0){?>
            <button id="borrar_<?php echo $row->id;?>" class="small red" value="<?php echo $row->id;?>">Borra</button>
            <?php }?>
            </td>
            </tr>
            <?php
            $can = $can + $row->piezas;
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
            <td colspan="3" align="right">Totales</td>
            <td align="right" id="total_bottom"><?php echo number_format($can, 0);?></td>
            <td colspan="3">&nbsp;</td>
            </tr>
            </tfoot>
            <thead>
            <tr>
            <th>Id</th>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Piezas</th>
            <th>Lote</th>
            <th>Caducidad</th>
            <th>Borrar</th>
            </tr>
            </thead>
            </table>
            <script language="javascript" type="text/javascript">
            $('button[id^="borrar_"]').click(function(){

                var url = "<?php echo site_url();?>/inv/borra_detalle_invini";
            
                var variables = {
                    id: $(this).attr('value')
                };
                
                $.post( url, variables, function(data) {
                    actualiza_tabla();
                });
                
            });
            
            function actualiza_tabla()
            {
                    var url = "<?php echo site_url();?>/inv/detalle_invini";

                    var variables = {
                        estatus: $('input[name="estatus"]').attr('value')
                    };
                    
                    $.post( url, variables, function(data) {
                        $('#tabla_captura').html(data);
                        $('#total_top').html($('#total_top').html());
                    });
            }
            </script>
