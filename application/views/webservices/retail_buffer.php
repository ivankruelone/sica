<section class="grid_12">
    <div class="block-border">


        <div class="block-content">
            <h1>
                        <?php echo $titulo;?>
                        <?php
                            $image = array(
                                      'src' => base_url().'images/icons/fugue/plus-circle-blue.png',
                                      'width' => '16',
                                      'height' => '16',
                            );
                            
                            $image1 = array(
                                      'src' => base_url().'images/icons/fugue/tick-circle.png',
                                      'width' => '16',
                                      'height' => '16',
                            );
                            $image2 = array(
                                      'src' => base_url().'images/icons/fugue/cross-circle.png',
                                      'width' => '16',
                                      'height' => '16',
                            );
                            $image3 = array(
                                      'src' => base_url().'images/icons/fugue/navigation.png',
                                      'width' => '16',
                                      'height' => '16',
                            );

                            //echo anchor('webservices/nuevo_servicio/'.$submenu, img($image).' nuevo servicio');
                        ?>
                        
            </h1>
            
            
            <?php 
            echo form_open('webservices/get_buffer_retail', array('class' => 'form', 'id' => 'retail_form'));
            echo "Sucursal: ";
            echo form_dropdown('sucursal', $sucursales, '', 'id="sucursal"');
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
            <h1>Desplazamiento</h1>
            <div id="resultado" align="center"></div>
        </div>
    </div>
</section>