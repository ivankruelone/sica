<div class="block-border">
    <div class="block-content">
        <div align="center">
            <h1><?php echo $titulo;?></h1>
            
            <?php echo form_open('pedidos/do_upload_subida', array('enctype'=>'multipart/form-data'))?>
            <label for="file">Archivo:</label>
            <input type="file" name="file" id="file" /> 
            <input type="submit" name="submit" value="Enviar" />
            <?php echo form_hidden('menu', $menu);?>
            <?php echo form_hidden('submenu', $submenu);?>
            <?php echo form_close(); ?>
            
        </div>
    </div>
    <div class="block-content">
        <h1>Instrucciones</h1>
        <p align="justify">En esta secci&oacute;n puedes subir un pedido en archivo CSV (separado por comas). Para crealos sigue los siguientes pasos: </p>
        <p align="justify">1.- Teniendo un archivo de excel un pedido cualquiera darle formato como sigue, tres columnas: la primera la clave de sucursal, la segunda clave del producto y la tercera la cantidad requerida. Quedando como sigue:</p>
        <p align="center"><?php echo img(array('src' => base_url().'images/subida/pic01.png'));?></p>
        <p align="justify">2.- Una vez que tenemos estos datos procedemos a guardar el archivo, para esto utilizamos la opcion "Guardar Como..." en excel ponemos el nombre del arhivo y elegimos en "Guardar como tipo:" CSV (Delimitado por comas)(*.csv):</p>
        <p align="center"><?php echo img(array('src' => base_url().'images/subida/pic02.png'));?></p>
        <p align="justify">3.- Una vez guardado el archivo se procede a subir desde esta pantalla seleccionando el archivo que da como resultado y dando click en enviar.</p>
        <p align="center"><?php echo img(array('src' => base_url().'images/subida/pic03.png'));?></p>
        <p align="justify">4.- Si todo es correcto se generaran tantos pedidos como sean necesarios agrupandolo por hospital y tipo de producto.</p>
        <p align="center"><?php echo img(array('src' => base_url().'images/subida/pic04.png'));?></p>
        <p align="justify">Nota: Asi debe lucir un archivo CSV.</p>
        <p align="center"><?php echo img(array('src' => base_url().'images/subida/pic05.png'));?></p>
        
    </div>
</div>