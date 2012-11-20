<section>
    <div class="block-border">
        <div class="block-content">
            <h1><?php echo $titulo;?></h1>
            
            <?php
            echo form_open('stats/negados_resultado', array('class' => 'form', 'id' => 'negados_form'));
            $data1 = array(
              'name'        => 'perini',
              'id'          => 'perini',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'type'        => 'text',
              'class'       => 'datepicker'
            );
            $data2 = array(
              'name'        => 'perfin',
              'id'          => 'perfin',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'type'        => 'text',
              'class'       => 'datepicker'
            );
            
            echo " Inicio: ";
            echo form_input($data1);
            echo " Fin: ";
            echo form_input($data2);
            echo " ";
            echo '<button class="big" type="submit">Consultar</button>';
            echo form_close();
            ?>
            
        </div>
        
        <div class="block-content">
            <h1>Resultado</h1>
            <div id="resultado" align="center">
            
            </div>
        </div>
    </div>
</section>