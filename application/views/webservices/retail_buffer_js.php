<script language="javascript" type="text/javascript">
$(document).ready(function(){
    $('#sucursal').focus();

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
    
    $('#retail_form').submit(function(event){
        event.preventDefault();
        
        
            var url = $(this).attr('action');
            
            var variables = {
                sucursal: $('#sucursal').attr('value'),
                perini: $('#perini').attr('value'),
                perfin: $('#perfin').attr('value')
            };
            $.post( url, variables, function(data) {
                $('#resultado').html(data);
            });
    });
    
});
</script>