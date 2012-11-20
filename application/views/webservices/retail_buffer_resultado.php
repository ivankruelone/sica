<?php
?>
<h2 align="center"><?php echo $xml->attributes()->sucursal." - ".$xml->attributes()->nombre;?></h2>
<h2 align="center">Periodo: <?php echo $xml->attributes()->perini." al ".$xml->attributes()->perfin;?></h2>
<table class="table">
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
        
        foreach($xml->producto as $row){
        ?>
        <tr>
            <td><?php echo $row->clave; ?></td>
            <td><?php echo $row->descripcion; ?></td>
            <td><?php echo $row->pres; ?></td>
            <td align="right"><?php echo number_format((double)$row->canreq, 0); ?></td>
            <td align="right"><?php echo number_format((double)$row->cansur, 0); ?></td>
        </tr>
        <?php
        
        $canreq = $canreq + (double)$row->canreq;
        $cansur = $cansur + (double)$row->cansur;
        }
        
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td align="right" colspan="3">Total</td>
            <td align="right"><?php echo number_format($canreq, 0); ?></td>
            <td align="right"><?php echo number_format($cansur, 0); ?></td>
        </tr>
    </tfoot>
</table>