/**
 * Created by julien on 03/08/17.
 */
/****************SSRelay JS Plugin****************/
$(function() {
    bindSSRelay();

    e.channel('chan-relay')
        .listen('.Tchoblond59\\SSRelay\\Events\\SSRelayEvent', function (e) {
            console.log('SSRelayEvent', e)
            $('input.SSRelayWidget').unbind();
            if(e.state == 1)
            {
                $('input.SSRelayWidget[data-sensor_id='+e.sensor.id+']').bootstrapToggle('on');
                $('input.SSRelayWidget[data-sensor_id='+e.sensor.id+']').closest('form').find('i').addClass('yellow-bulb');
            }
            else
            {
                $('input.SSRelayWidget[data-sensor_id='+e.sensor.id+']').bootstrapToggle('off');
                $('input.SSRelayWidget[data-sensor_id='+e.sensor.id+']').closest('form').find('i').removeClass('yellow-bulb');
            }
            bindSSRelay();
        })
})

function bindSSRelay() {
    $('input.SSRelayWidget').change(function() {
        var form = $(this).closest("form");
        submitSSrelayFormWidget(form);
    })

    var tempform  = $('button.SSRelayTemp').closest('form');
    tempform.submit(function (e) {
        e.preventDefault();
        submitSSrelayFormWidget(tempform);
    })
}

function submitSSrelayFormWidget(form)
{
    var is_checked = form.find('input[type=checkbox]').is(':checked');
    if(is_checked)
    {
        form.find('i').addClass('yellow-bulb');
    }
    else
    {
        form.find('i').removeClass('yellow-bulb');
    }
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json', // JSON
        success: function(reponse) {
            console.log(reponse);
            $.notify(reponse);
        }
    });
}
/*************************************************/
