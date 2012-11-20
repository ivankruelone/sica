<section class="grid_12">
    <div class="block-border">


        <div class="block-content">
            <h1>
                        <?php echo $titulo;?>
                        
            </h1>
            
            <?php
            echo form_open('inv/preajuste_area_claves', array('class' => 'form'));
            ?>
            
            <fieldset>
            <?php echo form_dropdown('elige', $elige, '', 'id="elige"');?>
            <button class="big" type="submit">Hacer Ajuste</button>
            </fieldset>
            
            <?php
            echo form_close();
            ?>
        </div>
        
        <div class="block-content">
            <h1>Total en preajuste</h1>
            <table class="table sortable" cellspacing="0" width="100%">
            <caption>Total de Registros en esta Consulta: <?php echo count($query);?></caption>
					<thead>
						<tr>
							<th scope="col">Clave</th>
							<th scope="col">Desc.</th>
							<th scope="col">Unidad</th>
							<th scope="col">Ajuste</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $piezas = 0;
                    foreach($query as $row){
                        
                    ?>
						<tr>
							<td><?php echo $row->clave;?></td>
							<td><?php echo $row->descripcion;?></td>
							<td><?php echo $row->unidad;?></td>
							<td align="right"><?php echo number_format($row->inv, 0);?></td>
						</tr>
                    <?php
                    
                        $piezas = $piezas + $row->inv;
                    }
                    ?>
					</tbody>
                    <tfoot>
                    <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right"><?php echo number_format($piezas, 0);?></td>
                    </tr>
                    </tfoot>
            </table>
        
        </div>
        



    </div>
</section>