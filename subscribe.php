<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subscriberEmail = htmlspecialchars(trim($_POST['subscriber_email']));

    $to = "sudeshkalokhe3103@gmail.com"; // Admin email
    $subject = "New Subscription Request";
    $message = "
    <html>
    <head>
        <title>New Subscriber</title>
    </head>
    <body>
        <p>You have a new subscriber:</p>
        <table>
            <tr><td><strong>Email:</strong></td><td>{$subscriberEmail}</td></tr>
        </table>
    </body>
    </html>
    ";

    // Email headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: <$subscriberEmail>\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "<script>alert('Thank you for subscribing!'); location.replace('index.php');</script>";
    } else {
        echo "<script>alert('Subscription failed. Please try again.'); location.replace('index.php');</script>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>
