<?php
if (isset($_POST['name'])) {
    $email_to      = "hiltibjjbangkok@gmail.com";
    $email_subject = "New class booking request from Hilti BJJ Bangkok website";

    function died($error) {
        echo json_encode(['status' => 'error', 'message' => $error]);
        die();
    }

    if (!isset($_POST['name']) || !isset($_POST['contact'])) {
        died('There appears to be a problem with the form you submitted.');
    }

    // Honeypot spam check
    if (!empty($_POST['website'])) {
        die(json_encode(['status' => 'success', 'message' => '']));
    }

    $name       = trim($_POST['name']);
    $contact    = trim($_POST['contact']);
    $experience = isset($_POST['experience']) ? trim($_POST['experience']) : '';
    $interest   = isset($_POST['interest'])   ? trim($_POST['interest'])   : '';
    $message    = isset($_POST['message'])    ? trim($_POST['message'])    : '';

    if (strlen($name) < 1) {
        died('Please enter your name.');
    }
    if (strlen($contact) < 1) {
        died('Please enter your email or LINE ID.');
    }

    function clean_string($string) {
        $bad = ["content-type", "bcc:", "to:", "cc:", "href"];
        return str_replace($bad, "", $string);
    }

    $email_message  = "Name: "       . clean_string($name)       . "\n";
    $email_message .= "Contact: "    . clean_string($contact)    . "\n";
    $email_message .= "Experience: " . clean_string($experience) . "\n";
    $email_message .= "Interest: "   . clean_string($interest)   . "\n\n";
    $email_message .= "Message:\n"   . clean_string($message)    . "\n";

    $headers = "From: noreply@hiltibjjbangkok.com\r\n" .
               "Reply-To: " . clean_string($contact) . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    @mail($email_to, $email_subject, $email_message, $headers);

    echo json_encode(['status' => 'success', 'message' => 'Your message has been sent.']);
}
?>
