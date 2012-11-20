<section class="grid_6">
    <div class="block-border">


        <div class="block-content" id="formato">
            <h1>
                <?php echo $titulo;?>
            </h1>
            <?php echo form_open('pedidos/submit_nuevo_pedido', array('class' => 'form', 'id' => 'nuevo_pedido_form'));?>
            <fieldset>
            <legend>Busca la sucursal y da click en agregar pedido</legend>
            
            <p>
                <label for="sucursal">Sucursal</label>
                 <input type="text" name="sucursal" id="sucursal" required="required" class="full-width" />
            </p>
            
            <p>
                <label for="flag">Urgente</label>
                <?php
                
                $a = array('0'=>'NO', '1'=>'SI');
                echo form_dropdown('flag', $a, '', 'id="flag"');
                
                ?>
            </p>

            <p>
            
                <button class="big" type="submit">Agregar Pedido</button>
            
            </p>

            </fieldset>

            <?php
            echo form_hidden('submenu', $submenu); 
            echo form_close();
            ?>
            
        </div>
        
    </div>
</section>
