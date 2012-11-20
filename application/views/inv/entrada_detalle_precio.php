            <table class="table" id="productos">
            <caption>Productos Aceptados</caption>
            <thead>
            <tr>
            <th>Id</th>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Lote</th>
            <th>Caducidad</th>
            <th>Precio</th>
            <th>Piezas</th>
            <th>Importe</th>
            <th>Iva</th>
            <th>Total</th>
            <th>Borrar</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $can = 0;
            $subtotal_t = 0;
            $iva_t = 0;
            $total_t = 0;
            
            foreach($query as $row){
                $subtotal = $row->piezas * $row->precio;
                
                if($row->tipo_producto == 1)
                {
                    $iva = 0;
                }else{
                    $iva = $subtotal * 0.16;
                }
                
                $subtotal_t = $subtotal_t + $subtotal;
                $iva_t = $iva_t + $iva;
                $total_t = $total_t + $subtotal + $iva;
                
            ?>
            <tr>
            <td><?php echo $row->id;?></td>
            <td><?php echo $row->clave;?></td>
            <td><?php echo $row->descripcion;?></td>
            <td><?php echo $row->lote;?></td>
            <td><?php echo $row->caducidad;?></td>
            <td align="right"><?php echo number_format($row->precio, 2);?></td>
            <td align="right"><?php echo number_format($row->piezas, 0);?></td>
            <td align="right"><?php echo number_format($subtotal, 2);?></td>
            <td align="right"><?php echo number_format($iva, 2);?></td>
            <td align="right"><?php echo number_format($iva + $subtotal, 2);?></td>
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
            <td colspan="6" align="right">Totales</td>
            <td align="right" id="total_bottom"><?php echo number_format($can, 0);?></td>
            <td align="right"><?php echo number_format($subtotal_t, 4);?></td>
            <td align="right"><?php echo number_format($iva_t, 4);?></td>
            <td align="right" id="importe_bottom"><?php echo number_format($total_t, 4);?></td>
            <td>&nbsp;</td>
            </tr>
            </tfoot>
            </table>




            <table class="table" id="productos">
            <caption>Productos Rechazados por no cumplir con la Caducidad</caption>
            <thead>
            <tr>
            <th>Id</th>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Piezas</th>
            <th>Lote</th>
            <th>Caducidad</th>
            <th>Precio</th>
            <th>Borrar</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $can = 0;
            foreach($query2 as $row2){
            ?>
            <tr>
            <td><?php echo $row2->id;?></td>
            <td><?php echo $row2->clave;?></td>
            <td><?php echo $row2->descripcion;?></td>
            <td align="right"><?php echo number_format($row2->piezas, 0);?></td>
            <td><?php echo $row2->lote;?></td>
            <td><?php echo $row2->caducidad;?></td>
            <td align="right"><?php echo number_format($row2->precio, 4);?></td>
            <td align="center">
            <?php if($estatus == 0){?>
            <button id="rechazada_<?php echo $row2->id;?>" class="small red" value="<?php echo $row2->id;?>">Borra</button>
            <?php }?>
            </td>
            </tr>
            <?php
            $can = $can + $row2->piezas;
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
            <td colspan="3" align="right">Totales</td>
            <td align="right" id="rechazadas_bottom"><?php echo number_format($can, 0);?></td>
            <td colspan="4">&nbsp;</td>
            </tr>
            </tfoot>
            </table>

            <script language="javascript" type="text/javascript">
            $('button[id^="borrar_"]').click(function(){

                var url = "<?php echo site_url();?>/inv/borra_detalle_entrada";
            
                var variables = {
                    id: $(this).attr('value')
                };
                
                $.post( url, variables, function(data) {
                    actualiza_tabla();
                });
                
            });
            
            $('button[id^="rechazada_"]').click(function(){

                var url = "<?php echo site_url();?>/inv/borra_detalle_entrada_rechazada";
            
                var variables = {
                    id: $(this).attr('value')
                };
                
                $.post( url, variables, function(data) {
                    actualiza_tabla();
                });
                
            });

            function actualiza_tabla()
            {
                    var url = "<?php echo site_url();?>/inv/detalle_entrada_precio";

                    var variables = {
                        id: $('input[name="id"]').attr('value'),
                        empresa: $('input[name="empresa"]').attr('value'),
                        estatus: $('input[name="estatus"]').attr('value')
                    };
                    
                    $.post( url, variables, function(data) {
                        $('#tabla_captura').html(data);
                        $('#total_top').html($('#total_top').html());
                        $('#rechazadas_top').html($('#rechazadas_bottom').html());
                        $('#total_total').html(parseInt($('#rechazadas_bottom').html().replace(',', '')) + parseInt($('#total_bottom').html().replace(',', '')));

                    });
            }
            </script>
