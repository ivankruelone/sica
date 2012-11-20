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
                            
                            echo anchor('clientes/nuevo_consigna/'.$submenu, img($image).' nuevo domicilio de consignacion');
                        ?>
                        
            </h1>
            <p>
            <table class="table" cellspacing="0" width="100%">
            <caption>Hay un total de <?php echo count($query);?> Domicilio a Consignar registrado(s).</caption>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Nombre</th>
							<th scope="col">Domicilio</th>
							<th scope="col">Contacto</th>
							<th scope="col">Telefono</th>
							<th scope="col">Email</th>
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
                            
                            if($row->nombre == 'DEFAULT'){
                                $l1 = '&nbsp;';
                            }else{
                                $l1 = anchor('clientes/editar_cliente/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));
                            }
                            
                    ?>
						<tr>
							<td><?php echo $row->id;?></td>
							<td><?php echo $row->nombre;?></td>
							<td <?php if($row->nombre == 'DEFAULT'){echo 'id="direccion"';}?>><?php echo $row->calle.' '.$row->exterior.' '.$row->interior.' '.$row->colonia.' '.$row->municipio.' '.$row->estado.' '.$row->cp;?></td>
							<td><?php echo $row->contacto;?></td>
							<td><?php echo $row->tel;?></td>
							<td><?php echo $row->email;?></td>
							<td class="table-actions" align="center">
                                <?php echo $l1;?>
							</td>
						</tr>
                    <?php
                    }
                    ?>
					</tbody>
            </table>
            
            
        </div>
        
        <div class="block-content">
            <h1>Ubicacion</h1>
            <p>
            <div id="map_canvas" style="width: 100%; height: 600px;"></div>
            </p>
        </div>



    </div>
</section>