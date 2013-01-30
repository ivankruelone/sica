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

            if($query->num_rows() > 0){
                
            $row = $query->row();
            echo "<h3>$row->nombre</h3><br />";
            if($row->tipo == 1){
                
            ?>
            
            <ul class="simple-list with-icon icon-info">
                <li><?php echo anchor('webservices/catalogo/'.$submenu, 'Catalogo de Productos'); ?></li>
                <li><?php echo anchor('webservices/retail_inv/'.$submenu, 'Inventario'); ?></li>
                <li><?php echo anchor('webservices/retail_buffer/'.$submenu, 'Desplazamiento x Sucursal'); ?></li>
                <li><?php echo anchor('webservices/retail_pedido/'.$submenu, 'Inventario Vs. Desplazamiento'); ?></li>
                <li><?php echo anchor('webservices/retail_pedidos_generados/'.$submenu, 'Ver Pedidos Generados'); ?></li>
                <li><?php echo anchor('webservices/retail_buffer_completo/'.$submenu, 'Desplazamiento Estado'); ?></li>
                <li><?php echo anchor('webservices/desplazamiento/'.$submenu, 'Ver Desplazamiento'); ?></li>
                <li><?php echo anchor('webservices/catalogo/'.$submenu, 'Catalogo de Productos'); ?></li>
            </ul>
            
            <?php    
                
            }elseif($row->tipo == 2){
            
            ?>

            <ul class="simple-list with-icon icon-info">
                <li><a href="#">Element</a></li>
                <li><a href="#">Element</a></li>
                <li><a href="#">Element</a></li>
            </ul>
            
            <?php
            
            }
            
            }else{
                echo "No Hay ninguna seleccion, o Webservice disponible.";
            }
            
            
            ?>
            
            
        </div>
    </div>
</section>