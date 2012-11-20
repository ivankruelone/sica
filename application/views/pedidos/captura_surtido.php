<div class="block-border">
    <div class="block-content" id="hoja_captura">
        <div align="center">
            <h1><?php echo $titulo;?></h1>
            <p>
            <?php echo form_open('pedidos/submit_cierra_surtido', array('class' => 'form', 'id' => 'cierra_surtido_form'));?>
            <table class="table">
            <thead>
            <tr>
            <th>Id</th>
            <th>Estado</th>
            <th>Sucursal</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Requeridas</th>
            <th>Surtidas</th>
            <th>Quien Surtio?</th>
            <th>Cierre</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td><?php echo $row->id;?></td>
            <td id="estado_int"><?php echo $row->estado_int;?></td>
            <td><?php echo $row->numsuc.' - '.$row->sucursal;?></td>
            <td><?php echo $row->nombre;?></td>
            <td><?php echo $row->fecha;?></td>
            <td id="canreq_top"></td>
            <td id="cansur_top"></td>
            <td><input type="text" name="surtio" id="surtio" required="required" maxlength="255" dir="rtl"/></td>
            <td align="center">
            <?php if($row->estatus == 1){?>
            <button id="cerrar_pedido" class="red">Cierre</button>
            <?php }?>
            </td>
            </tr>
            </tbody>
            </table>
            <?php echo form_close();?>
            </p>
        </div>
        
        <div align="center">
        <?php if($row->estatus == 1){?>
            <?php echo form_open('pedidos/submit_captura_clave', array('class' => 'form', 'id' => 'captura_clave_form'));?>
            <fieldset>
            <legend>Captura Clave y Piezas y continua</legend>
                
                <input type="text" name="clave" id="clave" required="required" class="medium-width" placeholder="Clave" />
                
                
                <input type="number" name="cansur" id="cansur" required="required" placeholder="Surtidas" />
                <input type="text" name="lote" id="lote" required="required" placeholder="Lote" pattern="[A-Z0-9]+" />
                <input type="date" name="caducidad" id="caducidad" required="required" placeholder="Caducidad" />
                <button class="big" type="submit">Agregar</button>


            </fieldset>
            <?php }?>
            <?php echo form_hidden('id', $row->id);?>
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