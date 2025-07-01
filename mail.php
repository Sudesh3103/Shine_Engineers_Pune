<?php
// Include PHPMailer files first
require_once 'mail/phpmailer/Exception.php';
require_once 'mail/phpmailer/PHPMailer.php';
require_once 'mail/phpmailer/SMTP.php';

// Use correct namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize and validate input data
    $firstName = isset($_POST['first_name']) ? filter_var(trim($_POST['first_name']), FILTER_SANITIZE_STRING) : '';
    $lastName = isset($_POST['last_name']) ? filter_var(trim($_POST['last_name']), FILTER_SANITIZE_STRING) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING) : '';
    $subjectInput = isset($_POST['subject']) ? filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING) : '';
    $messageInput = isset($_POST['message']) ? filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING) : '';
    
    // Create full name
    $fullName = trim($firstName . ' ' . $lastName);
    
    // Validate required fields
    if (empty($firstName) || empty($lastName) || empty($email)) {
        echo "<script>
            alert('First name, last name, and email are required fields. Please fill in all mandatory information.');
            window.history.back();
        </script>";
        exit;
    }
    
    // Validate name lengths
    if (strlen($firstName) < 2 || strlen($lastName) < 2) {
        echo "<script>
            alert('First name and last name must be at least 2 characters long.');
            window.history.back();
        </script>";
        exit;
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            alert('Please enter a valid email address to ensure we can respond to your inquiry.');
            window.history.back();
        </script>";
        exit;
    }
    
    // Set default subject if empty
    if (empty($subjectInput)) {
        $subjectInput = 'Contact Form Inquiry';
    }
    
    // Validate input lengths
    if (strlen($firstName) > 50 || strlen($lastName) > 50) {
        echo "<script>
            alert('Name fields cannot exceed 50 characters.');
            window.history.back();
        </script>";
        exit;
    }
    
    if (strlen($email) > 100) {
        echo "<script>
            alert('Email address is too long.');
            window.history.back();
        </script>";
        exit;
    }
    
    if (strlen($phone) > 20) {
        echo "<script>
            alert('Phone number is too long.');
            window.history.back();
        </script>";
        exit;
    }
    
    if (strlen($subjectInput) > 200) {
        echo "<script>
            alert('Subject cannot exceed 200 characters.');
            window.history.back();
        </script>";
        exit;
    }
    
    if (strlen($messageInput) > 1000) {
        echo "<script>
            alert('Message cannot exceed 1000 characters.');
            window.history.back();
        </script>";
        exit;
    }
    
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vedhindia@gmail.com'; // Your email address
        $mail->Password = 'vrxn ruhw alpl kvzs'; // Your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        
        // Recipients
        $mail->setFrom('shineengineers1972@gmail.com', 'Contact Form System');
        $mail->addAddress('shineengineers1972@gmail.com', 'Website Admin');
        $mail->addReplyTo($email, $fullName);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Contact Us Page - ' . $subjectInput;
        
        // Professional email body (HTML format)
        $email_body = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Contact Form Submission</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            line-height: 1.6; 
            color: #333333; 
            max-width: 700px; 
            margin: 0 auto; 
            background-color: #f8f9fa;
            padding: 20px;
        }
        .email-container { 
            background-color: #ffffff; 
            border-radius: 12px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header { 
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white; 
            padding: 30px 25px; 
            text-align: center; 
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header p {
            margin: 8px 0 0 0;
            opacity: 0.9;
            font-size: 14px;
        }
        .content {
            padding: 30px 25px;
        }
        .intro-text {
            background-color: #e8f4fd;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #3498db;
        }
        .intro-text p {
            margin: 0;
            color: #2c3e50;
            font-weight: 500;
        }
        .contact-details {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 25px;
        }
        .detail-header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            color: #2c3e50;
            font-size: 16px;
        }
        .field-row { 
            padding: 15px 20px;
            border-bottom: 1px solid #f1f3f4;
            display: flex;
            align-items: flex-start;
        }
        .field-row:last-child {
            border-bottom: none;
        }
        .field-label { 
            font-weight: 600; 
            color: #495057; 
            min-width: 120px;
            margin-right: 15px;
            font-size: 14px;
        }
        .field-value { 
            color: #212529;
            flex: 1;
            word-wrap: break-word;
        }
        .message-section {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
        }
        .message-header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            color: #2c3e50;
            font-size: 16px;
        }
        .message-content { 
            padding: 20px;
            background-color: #fafbfc;
            border: none;
            line-height: 1.7;
            color: #495057;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 25px;
            text-align: center;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
            font-size: 13px;
        }
        .timestamp {
            font-style: italic;
            margin-top: 10px;
        }
        .priority-notice {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        @media (max-width: 600px) {
            .field-row {
                flex-direction: column;
            }
            .field-label {
                min-width: auto;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class='email-container'>
        <div class='header'>
            <h1>New Contact Form Submission</h1>
            <p>Message received through your website contact form</p>
        </div>
        
        <div class='content'>
            <div class='intro-text'>
                <p>You have received a new message through your website contact form. Please review the details below and respond promptly.</p>
            </div>
            
            <div class='priority-notice'>
                <strong>⚡ Action Required:</strong> New contact inquiry requires your attention and response.
            </div>
            
            <div class='contact-details'>
                <div class='detail-header'>📋 Contact Information</div>
                
                <div class='field-row'>
                    <div class='field-label'>Full Name:</div>
                    <div class='field-value'>" . htmlspecialchars($fullName) . "</div>
                </div>
                
                <div class='field-row'>
                    <div class='field-label'>Email Address:</div>
                    <div class='field-value'><a href='mailto:" . htmlspecialchars($email) . "' style='color: #3498db; text-decoration: none;'>" . htmlspecialchars($email) . "</a></div>
                </div>";
        
        if (!empty($phone)) {
            $email_body .= "<div class='field-row'>
                        <div class='field-label'>Phone Number:</div>
                        <div class='field-value'><a href='tel:" . htmlspecialchars($phone) . "' style='color: #3498db; text-decoration: none;'>" . htmlspecialchars($phone) . "</a></div>
                    </div>";
        }
        
        $email_body .= "<div class='field-row'>
                    <div class='field-label'>Subject:</div>
                    <div class='field-value'><strong>" . htmlspecialchars($subjectInput) . "</strong></div>
                </div>";
        
        $email_body .= "</div>"; // Close contact-details
        
        if (!empty($messageInput)) {
            $email_body .= "<div class='message-section'>
                        <div class='message-header'>💬 Message Details</div>
                        <div class='message-content'>" . htmlspecialchars($messageInput) . "</div>
                    </div>";
        }
        
        $email_body .= "</div>"; // Close content
        
        $email_body .= "<div class='footer'>
                <p><strong>Website Contact Form</strong></p>
                <p>This message was sent through your website contact form.</p>
                <div class='timestamp'>
                    <p>📅 Received: " . date('F j, Y \a\t g:i A T') . "</p>
                </div>
            </div>
        </div>
    </body>
</html>";
        
        // Set email body
        $mail->Body = $email_body;
        
        // Create plain text version for better compatibility
        $plain_text = "NEW CONTACT FORM SUBMISSION\n";
        $plain_text .= "===========================\n\n";
        $plain_text .= "CONTACT DETAILS:\n";
        $plain_text .= "Name: " . $fullName . "\n";
        $plain_text .= "Email: " . $email . "\n";
        if (!empty($phone)) $plain_text .= "Phone: " . $phone . "\n";
        $plain_text .= "Subject: " . $subjectInput . "\n\n";
        if (!empty($messageInput)) {
            $plain_text .= "MESSAGE:\n";
            $plain_text .= $messageInput . "\n\n";
        }
        $plain_text .= "Received: " . date('F j, Y \a\t g:i A T') . "\n";
        
        $mail->AltBody = $plain_text;
        
        // Send email
        $mail->send();
        
        echo "<script>
            alert('Thank you for contacting us. We will get back to you soon.');
            window.location.href = 'index.html';
        </script>";
        
    } catch (Exception $e) {
        error_log("Contact form error: " . $mail->ErrorInfo);
        echo "<script>
            alert('Message failed to send. Please try again later.');
            window.history.back();
        </script>";
    }
    
} else {
    // Redirect if accessed directly
    echo "<script>
        alert('Invalid access method. Please use the contact form.');
        window.location.href = 'index.html';
    </script>";
    exit;
}
?>