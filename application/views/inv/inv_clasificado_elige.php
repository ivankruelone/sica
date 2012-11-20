<section class="grid_12">
    <div class="block-border">


        <div class="block-content">
            <h1>
                        <?php echo $titulo;?>
                        
            </h1>
            
            <?php
            echo form_open('inv/inv_clasificado', array('class' => 'form', 'id' => 'kardex_form'));
            ?>
            
            <fieldset>
            <?php echo form_dropdown('elige', $elige, '', 'id="elige"');?>
            <button class="big" type="submit">Ver Inventario</button>
            </fieldset>
            
            <?php
            echo form_close();
            ?>
        </div>



    </div>
</section>