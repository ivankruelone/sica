<div class="block-border">
    <div class="block-content">
        <div align="center">
            <h1><?php echo $titulo;?></h1>
            
            <?php echo form_open('inv/do_upload_subida', array('enctype'=>'multipart/form-data'))?>
            <label for="file">Archivo:</label>
            <input type="file" name="file" id="file" /> 
            <input type="submit" name="submit" value="Enviar" />
            <?php echo form_hidden('menu', $menu);?>
            <?php echo form_hidden('submenu', $submenu);?>
            <?php echo form_close(); ?>
            
        </div>
    </div>
    <div class="block-content">
        <h1>Datos Cargados</h1>
        <h2><?php echo anchor('inv/subida_eliminar', 'Eliminar los datos de subida.');?></h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Descripcion</th>
                    <th>Unidad</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                $cant = 0;
                foreach($query->result() as $row){
                    
                ?>
                <tr>
                    <td><?php echo $row->clave?></td>
                    <td><?php echo $row->descripcion?></td>
                    <td><?php echo $row->unidad?></td>
                    <td align="right"><?php echo number_format($row->cant, 0)?></td>
                </tr>
                <?php 
                
                $cant = $cant + $row->cant;
                }
                
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right"><?php echo number_format($cant, 0)?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>