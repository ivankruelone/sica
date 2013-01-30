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
            <form class="form">
            <table class="table sortable" id="productos">
            <caption>Total de Registros: <?php echo count($query);?></caption>
            <thead>
            <tr>
            <th>Id</th>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Piezas</th>
            <th>Adicional</th>
            <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $can = 0;
            $total = 0;
            $adicional = 0;
            foreach($query as $row){
            ?>
            <tr>
            <td><?php echo $row->id;?></td>
            <td><?php echo $row->clave;?></td>
            <td><?php echo $row->descripcion;?></td>
            <td align="right"><?php echo number_format($row->cantidad, 0);?></td>
            <?php if($estatus == 1){?>
            <td align="right"><?php echo number_format($row->adicional, 0);?></td>
            <?php }else{?>
            <td align="center"><input class="full-width" type="number" name="adicional_<?php echo $row->id;?>" id="adicional_<?php echo $row->id;?>" required="required" placeholder="Adicional" value="<?php echo $row->adicional; ?>" /></td>
            <?php }?>

            <td align="center" id="total_<?php echo $row->id?>"><?php echo number_format($row->cantidad + $row->adicional, 0);?></td>
            </tr>
            <?php
            $can = $can + $row->cantidad;
            $total = $total + $row->cantidad + $row->adicional;
            $adicional = $adicional + $row->adicional;
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
            <td colspan="3" align="right">Totales</td>
            <td align="right"><?php echo number_format($can, 0);?></td>
            <td align="right"><?php echo number_format($adicional, 0);?></td>
            <td align="right"><?php echo number_format($total, 0);?></td>
            </tr>
            </tfoot>
            </table>
            </form>
            </div>
            <script language="javascript" type="text/javascript">

            $('input[name^="adicional_"]').change(function(){
                var valor = $(this).attr('value');
                var nombre = $(this).attr('name');
                nombre = nombre.split('_');
                var id = nombre[1];
                var columna = nombre[0];
                
                var url = "<?php echo site_url();?>/pedidos/detalle_captura_cambio_automatico";
                
                var variables = {
                        id: id,
                        valor: valor,
                        columna: columna
                };
                
                $.post( url, variables, function(data) {
                        
                        $('#total_'+ id).html('<font color="#DC143C">' + data +'</font>');
                        
                });
                
            });

            function actualiza_tabla()
            {
                    var url = "<?php echo site_url();?>/pedidos/detalle_captura_automatico";

                    var variables = {
                        id: $('input[name="id"]').attr('value'),
                        estatus: $('input[name="estatus"]').attr('value')
                    };
                    
                    $.post( url, variables, function(data) {
                        $('#tabla_captura').html(data);
                        $('#total_top').html($('#total').html());
                    });
            }
            </script>
