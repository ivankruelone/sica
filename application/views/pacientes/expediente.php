<section class="grid_12">
    <div class="block-border">


        <div class="block-content">
            <h1>
                        <?php echo $titulo;?>: Paciente
                        <?php
                            $image = array(
                                      'src' => base_url().'images/icons/fugue/plus-circle-blue.png',
                                      'width' => '16',
                                      'height' => '16',
                            );
                            
                            echo anchor('pacientes/nueva_receta/'.$id, img($image).' nueva receta');
                        ?>
                        
            </h1>
            <p>
            <table class="table" cellspacing="0" width="100%">
            <caption>Datos del Paciente</caption>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Clave</th>
							<th scope="col">Nombre del Paciente</th>
							<th scope="col">F. Nac.</th>
							<th scope="col">Edad</th>
							<th scope="col">Sexo</th>
							<th scope="col">Programa</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $row->id;?></td>
							<td><?php echo $row->clave;?></td>
							<td><?php echo $row->apaterno.' '.$row->amaterno.' '.$row->nombre;?></td>
							<td><?php echo $row->fecnac;?></td>
							<td><?php echo $row->edad;?></td>
							<td><?php echo $row->sexo;?></td>
							<td><?php echo $row->programa_text;?></td>
						</tr>
					</tbody>
            </table>
            
            </p>
            
            
        </div>
        
        <div class="block-content">
        
            <h1>
                Ultimas anotaciones
                <?php
                    $image = array(
                                      'src' => base_url().'images/icons/fugue/plus-circle-blue.png',
                                      'width' => '16',
                                      'height' => '16',
                        );
                            
                    echo anchor('pacientes/nueva_anotacion/'.$id, img($image).' nueva anotacion', array('id' => 'nueva_anotacion'));
                ?>
            </h1>

            <p>
            <table class="table" cellspacing="0" width="100%">
            <caption>Anotaciones</caption>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Realizada</th>
							<th scope="col">Modificada</th>
							<th scope="col">Anotacion</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    
                    foreach($anotaciones as $row1){

                    ?>
						<tr>
							<td><?php echo $row1->id;?></td>
							<td><?php echo $row1->fecha;?></td>
							<td><?php echo $row1->fecmodi;?></td>
							<td><?php echo $row1->anotacion;?></td>
						</tr>
                    <?php

                    }

                    ?>
					</tbody>
            </table>
            
            </p>
        
        </div>


        <div class="block-content">
        
            <h1>
                Ultima prescripcion
                <?php
                    $image = array(
                                      'src' => base_url().'images/icons/fugue/plus-circle-blue.png',
                                      'width' => '16',
                                      'height' => '16',
                        );
                            
                    echo anchor('pacientes/todas_recetas/'.$id, img($image).' ver todas las prescripciones');
                ?>
            
            </h1>

            <p>
            <table class="table" cellspacing="0" width="100%">
            <caption>Anotaciones</caption>
					<thead>
						<tr>
							<th scope="col">Folio</th>
							<th scope="col">F. Prescripcion</th>
							<th scope="col">F. Surtido</th>
							<th scope="col">Status</th>
							<th scope="col">Ver</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    
                        $image1 = array(
                                  'src' => base_url().'images/icons/fugue/cards-address.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                    
                    foreach($recetas as $row2){

                    ?>
						<tr>
							<td><?php echo  str_pad($this->session->userdata('numsuc'), 6, '0', STR_PAD_LEFT).$row2->fecha_folio.$row2->id;?></td>
							<td><?php echo $row2->fecha;?></td>
							<td><?php echo $row2->surtida;?></td>
							<td><?php echo $row2->receta_estatus;?></td>
							<td class="table-actions" align="center">
                                <?php echo anchor('pacientes/receta/'.$id.'/'.$row2->id, img($image1), array('title' => 'Modificar', 'class' => 'with-tip'));?>
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