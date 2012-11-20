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
                            
                            echo anchor('pacientes/nuevo_paciente/'.$submenu, img($image).' nuevo paciente');
                        ?>
                        
            </h1>
            <p>
            <table class="table" cellspacing="0" width="100%">
            <caption>Hay un total de <b><?php echo count($query);?> Paciente(s)</b> registrado(s).</caption>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Clave</th>
							<th scope="col">Nombre del Paciente</th>
							<th scope="col">F. Nac.</th>
							<th scope="col">Edad</th>
							<th scope="col">Sexo</th>
							<th scope="col">Programa</th>
							<th scope="col" colspan="2" align="center">Acciones</th>
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
                                  'src' => base_url().'images/icons/fugue/file.png',
                                  'width' => '32',
                                  'height' => '32',
                        );

                        $iva = array(
                            0 => 'NO',
                            1 => 'SI'
                            );
                    ?>
						<tr>
							<td><?php echo $row->id;?></td>
							<td><?php echo $row->clave;?></td>
							<td><?php echo $row->apaterno.' '.$row->amaterno.' '.$row->nombre;?></td>
							<td><?php echo $row->fecnac;?></td>
							<td><?php echo $row->edad;?></td>
							<td><?php echo $row->sexo;?></td>
							<td><?php echo $row->programa_text;?></td>
							<td class="table-actions" align="center">
                                <?php echo anchor('pacientes/editar_paciente/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));?>
							</td>
							<td class="table-actions" align="center">
                                <?php echo anchor('pacientes/expediente/'.$row->id.'/'.$submenu, img($image3), array('title' => 'e-Expediente', 'class' => 'with-tip'));?>
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