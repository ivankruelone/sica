            <p>
            <table class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Lote</th>
							<th scope="col">Caducidad</th>
							<th scope="col">Piezas</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $piezas = 0;
                    foreach($query as $row){
                    ?>
						<tr>
							<td align="right"><?php echo $row->id;?></td>
							<td><?php echo $row->lote;?></td>
							<td><?php echo $row->caducidad;?></td>
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
            
            </p>
