            <p>
            <table class="table sortable" cellspacing="0" width="100%">
            <caption>Registros: <?php echo count($query); ?></caption>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Fecha</th>
							<th scope="col">Usuario</th>
							<th scope="col">Sucursal</th>
							<th scope="col">Status</th>
							<th scope="col">Cantidad</th>
							<th scope="col">Adicional</th>
							<th scope="col">Funciones</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    
                    foreach($query as $row){
                        $image1 = array(
                                  'src' => base_url().'images/icons/fugue/cards-address.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        $image2 = array(
                                  'src' => base_url().'images/icons/fugue/pencil.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        $image3 = array(
                                  'src' => base_url().'images/icons/fugue/hp_printer.png',
                                  'width' => '16',
                                  'height' => '16',
                        );
                        
                        $image4 = array(
                                  'src' => base_url().'images/icons/fugue/flag.png',
                                  'width' => '16',
                                  'height' => '16',
                        );
                        
                        $image5 = array(
                                  'src' => base_url().'images/icons/fugue/flag_gris.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        $image6 = array(
                                  'src' => base_url().'images/icons/fugue/cross-circle.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        $image7 = array(
                                  'src' => base_url().'images/icons/fugue/arrow-curve-090.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        $image8 = array(
                                  'src' => base_url().'images/icons/finefiles/32/excel.png',
                                  'width' => '16',
                                  'height' => '16',
                        );
                        
                    ?>
						<tr>
							<td align="right"><?php echo $row->id;?></td>
							<td><?php echo $row->fecha;?></td>
							<td><?php echo $row->nombre;?></td>
							<td><?php echo $row->numsuc.' - '.$row->sucursal;?></td>
							<td><?php echo $row->est;?></td>
							<td align="right"><?php echo number_format($row->cantidad, 0);?></td>
							<td align="right"><?php echo number_format($row->adicional, 0);?></td>
							<td class="table-actions" align="center">
                                <?php 
                                        echo anchor('pedidos/captura_pedido_automatico/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                ?>
							</td>
						</tr>
                        <?php }?>
					</tbody>
            </table>
            
            </p>
