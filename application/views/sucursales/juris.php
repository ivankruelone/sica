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
                            
                            echo anchor('sucursales/nueva_juris/'.$submenu, img($image).' nueva jurisdiccion');
                        ?>
                        
            </h1>
            <p>
            <table class="table sortable" width="70%">
            <caption>Hay un total de <?php echo count($query);?> jurisdicciones registradas.</caption>
					<thead>
						<tr>
							<th scope="col">Estado</th>
							<th scope="col">Jurisdiccion</th>
							<th scope="col">Nombre</th>
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
							<td><?php echo $row->estado;?></td>
							<td><?php echo $row->juris;?></td>
							<td><?php echo $row->jurisdiccion;?></td>
							<td class="table-actions" align="center">
                                <?php echo anchor('sucursales/editar_juris/'.$row->juris.'/'.$row->estado_int, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));?>
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