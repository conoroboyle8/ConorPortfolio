<?php

if (!$_POST) exit;

// Email address verification
function isEmail($email) {
    return (preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
}

// Sanitize inputs — compatible PHP 5.x+
$name     = strip_tags(trim(isset($_POST['name'])     ? $_POST['name']     : ''));
$email    = strip_tags(trim(isset($_POST['email'])    ? $_POST['email']    : ''));
$comments = strip_tags(trim(isset($_POST['comments']) ? $_POST['comments'] : ''));
$verify   = trim(isset($_POST['verify'])              ? $_POST['verify']   : '');

// Validation
if ($name === '') {
    echo '<div class="error_message">Attention! You must enter your name.</div>';
    exit();
}

if ($email === '') {
    echo '<div class="error_message">Attention! Please enter a valid email address.</div>';
    exit();
}

if (!isEmail($email)) {
    echo '<div class="error_message">Attention! You have entered an invalid e-mail address, try again.</div>';
    exit();
}

if ($comments === '') {
    echo '<div class="error_message">Attention! Please enter your message.</div>';
    exit();
}

if ($verify === '') {
    echo '<div class="error_message">Attention! Please enter the verification number.</div>';
    exit();
}

if ($verify !== '4') {
    echo '<div class="error_message">Attention! The verification number you entered is incorrect.</div>';
    exit();
}

// Recipient — change to your address
$address = "clapatform@gmail.com";

$e_subject = 'You\'ve been contacted by ' . $name . '.';

$e_body    = "You have been contacted by $name, their additional message is as follows." . "\r\n\r\n";
$e_content = "\"$comments\"" . "\r\n\r\n";
$e_reply   = "You can contact $name via email, $email";

$msg = wordwrap($e_body . $e_content . $e_reply, 70);

$headers  = "From: $email" . "\r\n";
$headers .= "Reply-To: $email" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/plain; charset=utf-8" . "\r\n";
$headers .= "Content-Transfer-Encoding: quoted-printable" . "\r\n";

if (mail($address, $e_subject, $msg, $headers)) {
    echo '<div class="success_message heading-3">Message sent.</div>';
} else {
    echo '<div class="error_message">There was an error sending your message. Please try again.</div>';
}