<div class="block-border">
    <div class="block-content">
    <h1>
            <?php echo $titulo; ?>
    </h1>
    <div id="mensaje" align="center" style="color: red;"></div>
    <?php echo form_open('settings/submit_pedidos_automaticos', array('class' => 'form', 'id' => 'cc_form'));?>
    
        <fieldset>
        <legend>Determine el Buffer que utilizara.</legend>
        <p>
            <label for="perini">Periodo Inicial</label>
            <input type="text" name="perini" id="perini" required="required" class="datepicker" value="<?php echo $row->perini; ?>" />
        </p>

        <p>
            <label for="perfin">Periodo Final</label>
            <input type="text" name="perfin" id="perfin" required="required" class="datepicker" value="<?php echo $row->perfin; ?>" />
        </p>
        
        </fieldset>
        
        <fieldset>
        <legend>A cuantas semanas deseas proyectar tu pedido.</legend>

        <p>
            <label for="semanas">Semanas para el calculo</label>
            <input type="number" name="semanas" id="semanas" required="required" value="<?php echo $row->semanas_calculo; ?>" />
        </p>
        
        </fieldset>
        
        <fieldset>
        <legend>Que porcentaje adicional deseas que se pueda pedir en automaticos.</legend>
        
        <p>
            <label for="poncentaje">Porcentaje</label>
            <input type="number" name="porcentaje" id="porcentaje" required="required" value="<?php echo $row->porcentaje; ?>" />
        </p>
        
        </fieldset>

        <p>
            <button class="big" type="submit">Efectuar Cambio</button>
        </p>

    <?php echo form_close();?>
    </div>
</div>