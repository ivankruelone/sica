            <table class="table" id="productos">
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
            <th>Accion</th>
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
            <td align="right"><?php echo number_format($row->cansur, 0);?></td>
            <td><?php echo $row->lote;?></td>
            <td><?php echo $row->caducidad;?></td>
            <td align="center">
            <?php if($estatus == 1 && $row->agregada == 1){?>
            <button id="borrar_<?php echo $row->id;?>" class="small red" value="<?php echo $row->id;?>">Borra</button>
            <?php }?>
            </td>
            </tr>
            
            <?php
            $can = $can + $row->canreq;
            $sur = $sur + $row->cansur;
            
            $this->db->where('d_id', $row->id);
            $q2 = $this->db->get('detalle_lotes');
            
            foreach($q2->result() as $r2)
            {
            ?>
            
            
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td align="right"></td>
            <td align="right"><?php echo number_format($r2->cansur, 0);?></td>
            <td><?php echo $r2->lote;?></td>
            <td><?php echo $r2->caducidad;?></td>
            <td align="center">
            <?php if($estatus == 1 && $row->agregada == 1){?>
            <button id="borrar_<?php echo $row->id;?>" class="small red" value="<?php echo $row->id;?>">Borra</button>
            <?php }?>
            </td>
            </tr>



            
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
            <thead>
            <tr>
            <th>Id</th>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Requeridas</th>
            <th>Surtidas</th>
            <th>Lote</th>
            <th>Caducidad</th>
            <th>Accion</th>
            </tr>
            </thead>
            </table>
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
                        $('#canreq_top').html($('#canreq_bottom').html());
                        $('#cansur_top').html($('#cansur_bottom').html());
                    });
            }
            </script>
