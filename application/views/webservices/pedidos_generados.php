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
            
            <div align="center">
                <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Sucursal</th>
                        <th>Fecha</th>
                        <th>Status</th>
                        <th>Cerrado</th>
                        <th>Usuario</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($query->result() as $row){
                    ?>
                    <tr>
                        <td><?php echo $row->id; ?></td>
                        <td><?php echo $row->sucursal." - ".$row->nombre_suc; ?></td>
                        <td><?php echo $row->fecha; ?></td>
                        <td align="center"><?php echo $row->estatus; ?></td>
                        <td align="center"><?php echo $row->cerrado; ?></td>
                        <td><?php echo $row->empleado; ?></td>
                        <td align="center"><?php echo anchor('webservices/pedido_generado_detalle/'.$row->id.'/'.$submenu, img($image3)); ?></td>
                    </tr>
                    <?php
                    }
                    
                    ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</section>