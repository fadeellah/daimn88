<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $phone = htmlspecialchars($_POST["phone"]);
    $message = htmlspecialchars($_POST["message"]);

    if (!$email) {
        echo json_encode(["status" => "error", "message" => "Invalid email"]);
        exit;
    }

    $to = "fadelrizki48@gmail.com"; // Ganti dengan email admin
    $subject = "New Quotation Request from $name";
    $headers = "From: no-reply@yourdomain.com\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";

    $body = "You have received a new quotation request:\n\n";
    $body .= "Name: $name\nEmail: $email\nPhone: $phone\nMessage:\n$message\n";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["status" => "success", "message" => "Quotation submitted successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send email"]);
    }
}
?>
