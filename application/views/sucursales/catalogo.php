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
                            
                            echo anchor('sucursales/nueva_sucursal/'.$submenu, img($image).' nueva sucursal');
                        ?>
                        
            </h1>
            <p>
            <table class="table sortable" cellspacing="0" width="100%">
            <caption>Hay un total de <?php echo count($query);?> sucursales registradas.</caption>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Cia.</th>
							<th scope="col">estado</th>
							<th scope="col">Juris</th>
							<th scope="col">Numsuc</th>
							<th scope="col">Sucursal</th>
							<th scope="col">Calle</th>
							<th scope="col">Colonia</th>
							<th scope="col">Municipio</th>
							<th scope="col">CP</th>
							<th scope="col">Pedido</th>
							<th scope="col">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    //id, cia, juris, numsuc, sucursal, calle, exterior, interior, colonia, referencia, municipio, estado_int, estado, cp, diaped, cad_min, alta, modificado
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
							<td><?php echo $row->cia;?></td>
							<td><?php echo $row->estado;?></td>
							<td><?php echo $row->juris;?></td>
							<td><?php echo $row->numsuc;?></td>
							<td><?php echo $row->sucursal;?></td>
							<td><?php echo $row->calle." ".$row->exterior." ".$row->interior;?></td>
							<td><?php echo $row->colonia;?></td>
							<td><?php echo $row->municipio;?></td>
							<td><?php echo $row->cp;?></td>
							<td><?php echo $row->diaped;?></td>
							<td class="table-actions" align="center">
                                <?php echo anchor('sucursales/editar_sucursal/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));?>
                                <?php echo anchor('#map_cambas', img($image1), array('title' => 'Modificar', 'class' => 'with-tip', 'id' => 'elige_'.$row->colonia.', '.$row->municipio.', '.$row->estado.', '.str_pad($row->cp, 5, "0", STR_PAD_LEFT).', '.$row->calle.' '.$row->exterior));?>
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

        <div class="block-content">
            <h1>Ubicacion</h1>
            <p>
            <div id="map_canvas" style="width: 100%; height: 600px;"></div>
            </p>
        </div>


    </div>
</section>