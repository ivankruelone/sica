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
                <input type="text" name="clave" id="clave" value="<?php echo $row->clave?>" required="required" />
            </p>

            <p>
                <label for="tipo_producto">Tipo de producto</label>
                <?php echo form_dropdown('tipo_producto', $tipo, $row->tipo_producto, 'id="tipo_producto"');?>
            </p>
            
            <p>
                <label for="subtipo_producto">Subtipo de producto</label>
                <?php echo form_dropdown('subtipo_producto', $subtipo, $row->subtipo_producto, 'id="subtipo_producto"');?>
            </p>

            <p>
                <label for="ean">EAN</label>
                <input type="text" name="ean" id="ean" value="<?php echo $row->ean?>" required="required" />
            </p>

            <p>
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" id="descripcion" class="full-width" value="<?php echo $row->descripcion?>" required="required" />
            </p>

            <p>
                <label for="unidad">Unidad</label>
                <input type="text" name="unidad" id="unidad" class="full-width" value="<?php echo $row->unidad?>" required="required" />
            </p>

            <?php
            
            $iva = array(
                0 => 'NO',
                1 => 'SI'
                );

            ?>

            <p>
                <label for="iva">IVA</label>
                <?php echo form_dropdown('iva', $iva, $row->iva, 'id="iva"');?>
            </p>

            <p>
                <label for="min">Minimo</label>
                <input type="number" name="min" id="min" value="<?php echo $row->min?>" required="required" />
            </p>

            <p>
                <label for="max">Maximo</label>
                <input type="number" name="max" id="max" value="<?php echo $row->max?>" required="required" />
            </p>

            <p>
                <label for="preorden">Punto de reorden</label>
                <input type="number" name="preorden" id="preorden" value="<?php echo $row->preorden?>" required="required" />
            </p>

            <p>
                <label for="lc">Lleva lote y Caducidad</label>
                <?php echo form_dropdown('lc', $iva, $row->lc, 'id="lc"');?>
            </p>

            <p>
                <label for="activo">El Producto esta Activo</label>
                <?php echo form_dropdown('activo', $iva, $row->activo, 'id="activo"');?>
            </p>

            <p>
            
                <button class="big" type="submit">Guardar Cambios</button>
            
            </p>

            </fieldset>
            
            <?php echo form_hidden('id', $row->id);?>

            <?php echo form_close();?>
            
        </div>
        
    </div>
</section>
