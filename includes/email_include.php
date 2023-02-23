<?php
 require '../commons/PHPMailer/PHPMailerAutoload.php';
            $mail=new PHPMailer;
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';//specify main and
            $mail->SMTPAuth= true;//Enable SMTP authentication
            $mail->Username='dicksonsfoodcity749@gmail.com';//SMTP Username
            $mail->Password='749_dickson';//SMTP password
            $mail->SMTPSecure='tls';
            $mail->Port=587;