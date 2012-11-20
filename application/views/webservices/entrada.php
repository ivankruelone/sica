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

                            $image4 = array(
                                      'src' => base_url().'images/icons/fugue/pencil.png',
                                      'width' => '16',
                                      'height' => '16',
                            );

                            echo anchor('webservices/nuevo_servicio/'.$submenu, img($image).' nuevo servicio');
                        ?>
                        
            </h1>
            
            <table class="table" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>URL</th>
                        <th>Namespace</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Activado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($query->result() as $row){
                        
                    
                    if($row->uso == 1){
                        $uso = img($image1);
                    }else{
                        $uso = img($image2);
                    }
                    ?>
                    
                    
                    
                    <tr>
                        <td><?php echo $row->id; ?></td>
                        <td><?php echo $row->nombre; ?></td>
                        <td><?php echo $row->url; ?></td>
                        <td><?php echo $row->namespace; ?></td>
                        <td><?php echo $row->origen; ?></td>
                        <td><?php echo $row->estado; ?></td>
                        <td align="center"><?php echo $uso; ?></td>
                        <td align="center">
                            <?php echo anchor('webservices/asignar/'.$row->id.'/'.$submenu, img($image3), array('title' => 'Asignar')); ?>
                            <?php echo anchor('webservices/modificar_servicio/'.$row->id.'/'.$submenu, img($image4), array('title' => 'Modificar')); ?>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            
        </div>
    </div>
</section>