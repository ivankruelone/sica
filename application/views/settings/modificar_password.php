<div class="block-border">
    <div class="block-content">
    <h1>
            <?php echo $titulo; ?>
    </h1>
    <div id="mensaje" align="center" style="color: red;"></div>
    <?php echo form_open('settings/submit_modificar_password', array('class' => 'form', 'id' => 'cc_form'));?>
    
        <p>
            <label for="contra_act">Contrase&ntilde;a Actual</label>
            <input type="password" name="contra_act" id="contra_act" required="required" />
        </p>

        <p>
            <label for="contra_nue1">Contrase&ntilde;a Nueva</label>
            <input type="password" name="contra_nue1" id="contra_nue1" required="required" />
        </p>

        <p>
            <label for="contra_nue2">Contrase&ntilde;a Nueva (Repetir)</label>
            <input type="password" name="contra_nue2" id="contra_nue2" required="required" />
        </p>

        <p>
            <button class="big" type="submit">Efectuar Cambio</button>
        </p>

    <?php echo form_close();?>
    </div>
</div>