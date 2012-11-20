<div class="block-border">
    <div class="block-content">


<h1>
            Receta: <?php echo $receta; ?>
                        <?php
                            $image = array(
                                      'src' => base_url().'images/icons/fugue/control-180.png',
                                      'width' => '16',
                                      'height' => '16',
                            );
                            
                            echo anchor('pacientes/expediente/'.$id, img($image).' regresar el expediente');
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
                    <?php
                    

                    ?>
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
            

    </div>

    <div class="block-content">

        <h1>Receta</h1>

        <div align="center" id="receta">
        <?php
            $this->load->view('pacientes/formato_receta', $receta);
        ?>
        </div>
        <p align="center">
            <button id="imprimir" class="big">Imprimir Receta   </button>
        </p>
    </div>
</div>