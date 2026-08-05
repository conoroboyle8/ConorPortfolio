<?php

session_start();

function respond($message, $is_success = false, $status_code = 200) {
    http_response_code($status_code);
    echo '<div class="' . ($is_success ? 'success_message heading-3' : 'error_message') . '">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</div>';
    exit;
}

function post_value($key) {
    return isset($_POST[$key]) ? $_POST[$key] : '';
}

function clean_text($value, $max_length, $allow_newlines = false) {
    $value = strip_tags((string) $value);
    $value = str_replace(array("\r\n", "\r"), "\n", $value);

    if ($allow_newlines) {
        $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/', '', $value);
        $value = preg_replace("/[ \t]+\n/", "\n", $value);
        $value = preg_replace("/\n{4,}/", "\n\n\n", $value);
    } else {
        $value = preg_replace('/[\r\n\t]+/', ' ', $value);
        $value = preg_replace('/[\x00-\x1F\x7F]+/', '', $value);
    }

    $value = trim(preg_replace('/[ ]{2,}/', ' ', $value));

    if (strlen($value) > $max_length) {
        $value = substr($value, 0, $max_length);
    }

    return trim($value);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond('Please send your message using the contact form.', false, 405);
}

// Honeypot field: real visitors should leave this empty.
if (trim(post_value('project_website')) !== '') {
    respond('Message sent.', true);
}

$now = time();
$window_seconds = 600;
$max_attempts = 3;

if (!isset($_SESSION['contact_attempts']) || !is_array($_SESSION['contact_attempts'])) {
    $_SESSION['contact_attempts'] = array();
}

$_SESSION['contact_attempts'] = array_filter($_SESSION['contact_attempts'], function ($timestamp) use ($now, $window_seconds) {
    return ($now - $timestamp) < $window_seconds;
});

if (count($_SESSION['contact_attempts']) >= $max_attempts) {
    respond('Thanks for your patience. Please wait a few minutes before sending another message.', false, 429);
}

$first_name = clean_text(post_value('name'), 80);
$last_name  = clean_text(post_value('last_name'), 80);
$name       = trim($first_name . ' ' . $last_name);
$email      = trim(post_value('email'));
$comments   = clean_text(post_value('comments'), 3000, true);

if ($name === '') {
    respond('Please add your name so I know who the message is from.');
}

if ($email === '' || preg_match('/[\r\n]/', $email) || strlen($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond('Please add a valid email address so I can reply to you.');
}

if ($comments === '') {
    respond('Please add a short message about the project or enquiry.');
}

$address = 'conoroboyle8@gmail.com';
$from_address = 'conoroboyle8@gmail.com';
$from_name = '"Conor O\'Boyle Website"';

$subject_name = clean_text($name, 120);
$e_subject = "Website enquiry from " . $subject_name;

$msg = "You have been contacted by " . $name . "." . "\r\n\r\n";
$msg .= "Message:" . "\r\n" . $comments . "\r\n\r\n";
$msg .= "Reply to: " . $email . "\r\n";
$msg = wordwrap($msg, 70);

$headers = array(
    'From: ' . $from_name . ' <' . $from_address . '>',
    'Reply-To: ' . $email,
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8'
);

$_SESSION['contact_attempts'][] = $now;

$mail_sent = getenv('CONTACT_FORM_TEST_MODE') === '1' ? true : mail($address, $e_subject, $msg, implode("\r\n", $headers));

if ($mail_sent) {
    respond('Message sent.', true);
}

respond('Sorry, the message could not be sent just now. Please try again in a moment.', false, 500);
