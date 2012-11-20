<div class="block-border">
    <div class="block-content" id="hoja_captura">
        <div align="center">
            <h1><?php echo $titulo;?></h1>
            <p>
            <table class="table">
            <thead>
            <tr>
            <th>Id</th>
            <th>Referencia</th>
            <th>Sucursal</th>
            <th>Proveedor</th>
            <th>Movimiento</th>
            <th>Aceptadas</th>
            <th>Rechazadas</th>
            <th>Total</th>
            <th>Cierre</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td><?php echo $row->id;?></td>
            <td><?php echo $row->referencia;?></td>
            <td><?php echo $row->numsuc." - ".$row->sucursal;?></td>
            <td><?php echo $row->proveedor;?></td>
            <td><?php echo $row->movimiento;?></td>
            <td align="right" id="total_top"></td>
            <td align="right" id="rechazadas_top"></td>
            <td align="right" id="total_total"></td>
            <td align="center">
            <?php if($row->estatus == 0){?>
            <button id="cerrar_pedido" class="red">Cierre</button>
            <?php }?>
            </td>
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
                <input type="text" name="caducidad" id="caducidad" required="required" placeholder="Caducidad" pattern="(ene|feb|mar|abr|may|jun|jul|ago|sep|oct|nov|dic|ENE|FEB|MAR|ABR|MAY|JUN|JUL|AGO|SEP|OCT|NOV|DIC|01|02|03|04|05|06|07|08|09|10|11|12)/(<?php echo $anios_validos;?>)|SC|sc" />
                <button class="big" type="submit">Agregar</button>


            </fieldset>
            <?php }?>
            <?php echo form_hidden('id', $row->id);?>
            <?php echo form_hidden('estatus', $row->estatus);?>
            <?php echo form_hidden('lc', 1);?>
            <?php echo form_close();?>
            
            
            <div align="center">
                    <?php echo form_open('inv/do_upload_formato', array('enctype'=>'multipart/form-data'))?>
                    <label for="file">Archivo:</label>
                    <input type="file" name="file" id="file" /> 
                    <input type="submit" name="submit" value="Enviar" />
                    <?php echo form_hidden('id', $row->id);?>
                    <?php echo form_hidden('menu', $menu);?>
                    <?php echo form_hidden('submenu', $submenu);?>
                    </form>
            </div>
            
        </div>
        
    </div>
    
    <div class="block-content" id="hoja_detalle">
        <h1>Productos en este pedido</h1>

        <div align="center" id="tabla_captura">
        </div>
    
    </div>
</div>