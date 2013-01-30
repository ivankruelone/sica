<div class="block-border">
    <div class="block-content" id="hoja_captura">
        <div align="center">
            <h1><?php echo $titulo;?></h1>
            <p>
            <table class="table">
            <thead>
            <tr>
            <th>Id</th>
            <th>Estado</th>
            <th>Sucursal</th>
            <th>Usuario</th>
            <th>Fecha</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td><?php echo $row->id;?></td>
            <td id="estado"><?php echo $row->estado_int;?></td>
            <td><?php echo $row->numsuc.' - '.$row->sucursal;?></td>
            <td><?php echo $row->nombre;?></td>
            <td><?php echo $row->fecha;?></td>
            </tr>
            </tbody>
            </table>
            </p>
        </div>
        
        <div align="center">
        
        <p class="message">Este es un pedido sugerido en base al inventario actual y al desplazamiento de mercancia del <?php echo $settings->perini; ?> al <?php echo $settings->perfin; ?> en tu sucursal.</p>
        <p class="message">Adicionalmente puedes agregar hasta un <?php echo $settings->porcentaje; ?>% adicional del pedido calculado.</p>
        <p class="message">Solo contaras con un periodo de tiempo el mismo dia que se genera el pedido para que lo revises.</p>
        
            <?php echo form_hidden('id', $row->id);?>
            <?php echo form_hidden('estatus', $row->estatus);?>
            
        </div>
        
    </div>
    
    <div class="block-content" id="hoja_detalle">
        <h1>Productos en este pedido</h1>

        <div align="center" id="tabla_captura">
        </div>
    
    </div>
</div>