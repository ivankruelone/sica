<section class="grid_12">
    <div class="block-border">


        <div class="block-content">
            <h1>
                        <?php echo $titulo;?>
                        
            </h1>
            <p>
            <table class="table" cellspacing="0" width="100%" style="font-size: xx-small;">
					<thead>
						<tr>
							<th scope="col">Sucursal</th>
							<th scope="col">Mun.</th>
							<th scope="col">Jur.</th>
							<th scope="col">Servicio</th>
							<th scope="col">Fecsur</th>
							<th scope="col">Paciente</th>
							<th scope="col">Edad</th>
							<th scope="col">Sexo</th>
							<th scope="col">CIEP</th>
							<th scope="col">CIES</th>
							<th scope="col">Clave</th>
							<th scope="col">Cansur</th>
							<th scope="col">Precio</th>
							<th scope="col">Total</th>
							<th scope="col">Cve. Med.</th>
							<th scope="col">Med.</th>
							<th scope="col">Prog.</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    
                    foreach($query as $row){
                    ?>
						<tr>
							<td><?php echo $this->session->userdata('sucursal');?></td>
							<td><?php echo 'AGS.';?></td>
							<td><?php echo 'JUR 1';?></td>
							<td><?php echo $row->servicio_nombre;?></td>
							<td><?php echo $row->surtida;?></td>
							<td><?php echo $row->apaterno.' '.$row->amaterno.' '.$row->nombre_paciente;?></td>
							<td><?php echo $row->edad;?></td>
							<td><?php echo $row->sexo;?></td>
							<td><?php echo $row->cie_pri;?></td>
							<td><?php echo $row->cie_sec;?></td>
							<td><?php echo $row->clave_producto;?></td>
							<td><?php echo $row->cansur;?></td>
							<td><?php echo 0;?></td>
							<td><?php echo 0;?></td>
							<td><?php echo $row->rfc;?></td>
							<td><?php echo $row->nombre_medico;?></td>
							<td><?php echo $row->programa_text;?></td>
						</tr>
                    <?php
                    }
                    ?>
					</tbody>
            </table>
            
        </div>



    </div>
</section>