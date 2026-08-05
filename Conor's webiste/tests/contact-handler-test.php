<?php

$root = dirname(__DIR__);
$php = PHP_BINARY;
$session_dir = __DIR__ . '/.sessions';
$passed = 0;
$failed = 0;

function run_contact_case($label, $code, $expected, $env = array()) {
    global $root, $php, $session_dir, $passed, $failed;

    $descriptor_spec = array(
        0 => array('pipe', 'r'),
        1 => array('pipe', 'w'),
        2 => array('pipe', 'w')
    );

    if (!is_dir($session_dir)) {
        mkdir($session_dir, 0775, true);
    }

    $bootstrap = 'ini_set("session.save_path", ' . var_export($session_dir, true) . '); session_id("test" . str_replace(".", "", uniqid("", true))); ';
    $process = proc_open(array($php, '-r', $bootstrap . $code), $descriptor_spec, $pipes, $root, array_merge($_ENV, $env));

    if (!is_resource($process)) {
        echo "FAIL " . $label . " - could not start PHP process\n";
        $failed++;
        return;
    }

    fclose($pipes[0]);
    $output = stream_get_contents($pipes[1]);
    $error = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $exit_code = proc_close($process);

    if ($exit_code === 0 && strpos($output, $expected) !== false && trim($error) === '') {
        echo "PASS " . $label . "\n";
        $passed++;
        return;
    }

    echo "FAIL " . $label . "\n";
    echo "Expected: " . $expected . "\n";
    echo "Output: " . trim($output) . "\n";
    echo "Error: " . trim($error) . "\n";
    echo "Exit: " . $exit_code . "\n";
    $failed++;
}

run_contact_case(
    'rejects non-POST requests',
    '$_SERVER["REQUEST_METHOD"]="GET"; include "contact.php";',
    'Please send your message using the contact form.'
);

run_contact_case(
    'quietly accepts honeypot submissions',
    '$_SERVER["REQUEST_METHOD"]="POST"; $_POST["project_website"]="https://spam.example"; include "contact.php";',
    'Message sent.'
);

run_contact_case(
    'requires a name',
    '$_SERVER["REQUEST_METHOD"]="POST"; $_POST["email"]="reader@example.com"; $_POST["comments"]="Hello"; include "contact.php";',
    'Please add your name so I know who the message is from.'
);

run_contact_case(
    'rejects invalid email addresses',
    '$_SERVER["REQUEST_METHOD"]="POST"; $_POST["name"]="Conor"; $_POST["email"]="not-an-email"; $_POST["comments"]="Hello"; include "contact.php";',
    'Please add a valid email address so I can reply to you.'
);

run_contact_case(
    'rejects email header injection',
    '$_SERVER["REQUEST_METHOD"]="POST"; $_POST["name"]="Conor"; $_POST["email"]="bad\r\nBcc: test@example.com"; $_POST["comments"]="Hello"; include "contact.php";',
    'Please add a valid email address so I can reply to you.'
);

run_contact_case(
    'requires a message',
    '$_SERVER["REQUEST_METHOD"]="POST"; $_POST["name"]="Conor"; $_POST["email"]="reader@example.com"; include "contact.php";',
    'Please add a short message about the project or enquiry.'
);

run_contact_case(
    'accepts a valid message in test mode',
    '$_SERVER["REQUEST_METHOD"]="POST"; $_POST["name"]="Conor"; $_POST["last_name"]="O\'Boyle"; $_POST["email"]="reader@example.com"; $_POST["comments"]="I would like to discuss a project."; include "contact.php";',
    'Message sent.',
    array('CONTACT_FORM_TEST_MODE' => '1')
);

echo "\n" . $passed . " passed, " . $failed . " failed\n";
exit($failed > 0 ? 1 : 0);
