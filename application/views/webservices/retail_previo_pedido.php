<?php
	$xml = simplexml_load_string($xml);
?>
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
            
            
            <h2 align="center"><?php echo $xml->attributes()->sucursal." - ".$xml->attributes()->nombre;?></h2>
            <h2 align="center">Periodo: <?php echo $xml->attributes()->perini." al ".$xml->attributes()->perfin;?></h2>
            <p align="center"><?php echo anchor('webservices/guardar_pedido_retail', 'Guardar este pedido');?></p>
<table class="table">
    <thead>
        <tr>
            <th>Clave</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        $cantidad = 0;
        
        foreach($xml->linea as $row){
        ?>
        <tr>
            <td><?php echo $row->clave; ?></td>
            <td><?php echo $row->cantidad; ?></td>
        </tr>
        <?php
        
        $cantidad = $cantidad + $row->cantidad;
        }
        
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td align="right">Total</td>
            <td align="right"><?php echo number_format($cantidad, 0); ?></td>
        </tr>
    </tfoot>
</table>
        </div>
    </div>
</section>