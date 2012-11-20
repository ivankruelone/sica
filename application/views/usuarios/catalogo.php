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
                            
                            if($nivel == 1){
                                echo anchor('usuarios/nuevo_usuario/'.$submenu, img($image).' nuevo usuario');
                            }
                        ?>
                        
            </h1>
            <p>
            <table class="table" cellspacing="0" width="100%">
            <caption>Hay un total de <?php echo count($query);?> usuarios registrados.</caption>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Usuario</th>
							<th scope="col">Nombre</th>
							<th scope="col">E-mail</th>
							<th scope="col">Nivel</th>
							<th scope="col">Edo.</th>
							<th scope="col">Jur</th>
							<th scope="col">Sucursal</th>
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
							<td><?php echo $row->usuario;?></td>
							<td><?php echo $row->nombre;?></td>
							<td><?php echo $row->email;?></td>
							<td><?php echo $row->nombre_nivel;?></td>
							<td><?php echo $row->estado_c;?></td>
							<td><?php echo $row->jurisdiccion;?></td>
							<td><?php echo $row->numsuc." - ".$row->sucursal;?></td>
							<td class="table-actions" align="center">
                                <?php
                                if($nivel == 1){
                                    echo anchor('usuarios/editar_usuario/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
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
            <p align="center">
            <?php echo $this->pagination->create_links();?>
            </p>
            
            
        </div>



    </div>
</section>