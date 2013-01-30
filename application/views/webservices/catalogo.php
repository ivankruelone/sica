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
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Descripcion</th>
                        <th>Presentacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $inv = 0;
                    
                    foreach($xml->producto as $row){
                    ?>
                    <tr>
                        <td><?php echo $row->clave; ?></td>
                        <td><?php echo $row->descripcion; ?></td>
                        <td><?php echo $row->pres; ?></td>
                    </tr>
                    <?php
                    
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
        
    </div>
</section>