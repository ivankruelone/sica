<script language="javascript" type="text/javascript">
$('#referencia').focus();


$('#referencia').keyup(function(){
    $(this).val($(this).attr('value').toUpperCase());
});

$('#notas').keyup(function(){
    $(this).val($(this).attr('value').toUpperCase());
});

$('.datepicker').datepick({
        dateFormat: 'yyyy-mm-dd',
        alignment: 'bottom',
        showOtherMonths: true,
        selectOtherMonths: true,
        renderer: {
            picker: '<div class="datepick block-border clearfix form"><div class="mini-calendar clearfix">' +
                    '{months}</div></div>',
            monthRow: '{months}',
            month: '<div class="calendar-controls">' +
                        '{monthHeader:M yyyy}' +
                    '</div>' +
                    '<table cellspacing="0">' +
                        '<thead>{weekHeader}</thead>' +
                        '<tbody>{weeks}</tbody></table>',
            weekHeader: '<tr>{days}</tr>',
            dayHeader: '<th>{day}</th>',
            week: '<tr>{days}</tr>',
            day: '<td>{day}</td>',
            monthSelector: '.month',
            daySelector: 'td',
            rtlClass: 'rtl',
            multiClass: 'multi',
            defaultClass: 'default',
            selectedClass: 'selected',
            highlightedClass: 'highlight',
            todayClass: 'today',
            otherMonthClass: 'other-month',
            weekendClass: 'week-end',
            commandClass: 'calendar',
            commandLinkClass: 'button',
            disabledClass: 'unavailable'
        }
    });
    
$('#nueva_entrada_planta_form').submit(function(){
    
    var proveedor = $('#proveedor_id').attr('value');
    var subtipo = $('#subtipo').attr('value');
    var referencia = $('#referencia').attr('value');
    var fecha = $('#fec_doc').attr('value');

    if(proveedor > 0 && subtipo > 0 && referencia.length >= 1 && fecha.length == 10){
        if(confirm('Seguro que deseas agregar este folio con los datos seleccionados?')){
            return true;
        }else{
            return false;
        }
    }else{
        alert('Verifica los datos');
        return false;
    }
    
    
});
</script>