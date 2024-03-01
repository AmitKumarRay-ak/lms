<?php
$to = "nonar811@gmail.com";
$subject = "Email Test";
$msg = "Hello Amit";
$from = "From: nonar811@gmail.com";

if (mail($to, $subject, $msg, $from)) {
    echo "email send";
} else {
    echo "not send";
}
?>