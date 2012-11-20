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
            
            <table class="table" id="productos">
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
                
                $data = array(
              'name'        => 'posologia_'.$row->id,
              'id'          => 'posologia_'.$row->id,
              'maxlength'   => '255',
              'class'       => 'full-width',
              'type'        => 'text',
              'value'       => $row->posologia
            );

            
                
            ?>
            <tr>
                <td><?php echo $row->id;?></td>
                <td><?php echo $row->clave;?></td>
                <td><?php echo $row->descripcion;?></td>
                <td align="right"><?php echo number_format($row->canreq, 0);?></td>
                <td align="center">
                <button id="borrar_<?php echo $row->id;?>" class="small red" value="<?php echo $row->id;?>">Borra</button>
                </td>
            </tr>
            <tr>
                <td>Observaciones</td>
                <td colspan="4"><?php echo form_open('', array('class' => 'form', 'onSubmit' => 'return false;')); echo form_input($data); echo form_close();?></td>
            </tr>
            <?php
            $can = $can + $row->canreq;
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
            <td colspan="3" align="right">Totales</td>
            <td align="right" id="total_piezas"><?php echo $can;?></td>
            <td>&nbsp;</td>
            </tr>
            </tfoot>
            <thead>
            <tr>
            <th>Id</th>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Piezas</th>
            <th>Borrar</th>
            </tr>
            </thead>
            </table>
            <script language="javascript" type="text/javascript">
            $('button[id^="borrar_"]').click(function(){

                var url = "<?php echo site_url();?>/pacientes/borra_detalle";
            
                var variables = {
                    id: $(this).attr('value')
                };
                
                $.post( url, variables, function(data) {
                    actualiza_tabla();
                });
                
            });
            
            $('input[id^="posologia_"]').change(function(){
                var a = $(this).attr('id');
                var texto = $(this).attr('value');
                
                var b = a.split('_');

                var url = "<?php echo site_url();?>/pacientes/posologia";
            
                var variables = {
                    id: b[1],
                    texto: texto
                };
                
                $.post( url, variables, function(data) {
                    
                });
                
            });

            function actualiza_tabla()
            {
                    var url = "<?php echo site_url();?>/pacientes/detalle_captura_receta_temp";

                    var variables = {
                    };
                    
                    $.post( url, variables, function(data) {
                        $('#tabla_captura').html(data);
                    });
            }
            </script>
