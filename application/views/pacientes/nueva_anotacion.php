<div class="block-border">
    <div class="block-content">


<h1>
            Agrega Anotacion: <?php echo $id; ?>
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
            
            </p>


<?php
	echo form_open('pacientes/submit_nueva_anotacion', array('id' => 'nueva_anotacion_form', 'class' => 'form'));
?>
<fieldset>

    <legend>Agrega tu anotacion.</legend>
            
            <p>
                <textarea cols="100" rows="10" wrap="OFF" name="anotacion" id="anotacion"></textarea>
            </p>

<input type="hidden" value="<?php echo $id; ?>" name="paciente_id" id="paciente_id" />

</fieldset>

            <p>
                <button class="big" type="submit">Guardar Cambios</button>
            </p>


<?php
	echo form_close();
?>

    </div>
</div>