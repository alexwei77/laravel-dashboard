jQuery(document).ready(function() {

   //For the sticky menu 
    $("#navbar-main").sticky({topSpacing: 0});
    
    if ($('.icon-section').is(':appeared')) {
        $("#choose-country2").hide();
        $(".hide-home").hide();
    }


    $(window).bind('scroll', function() {
        if ($('.icon-section').is(':appeared')) {
            //alert("disappeared");
            $("#choose-country2").hide();
            $(".hide-home").hide();
        } else {
            $("#choose-country2").show();
            $(".hide-home").show();
        }
    });


    //For the chatbox 
    var LHCChatOptions = {};
    LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500,domain:'stafflife.com'};
    (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
        var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
        po.src = '//dmmdev.com/lhctest/index.php/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(hide_offline)/true/(top)/350/(units)/pixels/(leaveamessage)/true/(department)/2/(theme)/1?r='+referrer+'&l='+location;
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();



});