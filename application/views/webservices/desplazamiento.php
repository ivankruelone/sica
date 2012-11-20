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

                            //echo anchor('webservices/nuevo_servicio/'.$submenu, img($image).' nuevo servicio');
                        ?>
                        
            </h1>
            
            <table class="table" align="center">
            <caption>Que tenemos.</caption>
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Periodo Inicial</th>
                        <th>Periodo Final</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($query2->result() as $row2){?>
                    <tr>
                        <td><?php echo $row2->estado;?></td>
                        <td><?php echo $row2->perini;?></td>
                        <td><?php echo $row2->perfin;?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            
            
            <table class="table" width="100%">
            <caption>Total de registros: <?php echo $query->num_rows();?></caption>
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Descripcion</th>
                        <th>Unidad</th>
                        <th>Requeridas</th>
                        <th>Surtidas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $canreq = 0;
                    $cansur = 0;
                    
                    foreach($query->result() as $row){
                        
                    
                    ?>
                    <tr>
                        <td><?php echo $row->clave; ?></td>
                        <td><?php echo $row->descripcion; ?></td>
                        <td><?php echo $row->unidad; ?></td>
                        <td align="right"><?php echo number_format($row->canreq, 0); ?></td>
                        <td align="right"><?php echo number_format($row->cansur, 0); ?></td>
                    </tr>
                    <?php 
                    
                        $canreq = $canreq + $row->canreq;
                        $cansur = $cansur + $row->cansur;
                    }
                    
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" align="right">Totales</td>
                        <td align="right"><?php echo number_format($canreq, 0); ?></td>
                        <td align="right"><?php echo number_format($cansur, 0); ?></td>
                    </tr>
                </tfoot>
            </table>
            
        </div>
    </div>
</section>