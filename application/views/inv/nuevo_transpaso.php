<div class="block-border">
    <div class="block-content" id="hoja_captura">
        <div align="center">
            <h1><?php echo $titulo;?></h1>
        </div>
        
        <?php echo form_open('inv/submit_nueva_entrada_planta', array('class' => 'form', 'id' => 'nueva_entrada_planta_form'));?>
        
        <p>
        
        <label for="referencia">Referencia</label>
        <input type="text" name="referencia" id="referencia" required="required" class="quarter-width" autocomplete="off" />
        
        </p>
        
        <p>
        
        <label for="proveedor_id">Proveedor</label>
        <?php echo form_dropdown('proveedor_id', $proveedor, '', 'id="proveedor_id"');?>
        
        </p>

        <p>
        
        <label for="notas">Notas</label>
        <textarea wrap="OFF" name="notas" id="notas" class="quarter-width" autocomplete="off" ></textarea>
        
        </p>
        
        <p>
        
        <button class="big" type="submit">Agregar</button>
        
        </p>
        
        <?php
        
        echo form_hidden('tipo', '2');
        echo form_hidden('subtipo', $subtipo);
        echo form_hidden('empresa', 1);
        echo form_hidden('cliente_id', '0');
        echo form_hidden('submenu', $submenu);
        echo form_hidden('fec_doc', date('Y-m-d'));
        
        ?>

        <?php echo form_close();?>
        
</div>