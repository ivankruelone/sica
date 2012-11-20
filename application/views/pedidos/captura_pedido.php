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
            <th>Total</th>
            <th>Cierre</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td><?php echo $row->id;?></td>
            <td id="estado"><?php echo $row->estado_int;?></td>
            <td><?php echo $row->numsuc.' - '.$row->sucursal;?></td>
            <td><?php echo $row->nombre;?></td>
            <td><?php echo $row->fecha;?></td>
            <td align="right"><span id="total_top"></span></td>
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
            <?php echo form_open('pedidos/submit_captura_clave', array('class' => 'form', 'id' => 'captura_clave_form'));?>
            <fieldset>
            <legend>Captura Clave y Piezas y continua</legend>
                
                <input type="text" name="clave" id="clave" required="required" class="medium-width" placeholder="Clave" />
                
                
                <input type="number" name="piezas" id="piezas" required="required" placeholder="Piezas" />
                <button class="big" type="submit">Agregar al Pedido</button>


            </fieldset>
            <?php }?>
            <?php echo form_hidden('id', $row->id);?>
            <?php echo form_hidden('estatus', $row->estatus);?>
            <?php echo form_close();?>
            
                <div align="center">
                    <?php echo form_open('pedidos/do_upload', array('enctype'=>'multipart/form-data'))?>
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