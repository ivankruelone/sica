<section class="grid_6">
    <div class="block-border">

        
        <div class="block-content" id="formato">
        <?php echo form_open('sucursales/submit_nueva_sucursal', array('class' => 'form', 'id' => 'nuevo_cliente_form'));?>
        
            <h1>
                <?php echo $titulo;?>
            </h1>
            
            
            
            
            <fieldset>
            <legend>Modifica los valores y da click en Guardar</legend>
            
            <p>
                <label for="cia">Compa&ntilde;ia</label>
                <?php echo form_dropdown('cia', $cias, '', 'id="cia"');?>
            </p>

            <p>
                <label for="numsuc">Numero de Sucursal</label>
                 <input type="number" name="numsuc" id="numsuc" required="required" />
            </p>
            
            <p>
                <label for="sucursal">Sucursal</label>
                <input type="text" name="sucursal" id="sucursal" maxlength="100" class="full-width" required="required" />
            </p>

            <p>
                <label for="calle">Calle</label>
                <input type="text" name="calle" id="calle" class="full-width" required="required" />
            </p>

            <p>
                <label for="referencia">Referencia</label>
                <input type="text" name="referencia" id="referencia" class="full-width" />
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
                <label for="estado_int">Estado</label>
                <?php echo form_dropdown('estado_int', $estados, '', 'id="estado_int"');?>
            </p>

            <p>
                <label for="juris">Jurisdicci&oacute;n</label>
                <select id="juris" name="juris"></select>
            </p>

            <p>
                <label for="diaped">Dia de Pedido</label>
                <?php echo form_dropdown('diaped', $dias, '', 'id="diaped"');?>
            </p>

            <p>
                <label for="cad_min">Caducidad Minima Aceptada (En dias)</label>
                <input type="number" name="cad_min" id="cad_min" pattern="\d+" required="required" />
            </p>
            
            </fieldset>
            
            <p>
                <button class="big" type="submit">Guardar Cambios</button>
            </p>
            
        <?php echo form_close();?>
        </div>
         
        
        
    </div>
</section>
