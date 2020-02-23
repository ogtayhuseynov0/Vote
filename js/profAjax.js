$(document).ready(function () {
    var info=$('#infoA');
    var logo=$('#llog');
    var infoBt=$('#infBtn');
    var vtB=$('#vtBtn');
    var load=$('#propred');
    $.ajaxPrefilter(function( options, original_Options, jqXHR ) {
        options.async = true;
    });

    infoBt.on('click',function () {
        load.removeClass('hide');
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               if (this.responseText.localeCompare("")!=0){
                   info.innerHTML="";
                   info.html(this.responseText);
                   load.addClass('hide');
                   logo.innerText="Info";
                   $('.parallax').parallax();
                   $('.button-collapse').sideNav();
                   $('.collapsible').collapsible();
               }
            }
        };
        xmlhttp.open("GET", 'info.php', true);
        xmlhttp.send();
    });

    vtB.on('click',function () {
        load.removeClass('hide');
        var xmlHt= new XMLHttpRequest();
        xmlHt.onreadystatechange= function () {
            if (this.status==200 && this.readyState==4 ){
                info.innerHTML="";
                info.html(this.responseText);
                load.addClass('hide');
                logo.innerText="Vote";

                $('.parallax').parallax();
                $('.button-collapse').sideNav();
                $('.collapsible').collapsible();
            }
        };
        xmlHt.open("GET",'vote.php',true);
        xmlHt.send();
    });
});