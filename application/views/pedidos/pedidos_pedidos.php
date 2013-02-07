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
							<th scope="col">Alta</th>
							<th scope="col">Capturado</th>
							<th scope="col">Surtido</th>
							<th scope="col">Embarque</th>
							<th scope="col">Canreq</th>
							<th scope="col">Cansur</th>
							<th scope="col">%</th>
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

                        $image9 = array(
                                  'src' => base_url().'images/icons/fugue/flag_blue.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        if($row->flag == 1){
                            $bandera = '<span id="flag_'.$row->id.'" tittle="'.$row->flag.'">'.img($image4).'</span>';
                        }else{
                            $bandera = '<span id="flag_'.$row->id.'" tittle="'.$row->flag.'">'.img($image5).'</span>';
                        }
                        
                        if($row->automatico == 1){
                            $bandera2 = '<span id="flag_'.$row->id.'" tittle="'.$row->flag.'">'.img($image9).'</span>';
                        }else{
                            $bandera2 = null;
                        }
                        
                    ?>
						<tr>
							<td align="right"><?php echo $row->id;?></td>
							<td><?php echo $row->fecha;?></td>
							<td><?php echo $row->nombre;?></td>
							<td><?php echo $row->numsuc.' - '.$row->sucursal." ".$bandera." ".$bandera2;?></td>
							<td><?php echo $row->est;?></td>
							<td><?php echo $row->alta;?></td>
							<td><?php echo $row->f_captura;?></td>
							<td><?php echo $row->f_surtido;?></td>
							<td><?php echo $row->f_embarque;?></td>
							<td align="right"><?php echo number_format($row->canreq, 0);?></td>
							<td align="right"><?php echo number_format($row->cansur, 0);?></td>
							<td align="right"><?php if($row->canreq == 0){echo "0.00";}else{ echo number_format(($row->cansur/$row->canreq) * 100, 2);}?></td>
							<td class="table-actions" align="center">
                                <?php 
                                $nivel = $this->session->userdata('nivel');
                                
                                if($nivel == 2){
                                    if($row->estatus == 0){
                                        echo anchor('pedidos/captura_pedido/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                    }else{
                                        echo anchor('pedidos/historico/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Ver Detalle', 'class' => 'with-tip'));
                                    }
                                    
                                }else{

                                    if($row->estatus == 0){
                                        echo anchor('pedidos/captura_pedido/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                        echo anchor('pedidos/cancela_pedido/'.$row->id, img($image6), array('title' => 'Cancela Pedido', 'class' => 'with-tip'));
                                    }elseif($row->estatus == 1){
                                        echo anchor('pedidos/captura_surtido2/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                        echo anchor('pedidos/previo_pedido_surtido/'.$row->id.'/'.$submenu, img($image3), array('title' => 'Impresion', 'class' => 'with-tip', 'target' => '_blank'));
                                        echo anchor('pedidos/cancela_pedido/'.$row->id, img($image6), array('title' => 'Cancela Pedido', 'class' => 'with-tip'));
                                        echo anchor('pedidos/regresa_pedido/'.$row->id.'/'.$row->estatus, img($image7), array('title' => 'Regresa pedido al estado anterior', 'class' => 'with-tip'));
                                    }elseif($row->estatus == 2){
                                        echo anchor('pedidos/captura_embarque/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                        echo anchor('pedidos/cancela_pedido/'.$row->id, img($image6), array('title' => 'Cancela Pedido', 'class' => 'with-tip'));
                                        echo anchor('pedidos/regresa_pedido/'.$row->id.'/'.$row->estatus, img($image7), array('title' => 'Regresa pedido al estado anterior', 'class' => 'with-tip'));
                                    }elseif($row->estatus == 3){
                                        echo anchor('pedidos/embarcado/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Ver Detalle', 'class' => 'with-tip'));
                                        echo anchor('pedidos/pedido_embarque/'.$row->id.'/'.$submenu, img($image3), array('title' => 'Impresion', 'class' => 'with-tip', 'target' => '_blank'));
                                        echo anchor('pedidos/pedido_embarque_formato/'.$row->id.'/'.$submenu, img($image3), array('title' => 'Impresion formato', 'class' => 'with-tip', 'target' => '_blank'));
                                        echo anchor('pedidos/pedido_embarcado_excel/'.$row->id, img($image8), array('title' => 'Bajar a Excel', 'class' => 'with-tip', 'target' => '_blank'));
                                        echo anchor('pedidos/regresa_pedido/'.$row->id.'/'.$row->estatus, img($image7), array('title' => 'Regresa pedido al estado anterior', 'class' => 'with-tip'));
                                    }
                                
                                }
                                ?>
							</td>
						</tr>
                    <?php
                    }
                    ?>
					</tbody>
            </table>
            
            </p>
