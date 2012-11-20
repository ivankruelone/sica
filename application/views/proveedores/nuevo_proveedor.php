<section class="grid_6">
    <div class="block-border">

        
        <div class="block-content" id="formato">
        <?php echo form_open('proveedores/submit_nuevo_proveedor', array('class' => 'form', 'id' => 'nuevo_proveedor_form'));?>
        
            <h1>
                <?php echo $titulo;?>
            </h1>
            
            
            <fieldset>
            <legend>Modifica los valores y da click en Guardar</legend>
            
            <p>
                <label for="rfc">RFC</label>
                <input type="text" name="rfc" id="rfc" maxlength="13" required="required" />
                <span id="span_rfc"></span>
            </p>

            <p>
                <label for="npro"># de Proveedor</label>
                <input type="number" name="npro" id="npro" maxlength="13" required="required" value="0"/>
            </p>

            <p>
                <label for="razon">Razon</label>
                <input type="text" name="razon" id="razon" class="full-width" required="required" />
            </p>

            <p>
                <label for="calle">Calle</label>
                <input type="text" name="calle" id="calle" class="full-width" required="required" />
            </p>

            <p>
                <label for="exterior">No. Exterior</label>
                <input type="text" name="exterior" id="exterior" required="required" />
            </p>

            <p>
                <label for="interior">No. Interior</label>
                <input type="text" name="interior" id="interior" />
            </p>

            <p>
                <label for="cp">Codigo Postal</label>
                <input type="text" name="cp" id="cp" pattern="[0-9]{5}" maxlength="5" required="required"/>
            </p>

            <p>
                <label for="colonia">Colonia</label>
                <input type="text" name="colonia" id="colonia" class="full-width" required="required" />
            </p>

            <p>
                <label for="municipio">Municipio o Delegacion</label>
                <input type="text" name="municipio" id="municipio" class="full-width" required="required" />
            </p>
            
            <p>
                <label for="estado">Estado</label>
                <input type="text" name="estado" id="estado" class="full-width" required="required" />
            </p>

            <p>
                <label for="referencia">Referencia</label>
                <input type="text" name="referencia" id="referencia" class="full-width" />
            </p>

            <p>
                <label for="pais">Pais</label>
                <input type="text" name="pais" id="pais" class="full-width" value="MEXICO" required="required" />
            </p>

            <p>
                <label for="contacto">Contacto</label>
                <input type="text" name="contacto" id="contacto" class="full-width" />
            </p>

            <p>
                <label for="telefono">Telefono</label>
                <input type="text" name="tel" id="tel" pattern="[0-9]{10}" maxlength="10" class="full-width" />
            </p>

            <p>
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="full-width" />
            </p>
            
            
            <p>
                <label for="condiciones">Condiciones de Pago</label>
                <?php echo form_dropdown('condiciones', $condiciones, '', 'id="condiciones"');?>
            </p>
            
            <p>
                <label for="limite">Limite de Credito</label>
                <input type="text" name="limite" id="limite" pattern="\d+(\.\d{2})?" required="required" />
            </p>

            </fieldset>
            
            <p>
                <button class="big" type="submit">Guardar Cambios</button>
            </p>
            
        <?php echo form_close();?>
        </div>
         
        
        
    </div>
</section>
