<section class="grid_12">
    <div class="block-border">


        <div class="block-content">
            <h1>
                        <?php echo $titulo;?>
                        
            </h1>
            
            <?php
            echo form_open('', array('class' => 'form', 'id' => 'kardex_form'));
            ?>
            
            <fieldset>
            <?php echo form_dropdown('clave', $claves, '', 'id="clave"');?>
            <button class="big" type="submit">Busca</button>
            </fieldset>
            
            <?php
            echo form_close();
            ?>

        </div>

        <div class="block-content">
            <h1>
                        Registros
                        
            </h1>
            
            <div id="tabla_kardex" align="center" style="width: 100%;"></div>

        </div>


    </div>
</section>