<section class="grid_12">
    <div class="block-border">


        <div class="block-content" align="center">
            <h1>
                        <?php echo $titulo;?>
                        <?php
                            $image1 = array(
                                  'src' => base_url().'images/icons/fugue/cards-address.png',
                                  'width' => '16',
                                  'height' => '16',
                        );
                            
                        ?>
                        
            </h1>
            <p>
            
            <h2 align="center">Fechas con Ajuste: <?php echo count($query); ?></h2>
            
            <table class="table sortable" cellspacing="0" width="50%">
					<thead>
						<tr>
							<th scope="col">Referencia</th>
							<th scope="col">Fecha</th>
							<th scope="col">Accion</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    foreach($query as $row){
                        
                    ?>
						<tr>
							<td><?php echo $row->id_ref;?></td>
							<td><?php echo $row->modiicada;?></td>
							<td align="center" class="table-actions"><?php echo anchor('inv/ajuste_hist_detalle/'.$row->id_ref, img($image1), array('title' => 'Ver Detalle Ajuste', 'class' => 'with-tip'));?></td>
						</tr>
                    <?php
                    
                    }
                    ?>
					</tbody>
            </table>
            
            </p>
        </div>



    </div>
</section>