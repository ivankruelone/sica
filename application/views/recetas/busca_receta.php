<div class="block-border">
    <div class="block-content">


<h1>
            Busca Receta:
</h1>
<?php
	echo form_open('', array('class' => 'form', 'id' => 'busca_receta_form'));
?>

            <fieldset>
            
            <p>
                <label for="folio">Folio</label>
                 <input type="text" name="folio" id="folio" required="required" class="full-width" />
            </p>
            </fieldset>

<?php
    
    echo form_close();
    
?>
    </div>
</div>