<section class="grid_6">
    <div class="block-border">


        <div class="block-content" id="formato">
            <h1>
                <?php echo $titulo;?>
            </h1>
            <?php echo form_open('productos/submit_editar_producto', array('class' => 'form', 'id' => 'editar_producto_form'));?>
            <fieldset>
            <legend>Modifica los valores y da click en Guardar</legend>
            
            <p>
                <label for="clave">Clave de Gobierno</label>
                <input type="text" name="clave" id="clave" required="required" />
            </p>

            <p>
                <label for="tipo_producto">Tipo de producto</label>
                <?php echo form_dropdown('tipo_producto', $tipo, '', 'id="tipo_producto"');?>
            </p>
            
            <p>
                <label for="subtipo_producto">Subtipo de producto</label>
                <?php echo form_dropdown('subtipo_producto', $subtipo, '', 'id="subtipo_producto"');?>
            </p>

            <p>
                <label for="ean">EAN</label>
                <input type="text" name="ean" id="ean" required="required" />
            </p>

            <p>
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" id="descripcion" class="full-width" required="required" />
            </p>

            <p>
                <label for="unidad">Unidad</label>
                <input type="text" name="unidad" id="unidad" class="full-width" required="required" />
            </p>

            <?php
            
            $iva = array(
                0 => 'NO',
                1 => 'SI'
                );

            ?>

            <p>
                <label for="iva">IVA</label>
                <?php echo form_dropdown('iva', $iva, 0, 'id="iva"');?>
            </p>

            <p>
                <label for="min">Minimo</label>
                <input type="number" name="min" id="min" required="required" />
            </p>

            <p>
                <label for="max">Maximo</label>
                <input type="number" name="max" id="max" required="required" />
            </p>

            <p>
                <label for="preorden">Punto de reorden</label>
                <input type="number" name="preorden" id="preorden" required="required" />
            </p>

            <p>
                <label for="lc">Lleva lote y Caducidad</label>
                <?php echo form_dropdown('lc', $iva, 0, 'id="lc"');?>
            </p>

            <p>
                <button class="big" type="submit">Guardar Cambios</button>
            </p>

            </fieldset>

            <?php echo form_close();?>
            
        </div>
        
    </div>
</section>
