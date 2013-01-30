<section class="grid_6">
    <div class="block-border">

        
        <div class="block-content" id="formato">
        <?php echo form_open('sucursales/submit_nuevo_tipo', array('class' => 'form', 'id' => 'nuevo_form'));?>
        
            <h1>
                <?php echo $titulo;?>
            </h1>
            
            
            
            
            <fieldset>
            <legend>Agrega los valores y da click en Guardar</legend>
            
            <p>
                <label for="tipo">Tipo</label>
                 <input type="text" name="tipo" id="tipo" class="full-width" required="required" />
            </p>
            
            </fieldset>
            
            <p>
                <button class="big" type="submit">Guardar</button>
            </p>
            
        <?php echo form_close();?>
        </div>
         
        
        
    </div>
</section>
