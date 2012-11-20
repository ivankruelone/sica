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
    
    $('#nueva_entrada_form').submit(function(event){
        var referencia = $('#referencia').attr('value');
        var proveedor_id = $('#proveedor_id').attr('value');
        var fec_doc = $('#fec_doc').attr('value');
        var monto = $('#monto').attr('value');
        
        if(referencia.length <= 1){
            alert('La referencia debe ser al menos un digito(Usualmente # de Factura)');
            return false;
        }else{
            if(proveedor_id == 0){
                alert('Elige un proveedor.');
                return false;
            }else{
                if(fec_doc.length == 10){
                    if(( parseFloat(monto) == 0 ) || monto.length > 0){
                        
                        return true;
                    }else{
                        alert('Teclea un monto valido')
                        return false;
                    }
                }else{
                    alert('Elige una fecha valida');
                    return false;
                }
            }
        }
    });
</script>