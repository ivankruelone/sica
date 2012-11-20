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
                            
                            echo anchor('proveedores/nuevo_proveedor/'.$submenu, img($image).' nuevo proveedor');
                        ?>
                        
            </h1>
            <p>
            <table class="table sortable" cellspacing="0" width="100%">
            <caption>Hay un total de <?php echo count($query);?> proveedores registrados.</caption>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col"># Prov.</th>
							<th scope="col">RFC</th>
							<th scope="col">Razon Social</th>
							<th scope="col">Contacto</th>
							<th scope="col">Telefono</th>
							<th scope="col">Email</th>
							<th scope="col">Condiciones</th>
							<th scope="col">Limite</th>
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
							<td><?php echo $row->id;?></td>
							<td><?php echo $row->npro;?></td>
							<td><?php echo $row->rfc;?></td>
							<td><?php echo $row->razon;?></td>
							<td><?php echo $row->contacto;?></td>
							<td><?php echo $row->tel;?></td>
							<td><?php echo $row->email;?></td>
							<td><?php echo $row->condiciones;?></td>
							<td align="right"><?php echo number_format($row->limite, 2);?></td>
							<td class="table-actions" align="center">
                                <?php echo anchor('proveedores/editar_proveedor/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));?>
							</td>
						</tr>
                    <?php
                    }
                    ?>
					</tbody>
            </table>
            
            </p>
            <p align="center">
            <?php echo $this->pagination->create_links();?>
            </p>
            
            
        </div>



    </div>
</section>