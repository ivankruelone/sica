<table class="table">
<caption>Registros encontrados: <?php echo $query->num_rows();?></caption>
    <thead>
        <tr>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Unidad</th>
            <th>Negados</th>
            <th>Inventario</th>
            <th>Surtidos</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        foreach($query->result() as $row){
        
        ?>
        <tr>
            <td><?php echo $row->clave; ?></td>
            <td><?php echo $row->descripcion; ?></td>
            <td><?php echo $row->unidad; ?></td>
            <td align="right"><?php echo $row->negados; ?></td>
            <td align="right"><?php echo $row->inv; ?></td>
            <td align="right"><?php echo $row->cansur; ?></td>
        </tr>
        <?php
        
        }
        
        ?>
    </tbody>
</table>