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
            <table class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Codigo</th>
							<th scope="col">EAN</th>
							<th scope="col">Desc.</th>
							<th scope="col">Unidad</th>
							<th scope="col">P. Activo</th>
							<th scope="col">P. Far.</th>
							<th scope="col">P. Dis.</th>
							<th scope="col">IVA</th>
							<th scope="col">&nbsp;</th>
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
                        
                        $iva = array(
                            0 => 'NO',
                            1 => 'SI'
                            );
                    ?>
						<tr>
							<td align="right"><?php echo $row->id;?></td>
							<td><?php echo $row->codigo;?></td>
							<td align="right"><?php echo $row->ean;?></td>
							<td><?php echo $row->descripcion;?></td>
							<td><?php echo $row->unidad;?></td>
							<td><?php echo $row->pactivo;?></td>
							<td align="right"><?php echo number_format($row->pfarmacia, 2);?></td>
							<td align="right"><?php echo number_format($row->pdistribuidor, 2);?></td>
							<td align="right"><?php echo $iva[$row->iva];;?></td>
							<td class="table-actions" align="center">
                                <?php echo anchor('productos/editar_producto/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));?>
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