<?php

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$nameError = $emailError = $messageError = "";
$name = $email = $organization = $contact = $message = "";
$formValid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $nameError = "Name is required";
        $formValid = false;
    } else {
        $name = sanitizeInput($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $emailError = "Email is required";
        $formValid = false;
    } else {
        $email = sanitizeInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
            $formValid = false;
        }
    }

    if (empty($_POST["message"])) {
        $messageError = "Message is required";
        $formValid = false;
    } else {
        $message = sanitizeInput($_POST["message"]);
    }

    if ($formValid) {
      
        echo "<script>
            alert('Form submitted successfully!');
            window.location.href = 'index.html';
            </script>";
        exit;
    } else {
        echo "<script>
            alert('There was an error in the form. Please try again.');
            window.history.back();
            </script>";
    }
}
?>
