<div class="block-border">
    <?php echo form_open('pedidos/submit_cierra_surtido', array('class' => 'form', 'id' => 'cierra_surtido_form'));?>
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
            </p>
        </div>
        
        
    </div>
    
    <div class="block-content" id="hoja_detalle">
        <h1>Productos en este pedido</h1>

        <div align="center" id="tabla_captura">
        </div>
    
    </div>

            <?php echo form_hidden('id', $row->id);?>
            <?php echo form_hidden('estatus', $row->estatus);?>
            <?php echo form_close();?>
</div>