<section class="grid_6">
    <div class="block-border">

        
        <div class="block-content" id="formato">
        <?php echo form_open('clientes/submit_nuevo_cliente', array('class' => 'form', 'id' => 'nuevo_cliente_form'));?>
        
            <h1>
                <?php echo $titulo;?>
            </h1>
            
            
            
            
            <fieldset>
            <legend>Modifica los valores y da click en Guardar</legend>
            
            <p>
                <label for="clave">Clave</label>
                 <input type="text" name="clave" id="clave" required="required" />
            </p>
            
            <p>
                <label for="apaterno">Apellido Paterno</label>
                <input type="text" name="apaterno" id="apaterno" class="full-width" maxlength="45" required="required" />
            </p>

            <p>
                <label for="amaterno">Apellido Materno</label>
                <input type="text" name="amaterno" id="amaterno" class="full-width" maxlength="45" required="required" />
            </p>

            <p>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="full-width" maxlength="45" required="required" />
            </p>

            <p>
                <label for="fecnac">Fecha de Nacimiento</label>
                <input type="date" name="fecnac" id="fecnac" required="required" />
            </p>

            <p>
                <label for="sexo">Sexo</label>
                <?php echo form_dropdown('sexo', $sexo, '', 'id="sexo"');?>
            </p>

            <p>
                <label for="programa">Programa de Salud</label>
                <?php echo form_dropdown('programa', $programas, '', 'id="programa"');?>
            </p>

            </fieldset>
            
            <p>
                <button class="big" type="submit">Guardar Cambios</button>
            </p>
            
        <?php echo form_close();?>
        </div>
         
        
        
    </div>
</section>
