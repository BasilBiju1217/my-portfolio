<?php
// send_email.php - simple handler
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method Not Allowed';
    exit;
}

$from = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$subject = strip_tags(trim($_POST['subject'] ?? 'No subject'));
$message_body = trim($_POST['message'] ?? '');

if (!filter_var($from, FILTER_VALIDATE_EMAIL) || $message_body === '') {
    echo "<h2>Invalid input. Please go back and try again.</h2>";
    exit;
}

$to = 'basilbiju1217@gmail.com'; // your email
$subject_full = "[Portfolio Contact] " . $subject;
$headers = "From: {$from}\r\n";
$headers .= "Reply-To: {$from}\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$body = "You have a new message from your portfolio contact form.\n\n";
$body .= "From: {$from}\n";
$body .= "Subject: {$subject}\n\n";
$body .= "Message:\n{$message_body}\n\n";
$body .= "----\nThis email was sent from your portfolio contact form.";

$sent = mail($to, $subject_full, $body, $headers);

if ($sent) {
    echo "<h2>Thank you — your message was sent successfully.</h2>";
    echo "<p><a href='index.html'>Return to homepage</a></p>";
} else {
    echo "<h2>Sorry — message could not be sent. Try again later.</h2>";
}
?>
