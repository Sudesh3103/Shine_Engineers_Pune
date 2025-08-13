<?php
// subscribe.php
require_once 'mail/phpmailer/PHPMailer.php';
require_once 'mail/phpmailer/SMTP.php';
require_once 'mail/phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get and validate email
    $subscriberEmail = trim($_POST['subscriber_email']);
    
    if (empty($subscriberEmail) || !filter_var($subscriberEmail, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.'); history.back();</script>";
        exit();
    }
    
    try {
        // Create PHPMailer instance
        $mail = new PHPMailer(true);
        
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Change to your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'vedhindia@gmail.com';  // Your email
        $mail->Password   = 'vrxn ruhw alpl kvzs';     // Your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Email settings
        $mail->setFrom($subscriberEmail, 'Newsletter Subscriber');
        $mail->addAddress('info@shineengineers.co.in', 'Shine Engineers');
        $mail->addReplyTo($subscriberEmail, 'Newsletter Subscriber');
        
        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New Newsletter Subscription Request';
        
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #007bff; color: white; padding: 20px; text-align: center; }
                .content { background: #f8f9fa; padding: 20px; }
                table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
                th { background-color: #007bff; color: white; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>New Newsletter Subscription</h2>
                </div>
                <div class='content'>
                    <p>You have received a new newsletter subscription request:</p>
                    <table>
                        <tr><th>Email Address:</th><td><strong>$subscriberEmail</strong></td></tr>
                        <tr><th>Date & Time:</th><td>" . date('F j, Y g:i A') . "</td></tr>
                    </table>
                    <p>Please add this email to your newsletter mailing list.</p>
                </div>
            </div>
        </body>
        </html>";
        
        // Plain text version
        $mail->AltBody = "
        New Newsletter Subscription
        
        Email: $subscriberEmail
        Date: " . date('F j, Y g:i A') . "
       
        
        Please add this email to your newsletter mailing list.
        ";
        
        // Send email
        if ($mail->send()) {
            echo "<script>alert('Thank you for subscribing! You will receive our latest updates soon.'); window.location.href = 'index.html';</script>";
        } else {
            echo "<script>alert('Subscription failed. Please try again.'); history.back();</script>";
        }
        
    } catch (Exception $e) {
        echo "<script>alert('Subscription failed. Please try again.'); history.back();</script>";
        error_log("Newsletter subscription error: " . $mail->ErrorInfo);
    }
    
} else {
    // Redirect if accessed directly
    header("Location: index.html");
    exit();
}
?>