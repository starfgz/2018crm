<?php
namespace  app\index\controller;

use PHPMailer\PHPMailer\PHPMailer;

use think\Config;

require ROOT_PATH .'/extend/PHPMailer/src/PHPMailer.php';
require ROOT_PATH .'/extend/PHPMailer/src/SMTP.php';

class Common{

    static function  send_mail($to,$title,$content,$type = "HTML"){

        $email = Config::get("email");


        $mail = new PHPMailer();
        try{
            //设置邮件使用SMTP
            $mail->isSMTP();
            // 设置邮件程序以使用SMTP
            $mail->Host = $email['server'];
            // 设置邮件内容的编码
            $mail->CharSet='UTF-8';
            // 启用SMTP验证
            $mail->SMTPAuth = true;
            // SMTP username
            $mail->Username = $email['user'];
            // SMTP password
            $mail->Password = $email['pwd'];

            // 连接的TCP端口
            $mail->Port = $email['port'];
            //设置发件人
            $mail->setFrom($email['user']);
            //  添加收件人1
            $mail->addAddress($to);     // Add a recipient

            // 将电子邮件格式设置为HTML
            $mail->isHTML($type);
            $mail->Subject = $title;
            $mail->Body    = $content;
          //  $mail->AltBody = '这是非HTML邮件客户端的纯文本';
            $mail->send();


        }catch (Exception $e){
            echo  'Mailer Error: ' . $mail->ErrorInfo;
        }
    }





}