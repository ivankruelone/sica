<?php
?>
<h2 align="center"><?php echo $xml->attributes()->sucursal." - ".$xml->attributes()->nombre;?></h2>
<table class="table">
    <thead>
        <tr>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Unidad</th>
            <th>Inventario</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        $inv = 0;
        
        foreach($xml->producto as $row){
        ?>
        <tr>
            <td><?php echo $row->clave; ?></td>
            <td><?php echo $row->descripcion; ?></td>
            <td><?php echo $row->pres; ?></td>
            <td align="right"><?php echo number_format((double)$row->inv, 0); ?></td>
        </tr>
        <?php
        
        $inv = $inv + (double)$row->inv;
        }
        
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td align="right" colspan="3">Total</td>
            <td align="right"><?php echo number_format($inv, 0); ?></td>
        </tr>
    </tfoot>
</table>