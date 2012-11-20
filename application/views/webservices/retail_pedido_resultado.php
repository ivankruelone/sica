<?php
?>
<h2 align="center"><?php echo $xml->attributes()->sucursal." - ".$xml->attributes()->nombre;?></h2>
<h2 align="center">Periodo: <?php echo $xml->attributes()->perini." al ".$xml->attributes()->perfin;?></h2>
<p align="center"><?php echo anchor('webservices/previo_pedido_retail', 'Generar un previo de pedido con los datos actuales.');?></p>
<table class="table">
    <thead>
        <tr>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Unidad</th>
            <th>Inventario</th>
            <th>Buffer</th>
            <th>Flag</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        $inv = 0;
        $buffer = 0;
        
        $a = '<?xml version="1.0" encoding="UTF-8"?>';
        $a.="<pedido sucursal=\"".$xml->attributes()->sucursal."\" nombre=\"".$xml->attributes()->nombre."\" perini=\"".$xml->attributes()->perini."\" perfin=\"".$xml->attributes()->perfin."\">";
        
        foreach($xml->producto as $row){
            
            $color = null;
            
            
            if( (int)$row->inv > (int)$row->buffer){
                $color = 'style="background-color: #9ACD32;"';
            }elseif((int)$row->inv < (int)$row->buffer){
                $color = 'style="background-color: #CD5C5C;"';
                
                $a.="<linea><clave>".$row->clave."</clave><cantidad>".((double)$row->buffer - (double)$row->inv)."</cantidad></linea>";

            }
        
            
            
        ?>
        <tr>
            <td><?php echo $row->clave; ?></td>
            <td><?php echo $row->descripcion; ?></td>
            <td><?php echo $row->pres; ?></td>
            <td align="right"><?php echo number_format((double)$row->inv, 0); ?></td>
            <td align="right"><?php echo number_format((double)$row->buffer, 0); ?></td>
            <td <?php echo $color; ?>>&nbsp;</td>
        </tr>
        <?php
        
        $inv = $inv + (double)$row->inv;
        $buffer = $buffer + (double)$row->buffer;
        
        }
        
        $a.="</pedido>";
        
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td align="right" colspan="3">Total</td>
            <td align="right"><?php echo number_format($inv, 0); ?></td>
            <td align="right"><?php echo number_format($buffer, 0); ?></td>
            <td>&nbsp;</td>
        </tr>
    </tfoot>
</table>

<?php

    $this->session->set_flashdata('pedido', $a);
?>