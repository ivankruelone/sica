<section class="grid_12">
    <div class="block-border">


        <div class="block-content">
            <h1>
                        <?php 
                        $elige = $this->input->post('elige');
                        $e = explode("-", $elige);
                        $tipo = $e[0];
                        $subtipo = $e[1];
                        
                        $this->db->where('id', $tipo);
                        $qtipo = $this->db->get('tipo_producto');
                        $rtipo = $qtipo->row();

                        $this->db->where('id', $subtipo);
                        $qsubtipo = $this->db->get('subtipo_producto');
                        $rsubtipo = $qsubtipo->row();

                        echo $titulo.": ".$rtipo->tipo_producto." - ".$rsubtipo->subtipo_producto;
                        ?>
                        <?php
                            
                            $image = array(
                                      'src' => base_url().'images/icons/fugue/hp_printer.png',
                                      'width' => '16',
                                      'height' => '16',
                            );
                            
                            echo anchor('inv/inv_clasificado_imprimir/'.$tipo.'/'.$subtipo, img($image).' imprimir', array('target' => '_blank'));
                        ?>
                        
            </h1>
            <p>
            
            <h2 align="center">Productos en inventario: <?php echo count($query); ?></h2>
            
            <table class="table sortable" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Clave</th>
							<th scope="col">EAN</th>
							<th scope="col">Desc.</th>
							<th scope="col">Unidad</th>
							<th scope="col">Min.</th>
							<th scope="col">Max.</th>
							<th scope="col">Reorden</th>
							<th scope="col">Inv.</th>
							<th scope="col">Nivel</th>
							<th scope="col">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $piezas = 0;
                    $min = 0;
                    $max = 0;
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
                        
                        $iva = array(
                            0 => 'NO',
                            1 => 'SI'
                            );
                            
                            
                            if($row->inv <= 0){
                                $porcentaje = 0;
                                $por_ley = '-0%';
                            }elseif($row->inv > $row->max){
                                $porcentaje = 100;
                                if($row->max > 0){
                                    $por_ley = round(($row->inv / $row->max) * 100, 0);
                                }else{
                                    $por_ley = 100;
                                }
                            }else{
                                $porcentaje = round(($row->inv / $row->max) * 100, 0);
                                $por_ley = round(($row->inv / $row->max) * 100, 0);
                            }
                            
                            
                            if($row->inv >= $row->preorden && $row->inv <= $row->max)
                            {
                                $color = 'green';
                            }elseif($row->inv < $row->preorden && $row->inv >= $row->min){
                                $color = 'orange';
                            }elseif($row->inv < $row->min){
                                $color = 'purple';
                            }else{
                                $color = '';
                            }
                            
                            
                    ?>
						<tr>
							<td align="right"><?php echo $row->id;?></td>
							<td><?php echo $row->clave;?></td>
							<td align="right"><?php echo $row->ean;?></td>
							<td><?php echo $row->descripcion;?></td>
							<td><?php echo $row->unidad;?></td>
							<td align="right"><?php echo number_format($row->min, 0);?></td>
							<td align="right"><?php echo number_format($row->max, 0);?></td>
							<td align="right"><?php echo number_format($row->preorden, 0);?></td>
							<td align="right"><b><?php echo number_format($row->inv, 0);?></b></td>
							<td align="center">
                                <span class="progress-bar">
                                    <span class="<?php echo $color;?>" style="width: <?php echo $porcentaje;?>%"><?php echo $por_ley;?>%</span>
                                </span>
                            </td>
							<td class="table-actions" align="center">
                                <?php echo anchor('inv/inv_detalle_modal/'.$row->id, 'Detalle', array('id' => 'detalle_'.$row->id.'_'.$row->descripcion, 'class' => 'button red'))?>
							</td>
						</tr>
                    <?php
                    
                        $piezas = $piezas + $row->inv;
                    }
                    ?>
					</tbody>
                    <tfoot>
                    <tr>
                    <td colspan="8" align="right">Total</td>
                    <td align="right"><?php echo number_format($piezas, 0);?></td>
                    <td colspan="2">&nbsp;</td>
                    </tr>
                    </tfoot>
            </table>
            
            </p>
        </div>



    </div>
</section>