<?php
	$image3 = array(
                                  'src' => base_url().'images/icons/fugue/hp_printer.png',
                                  'width' => '16',
                                  'height' => '16',
                        );
?>
<div class="block-border">
    <div class="block-content" id="hoja_captura">
        <div align="center">
            <h1><?php echo $titulo;?></h1>
            <p>
            <table class="table">
            <thead>
            <tr>
            <th>Estatus</th>
            <th>Modificado</th>
            <th>Total</th>
            <th>Cierre</th>
            <?php if($row->estatus == 1){?>
            <th>Impresion</th>
            <?php }?>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td><?php echo $row->estatus;?></td>
            <td><?php echo $row->mod;?></td>
            <td align="right" id="total_top"></td>
            <td align="center">
            <?php if($row->estatus == 0){?>
            <button id="cerrar_pedido" class="red">Cierre</button>
            <?php }?>
            </td>
            <?php if($row->estatus == 1){?>
            <td align="center"><?php echo anchor('inv/reporte_inv_ini/', img($image3), array('title' => 'Impresion', 'class' => 'with-tip', 'target' => '_blank'));?></td>
            <?php }?>
            </tr>
            </tbody>
            </table>
            </p>
        </div>
        
        <div align="center">
        <?php if($row->estatus == 0){?>
            <?php echo form_open('inv/submit_captura_clave', array('class' => 'form', 'id' => 'captura_clave_form'));?>
            <fieldset>
            <legend>Captura Clave y Piezas y continua</legend>
                
                <input type="text" name="clave" id="clave" required="required" class="quarter-width" placeholder="Clave" />
                <input type="number" name="piezas" id="piezas" required="required" placeholder="Piezas" />
                <input type="text" name="lote" id="lote" required="required" placeholder="Lote" />
                <input type="text" name="caducidad" id="caducidad" required="required" placeholder="Caducidad" pattern="(ene|feb|mar|abr|may|jun|jul|ago|sep|oct|nov|dic|ENE|FEB|MAR|ABR|MAY|JUN|JUL|AGO|SEP|OCT|NOV|DIC)/(<?php echo $anios_validos;?>)" />
                <button class="big" type="submit">Agregar</button>


            </fieldset>
            <?php }?>
            <?php echo form_hidden('estatus', $row->estatus);?>
            <?php echo form_hidden('lc');?>
            <?php echo form_close();?>
        </div>
        
    </div>
    
    <div class="block-content" id="hoja_detalle">
        <h1>Productos en este pedido</h1>

        <div align="center" id="tabla_captura">
        </div>
    
    </div>
</div>