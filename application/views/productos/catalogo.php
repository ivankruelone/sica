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
                            
                            echo anchor('productos/nuevo_producto/'.$submenu, img($image).' nuevo producto');
                        ?>
                        
            </h1>
            
            <p align="center">
                <?php
                if(isset($paginacion)){
                    echo $this->pagination->create_links();
                }
                ?>
            </p>
            <?php
            
            if(isset($tr)){
            ?>
            <h2 align="center">Productos en este catalogo: <?php echo $tr;?></h2>
            <?php
            }
            ?>        
            <p>

            
            <table class="table sortable" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Clave</th>
							<th scope="col">EAN</th>
							<th scope="col">Desc.</th>
							<th scope="col">Unidad</th>
							<th scope="col">Tipo</th>
							<th scope="col">Subtipo</th>
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
                            
                            if($row->activo == 0){
                                $color = 'style="background-color: #FF8080;"';
                            }else{
                                $color = null;
                            }
                            
                    ?>
						<tr>
							<td align="right" <?php echo $color;?>><?php echo $row->id;?></td>
							<td <?php echo $color;?>><?php echo $row->clave;?></td>
							<td align="right" <?php echo $color;?>><?php echo $row->ean;?></td>
							<td <?php echo $color;?>><?php echo $row->descripcion;?></td>
							<td <?php echo $color;?>><?php echo $row->unidad;?></td>
							<td <?php echo $color;?>><?php echo $row->tipo;?></td>
							<td <?php echo $color;?>><?php echo $row->subtipo;?></td>
							<td align="center" <?php echo $color;?>><?php echo $iva[$row->iva];;?></td>
							<td class="table-actions" align="center" <?php echo $color;?>>
                                <?php echo anchor('productos/editar_producto/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));?>
							</td>
						</tr>
                    <?php
                    }
                    ?>
					</tbody>
            </table>
            
            </p>

            <p align="center">
                <?php
                if(isset($paginacion)){
                    echo $this->pagination->create_links();
                }
                ?>
            </p>

        </div>



    </div>
</section>