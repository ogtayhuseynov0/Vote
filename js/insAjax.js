/**
 * Created by ogtay on 3/22/17.
 */

$(document).ready(function () {
    $.ajaxPrefilter(function( options, original_Options, jqXHR ) {
        options.async = true;
    });

    var cc=$('#kelem');
    var xmlHt= new XMLHttpRequest();
    xmlHt.onreadystatechange= function () {
        if (this.status==200 && this.readyState==4 ){
            cc.innerHTML="";
            cc.html(this.responseText);
        }
    };
    xmlHt.open("GET",'all.php?dep=',true);
    xmlHt.send();
});