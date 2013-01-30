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
            <div class="button with-menu">
                Acciones
                 
                <!-- Here comes the menu -->
                <div class="menu">
                 
                    <!-- This is the arrow down image -->
                    <img src="<?php echo base_url();?>images/menu-open-arrow.png" width="16" height="16">
                     
                    <!-- Menu content -->
                    <ul>
                        <li class="icon_edit"><?php echo anchor('sucursales/catalogo', 'Modificar dias de pedido');?></li>
                        <li class="icon_export"><?php echo anchor('webservices/generar_automaticos', 'Generar pedidos');?></li>
                        <li class="icon_calendar"><?php echo anchor('pedidos/en_captura_automaticos_hoy', 'Ver pedidos de hoy');?></li>
                        <li class="icon_calendar"><?php echo anchor('pedidos/automaticos_historico', 'Ver historico');?></li>
                        <li class="sep"></li>
                        <li class="icon_database"><?php echo anchor('pedidos/cerrar_pedidos_automaticos_hoy', 'Cerrar pedidos');?></li>
                    </ul>
                    <!-- End  of menu content -->
                </div>
                <!-- Menu end -->
            </div>
                        
            </h1>
            
            <div align="center">
            
            <br />
            <br />
            
            <p class="message <?php echo $tipo; ?>"><?php echo $mensaje; ?></p>
            
            <table class="table" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Periodo inicial</th>
                        <th>Periodo final</th>
                        <th>Semanas buffer</th>
                        <th>Semanas calculo</th>
                        <th>Porcentaje adicional</th>
                        <th>Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row->perini; ?></td>
                        <td><?php echo $row->perfin; ?></td>
                        <td><?php echo $row->semanas_buffer; ?></td>
                        <td><?php echo $row->semanas_calculo; ?></td>
                        <td><?php echo $row->porcentaje; ?></td>
                        <td><?php echo anchor('settings/pedidos_automaticos', 'Modificar parametros');?></td>
                    </tr>
                </tbody>
            </table>
            
            </div>
            
            <div align="center">
            <br />
                <table class="table">
                <caption>Sucursales encontradas: <?php echo $query->num_rows();?></caption>
                <thead>
                    <tr>
                        <th>Sucursal</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($query->result() as $row2){
                    ?>
                    <tr>
                        <td><?php echo $row2->numsuc; ?></td>
                        <td><?php echo $row2->sucursal; ?></td>
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