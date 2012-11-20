<script type="text/javascript">
$(function() {
	$.getJSON('<?php echo site_url();?>/inv/get_json_kardex/<?php echo $producto->id; ?>', function(data) {

		// Create the chart
		window.chart = new Highcharts.StockChart({
			chart : {
				renderTo : 'container'
			},

			rangeSelector : {
				selected : 1
			},

			title : {
				text : 'Nivel de inventario'
			},

			yAxis : {
				title : {
					text : 'Piezas'
				},
				plotLines : [{
					value : <?php echo $producto->max; ?>,
					color : 'green',
					dashStyle : 'shortdash',
					width : 2,
					label : {
						text : 'Maximo',
                        align : 'right'
					}
				}, {
					value : <?php echo $producto->min; ?>,
					color : 'red',
					dashStyle : 'shortdash',
					width : 2,
					label : {
						text : 'Minimo',
                        align : 'right'
					}
				}, {
					value : <?php echo $producto->preorden; ?>,
					color : 'blue',
					dashStyle : 'shortdash',
					width : 2,
					label : {
						text : 'Punto de Reorden',
                        align : 'right'
					}
				}]
			},

			series : [{
				name : 'Inventario',
				data : data,
                id : 'dataseries',
				tooltip : {
					valueDecimals : 0
				}
			}, {
		        type: 'flags',
		        name: 'Ajuste de Inventario',
		        data: [<?php echo $kardex_ajustes; ?>],
		        onSeries: 'dataseries',
		        shape: 'squarepin'
		    }]
		});
        
        Highcharts.setOptions({
        	global: {
        		useUTC: false
        	}
        });
	});
});

		</script>
        <script src="<?php echo base_url();?>js/highstock/highstock.js"></script>
        <script src="<?php echo base_url();?>js/highstock/modules/exporting.js"></script>
            <div id="container" style="height: 500px; min-width: 500px"></div>
            <p>
            
            <h2 align="center">Kardex: <?php echo count($query); ?></h2>
            
            <table class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Clave</th>
							<th scope="col">Desc.</th>
							<th scope="col">Lote</th>
							<th scope="col">Caducidad</th>
							<th scope="col">Fecha</th>
							<th scope="col">Movimiento</th>
							<th scope="col">Referencia</th>
							<th scope="col">Mensaje</th>
							<th scope="col">Cantidad</th>
							<th scope="col">Inv.</th>
							<th scope="col">Sucursal</th>
							<th scope="col">Razon</th>
							<th scope="col">User</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    foreach($query as $row){
                            
                    ?>
						<tr>
							<td align="right"><?php echo $row->id;?></td>
							<td><?php echo $row->clave;?></td>
							<td><?php echo $row->descripcion;?></td>
							<td><?php echo $row->lote;?></td>
							<td><?php echo $row->caducidad;?></td>
							<td><?php echo $row->modiicada;?></td>
							<td><?php echo $row->movimiento;?></td>
							<td><?php echo $row->id_ref;?></td>
							<td><?php echo $row->mensaje;?></td>
                            <?php if(($row->nueva - $row->vieja) < 0){ ?>
							<td align="right" style="color: red;"><?php echo $row->nueva - $row->vieja;?></td>
                            <?php }else{?>
                            <td align="right"><?php echo $row->nueva - $row->vieja;?></td>
                            <?php }?>
							<td align="right"><?php echo $row->nueva;?></td>
							<td><?php echo $row->sucursal;?></td>
							<td><?php echo $row->razon;?></td>
							<td><?php echo $row->usuario;?></td>
						</tr>
                    <?php
                    
                    }
                    ?>
					</tbody>
            </table>
            
            </p>
