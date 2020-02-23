<?php

function send($to,$rand){
    $subject = "Mail Validation";
    $ecc=password_hash($rand,1);
    $rand=$rand+5;
    $link="http://ss.gmatch.ml/main.php?ml=".$ecc."&mr=".$rand;
    $message ="<!doctype html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\"
          content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>Vote Email</title>
    <style>
        .header {
            width: 100%;
            height: 50px;
            background-color: #ae475e;
            -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);

        }

        .main {
            margin-top: 6px;
            width: 100%;
            height: 250px;
            background-color: #ffffff;
            -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
            text-align: center;

        }

        .footere {
            width: 100%;
            height: 50px;
            background-color: #ae475e;
            -webkit-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.75);
            text-align: center;
        }

        .textt {
            color: white;
        }
        .logo{
            text-align: center;
        }
        .fot{
            text-align: center;
        }
        .LaLink{
            text-decoration: none;
            background-color: #ae475e;
            border-radius: 2px;
            margin-top: 5%;
            color: white;
        }
        .LaLink:hover{
            background-color: #ce4d78;
        }
    </style>
</head>

<body>
<div class=\"header\">
    <h1 class=\"textt logo\">Vote</h1>
</div>
<div class=\"main\">
    <div class=\"link\">
        <p>You have tried to register from Vote faculty website to Vote for instructor.</p>
        <p>To activate and validate your account you should click the link below.</p>
        <p><a href=\"$link\" target=\"_blank\">$link</a></p>
    </div>
</div>

<div class=\"footere\">
    <h4><span class=\"textt fot\">2017 All Rights Reserved by Vote ©</span></h4>
</div>

</body>
</html>";

// Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
    $headers .= "From: Vote MailServer <vote@gmatch.ml>" . "\r\n".
    "Reply-To: norply@gmatch.ml"."\r\n";

    mail($to,$subject,$message,$headers);
}
?>