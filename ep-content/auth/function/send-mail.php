<?php 
    function sendmail(string $to,string $subject='',string $msg=''){
        $unique = substr(time(),4,10);
        $to = "mdzahidpro1@gmail.com, ".$to;
        $subject = $subject;

        $message = "
        <html>
        <head>
        <title>Email Varification Code</title>
        </head>
        <body>
        <p>Verify your Email account</p>
            <div>
                <p>Your Code: <b>".$unique."</b></p>
            </div>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <mdzahidpro1@gmail.com>' . "\r\n";
        $headers .= 'Cc: mdzahid.pro@gmail.com' . "\r\n";

        if(mail($to,$subject,$message,$headers)){
            return [true,$unique];
        }else{
            return [false,''];
        }
    }


    function welcomemail(string $to){
        $unique = substr(time(),4,10);
        $to = $to;
        $subject = "Welcome mail";

        $message = "
        <html>
        <head>
        <title>Email Varification Confirmed</title>
        </head>
        <body>
        <p>Welcome to Eshopper</p>
            <div>
                <p>Successfuly Virifyed your email Account</b></p>
            </div>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <mdzahidpro1@gmail.com>' . "\r\n";
        $headers .= 'Cc: mdzahidpro1@gmail.com' . "\r\n";

        if(mail($to,$subject,$message,$headers)){
            return [true,$unique];
        }else{
            return [false,''];
        }
    }