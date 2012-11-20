<section class="grid_12">
    <div class="block-border">


        <div class="block-content" id="formato">
            <h1>
                <?php echo $titulo;?>
            </h1>
            <?php echo form_open('', array('class' => 'form', 'id' => 'busqueda_form'));?>
            <fieldset>
            
            <p>
                <label for="sucursal2">Sucursal</label>
                 <input type="text" name="sucursal2" id="sucursal2" required="required" class="full-width" />
            </p>

            <p>
                <label for="pedido"># Pedido</label>
                <?php
                
                $data = array(
                              'name'        => 'pedido',
                              'id'          => 'pedido',
                            );
                
                echo form_input($data);
                
                ?>
                <button type="button" id="busca_pedido">Busca</button>
            </p>


            </fieldset>

            <?php
            echo form_hidden('submenu', $submenu); 
            echo form_close();
            ?>
            
        </div>
        
    </div>
    
    <div class="block-border">
        <div class="block-content">
            <h1>Resultado de la Busqueda</h1>
            <div id="resultado_busqueda">
            </div>
        </div>
    </div>
</section>
