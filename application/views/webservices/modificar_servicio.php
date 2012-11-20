<?php
	$row = $query->row();
?>
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
                            
                            $image1 = array(
                                      'src' => base_url().'images/icons/fugue/tick-circle.png',
                                      'width' => '16',
                                      'height' => '16',
                            );
                            $image2 = array(
                                      'src' => base_url().'images/icons/fugue/cross-circle.png',
                                      'width' => '16',
                                      'height' => '16',
                            );
                            $image3 = array(
                                      'src' => base_url().'images/icons/fugue/navigation.png',
                                      'width' => '16',
                                      'height' => '16',
                            );

                            //echo anchor('webservices/nuevo_servicio/'.$submenu, img($image).' nuevo servicio');
                        ?>
                        
            </h1>
            <?php echo form_open('webservices/modificar_servicio_submit', array('class' => 'form', 'id' => 'nuevo_servicio_form'));?>
            <fieldset>
            <legend>Agrega los datos y da click en Guardar</legend>

            <p>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" required="required" maxlength="45" class="medium-width" value="<?php echo $row->nombre; ?>"/>
            </p>

            <p>
                <label for="dire">Direccion</label>
                <input type="text" name="dire" id="dire" required="required" maxlength="255" class="full-width" value="<?php echo $row->url; ?>"/>
            </p>

            <p>
                <label for="namespace">Namespace</label>
                <input type="text" name="namespace" id="namespace" required="required" maxlength="45" class="medium-width" value="<?php echo $row->namespace; ?>"/>
            </p>
            
            <p>
                <label for="tipo">Tipo</label>
                <?php echo form_dropdown('tipo', $tipos, $row->tipo, 'id="tipo"'); ?>
            </p>

            <p>
                <label for="estado">Estado</label>
                <?php echo form_dropdown('estado', $estados, $row->edo, 'id="estado"'); ?>
            </p>
            
            <p>
                <button class="big" type="submit">Guardar Servicio</button>
            </p>

            </fieldset>
            <?php
            echo form_hidden('id', $row->id); 
            echo form_close();
            ?>

            
        </div>
    </div>
</section>