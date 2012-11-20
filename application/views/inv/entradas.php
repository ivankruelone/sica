<section class="grid_12">
    <div class="block-border">


        <div class="block-content">
            <h1>
                        <?php echo $titulo;?>
                        <?php
                            $image = array(
                                      'src' => base_url().'images/icons/fugue/plus-circle-blue.png',
                                      'width' => '16',
                                      'height' => '16',
                            );
                            
                            if(is_array($subtipo)){
                                foreach($subtipo as $st){
                                    $subtipo = $st;
                                }
                            }else{
                                $subtipo = $subtipo;
                            }
                            
                            switch($subtipo){
                                case 2:
                                    echo anchor('inv/nueva_entrada_planta/'.$submenu, img($image).' nueva entrada', array('id' => 'nueva'));
                                    break;
                                case 3:
                                    echo anchor('inv/nueva_devo/'.$submenu, img($image).' nueva Devolucion', array('id' => 'nueva'));
                                    break;
                                case 4:
                                    echo anchor('inv/nueva_proveedor/'.$submenu, img($image).' nueva Entrada de Proveedor', array('id' => 'nueva'));
                                    break;
                                case 102:
                                    echo anchor('inv/nuevo_transpaso/'.$submenu, img($image).' nueva Transpaso de Mercancia', array('id' => 'nueva'));
                                    break;
                                case 401:
                                    echo anchor('inv/nueva_devo_sucursales_merma/'.$submenu, img($image).' nueva Devolucion de Mercancia de Sucursal', array('id' => 'nueva'));
                                    break;
                                case 402:
                                    echo anchor('inv/nueva_devo_sucursales_merma/'.$submenu, img($image).' nueva Devolucion de Mercancia de Sucursal', array('id' => 'nueva'));
                                    break;
                                case 103:
                                    echo anchor('inv/nueva_devo_almacen_merma/'.$submenu, img($image).' nueva Devolucion de Mercancia de Sucursal', array('id' => 'nueva'));
                                    break;
                                case 104:
                                    echo anchor('inv/nueva_devo_almacen_merma/'.$submenu, img($image).' nueva Devolucion de Mercancia de Sucursal', array('id' => 'nueva'));
                                    break;
                                case 105:
                                    echo anchor('inv/nueva_devo_almacen_merma/'.$submenu, img($image).' nueva Devolucion de Mercancia de Sucursal', array('id' => 'nueva'));
                                    break;
                            }
                        ?>
                        
            </h1>
            <p>
            <table class="table sortable" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Movimiento</th>
							<th scope="col">Sucursal</th>
							<th scope="col">Proveedor</th>
							<th scope="col">Referencia</th>
							<th scope="col">Cerrado</th>
							<th scope="col">Status</th>
							<th scope="col">Piezas</th>
							<th scope="col">Monto</th>
							<th scope="col">Accion</th>
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
                        
                        $image6 = array(
                                  'src' => base_url().'images/icons/fugue/cross-circle.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        $image8 = array(
                                  'src' => base_url().'images/icons/finefiles/32/excel.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        $iva = array(
                            0 => 'NO',
                            1 => 'SI'
                            );

                            switch($row->subtipo){
                                case 2:
                                    $l1 = anchor('inv/entrada/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                    break;
                                case 3:
                                    $l1 = anchor('inv/entrada/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                    break;
                                case 4:
                                    $l1 = anchor('inv/entrada_precio/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                    break;
                                case 102:
                                    $l1 = anchor('inv/entrada/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                    break;
                                case 401:
                                    $l1 = anchor('inv/entrada/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                    break;
                                case 402:
                                    $l1 = anchor('inv/entrada/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                    break;
                                case 103:
                                    $l1 = anchor('inv/entrada/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                    break;
                                case 104:
                                    $l1 = anchor('inv/entrada/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                    break;
                                case 105:
                                    $l1 = anchor('inv/entrada/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                                    break;
                            }
                    ?>
						<tr>
							<td align="right"><?php echo $row->id;?></td>
							<td><?php echo $row->movimiento;?></td>
							<td><?php echo $row->sucursal;?></td>
							<td><?php echo $row->proveedor;?></td>
							<td><?php echo $row->referencia;?></td>
							<td><?php echo $row->cerrado;?></td>
							<td><?php echo $row->estatus_desc;?></td>
							<td align="right"><?php echo number_format($row->piezas, 0);?></td>
							<td align="right"><?php echo number_format($row->monto, 2);?></td>
							<td class="table-actions" align="center">
                                <?php echo $l1;?>
                                <?php
                                    if($row->estatus == 0){
                                        echo anchor('inv/cancela_folio/'.$row->id, img($image6), array('title' => 'Cancela Pedido', 'class' => 'with-tip'));
                                    }elseif($row->estatus == 1){
                                        echo anchor('inv/reporte/'.$row->id.'/'.$submenu, img($image3), array('title' => 'Impresion', 'class' => 'with-tip', 'target' => '_blank'));
                                        echo anchor('inv/movimiento_excel/'.$row->id.'/'.$submenu, img($image8), array('title' => 'Bajar a excel', 'class' => 'with-tip', 'target' => '_blank'));
                                    }elseif($row->estatus == 2){
                                        
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
        </div>



    </div>
</section>