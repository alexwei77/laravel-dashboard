$(document).ready(function () {
    $('#picker1').colorpicker();
    $('#picker2').colorpicker({
        format: 'rgba'
    });
    $('#picker3').colorpicker({
        format: 'rgba', // force this format
        horizontal: true
    });
    $('#picker4').colorpicker({
        colorSelectors: {
            'default': '#A9B6BC',
            'primary': '#418BCA',
            'success': '#4caf50',
            'info': '#67C5DF',
            'warning': '#ee6f00',
            'danger': '#EF6F6C'
        }
    });
    var bodyStyle = $('#panel-bg')[0].style;
    $('#bg-picker').colorpicker({
        color: bodyStyle.backgroundColor
    }).on('changeColor', function (ev) {
        bodyStyle.backgroundColor = ev.color.toHex();
    });
    $('.colorpicker-right:after').css("top","-16px");
});