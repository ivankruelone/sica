<section class="grid_12">
    <div class="block-border">


        <div class="block-content" align="center">
            <h1>
                        <?php echo $titulo;?>
                        <?php
                            $image1 = array(
                                  'src' => base_url().'images/icons/fugue/hp_printer.png',
                                  'width' => '16',
                                  'height' => '16',
                        );
                        
                        echo anchor('inv/ajuste_hist_detalle_imprimir/'.$id_ref, img($image1).' imprimir', array('target' => '_blank'));
                            
                        ?>
                        
            </h1>
            <p>
            
            <h2 align="center">Detalle del ajuste con referencia <?php echo $id_ref; ?>: <?php echo count($query); ?> registro(s) encontrados</h2>
            
            <table class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Clave</th>
							<th scope="col">Desc.</th>
							<th scope="col">Lote</th>
							<th scope="col">Caducidad</th>
							<th scope="col">Fecha</th>
							<th scope="col">Movimiento</th>
							<th scope="col">Referencia</th>
							<th scope="col">Mensaje</th>
							<th scope="col">Cantidad</th>
							<th scope="col">Inv.</th>
							<th scope="col">User</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    foreach($query as $row){
                            
                    ?>
						<tr>
							<td align="right"><?php echo $row->id;?></td>
							<td><?php echo $row->clave;?></td>
							<td><?php echo $row->descripcion;?></td>
							<td><?php echo $row->lote;?></td>
							<td><?php echo $row->caducidad;?></td>
							<td><?php echo $row->fecha;?></td>
							<td><?php echo $row->movimiento;?></td>
							<td><?php echo $row->id_ref;?></td>
							<td><?php echo $row->mensaje;?></td>
                            <?php if(($row->nueva - $row->vieja) < 0){ ?>
							<td align="right" style="color: red;"><?php echo $row->nueva - $row->vieja;?></td>
                            <?php }else{?>
                            <td align="right"><?php echo $row->nueva - $row->vieja;?></td>
                            <?php }?>
							<td align="right"><?php echo $row->nueva;?></td>
							<td><?php echo $row->usuario;?></td>
						</tr>
                    <?php
                    
                    }
                    ?>
					</tbody>
            </table>
            
            </p>
        </div>



    </div>
</section>