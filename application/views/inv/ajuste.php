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
                            
                            //echo anchor('productos/nuevo_producto/'.$tipo.'/'.$submenu, img($image).' nuevo producto');
                        ?>
                        
            </h1>
            <p>
            
            <h2 align="center">Productos en inventario: <?php echo count($query); ?></h2>
            
            <table class="table sortable" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Clave</th>
							<th scope="col">Desc.</th>
							<th scope="col">Unidad</th>
							<th scope="col">Lote</th>
							<th scope="col">Caducidad</th>
							<th scope="col">Inv Ant</th>
							<th scope="col">Inv Nue</th>
							<th scope="col">Dif</th>
							<th scope="col">Ajuste</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $piezas = 0;
                    $min = 0;
                    $max = 0;
                    foreach($query as $row){
                        
                        $data = array(
                          'name'        => 'inv_'.$row->id_inv,
                          'id'          => 'inv_'.$row->id_inv,
                          'value'       => $row->inv,
                          'size'        => 10
                        );
                    ?>
						<tr>
							<td align="right"><?php echo $row->id;?></td>
							<td><?php echo $row->clave;?></td>
							<td><?php echo $row->descripcion;?></td>
							<td><?php echo $row->unidad;?></td>
							<td align="left"><?php echo $row->lote;?></td>
							<td align="left"><?php echo $row->caducidad;?></td>
							<td align="right"><span id="invant_<?php echo $row->id_inv?>"><?php echo $row->inv;?></span></td>
							<td align="right"><span id="invnue_<?php echo $row->id_inv?>"></span></td>
							<td align="right"><span id="dif_<?php echo $row->id_inv?>"></span></td>
							<td align="right"><?php echo form_input($data);?></td>
						</tr>
                    <?php
                    
                        $piezas = $piezas + $row->inv;
                    }
                    ?>
					</tbody>
                    <tfoot>
                    <tr>
                    <td colspan="6" align="right">Total</td>
                    <td align="right"><?php echo number_format($piezas, 0);?></td>
                    <td colspan="3" align="right">&nbsp;</td>
                    </tr>
                    </tfoot>
            </table>
            
            </p>
        </div>



    </div>
</section>