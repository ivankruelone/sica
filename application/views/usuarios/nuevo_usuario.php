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
                <label for="usuario">Usuario</label>
                 <input type="text" name="usuario" id="usuario" required="required" />
            </p>
            
            <p>
                <label for="password">Password</label>
                 <input type="password" name="password" id="password" required="required" />
            </p>

            <p>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" maxlength="100" class="full-width" required="required" />
            </p>

            <p>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="medium-width" required="required" />
            </p>

            <p>
                <label for="nivel">Nivel</label>
                <?php echo form_dropdown('nivel', $niveles, '', 'id="nivel"');?>
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
