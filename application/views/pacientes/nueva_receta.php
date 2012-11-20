<div class="block-border">
    <div class="block-content">


<h1>
            Agrega Receta: <?php echo $id; ?>
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
            
            <div align="center">
            
            <?php echo form_open('', array('class' => 'form', 'osSubmit' => 'return false;'));?>
            <fieldset>
            
            Clave de Diagnostico CIE 10: 
            
            <input type="text" name="cieprimaria" id="cieprimaria" class="small-width" placeholder="CIE Primaria" />
            <select id="ciesecundaria" name="ciesecundaria"></select>
            <button id="resetea_cie" class="small red">Resetea</button>
            </fieldset>
            
            <?php echo form_close();?>
            
            <?php echo form_open('pedidos/submit_captura_clave', array('class' => 'form', 'id' => 'captura_clave_form'));?>
            <fieldset>
            <legend>Captura Clave y Piezas y continua</legend>
                
                <input type="text" name="clave" id="clave" required="required" class="medium-width" placeholder="Clave" />
                
                
                <input type="number" name="piezas" id="piezas" required="required" placeholder="Piezas" />
                <button class="big" type="submit">Agregar a Receta</button>


            </fieldset>
            <?php echo form_hidden('id', $id);?>
            <?php echo form_close();?>
        </div>

    </div>

    <div class="block-content">

        <h1>Productos en esta Receta</h1>

        <div align="center" id="tabla_captura">
        </div>
        <p align="center">
            <button id="terminar_receta" class="big">Terminar Receta Electronica</button>
        </p>
    </div>
</div>