<section class="grid_12">
    <div class="block-border">


        <div class="block-content">
            <h1>
                        <?php echo $titulo;?>
                        
            </h1>
            
            <?php
            echo form_open('inv/ajuste_area_claves', array('class' => 'form'));
            ?>
            
            <fieldset>
            <?php echo form_dropdown('elige', $elige, '', 'id="elige"');?>
            <button class="big" type="submit">Hacer Ajuste</button>
            </fieldset>
            
            <?php
            echo form_close();
            ?>
        </div>



    </div>
</section>