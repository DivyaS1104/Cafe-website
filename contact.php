<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        try {
            $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)");
            $stmt->execute(['name' => $name, 'email' => $email, 'message' => $message]);
            echo "<div class='alert alert-success'>Your message has been sent successfully!</div>";
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Failed to send message: " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>All fields are required.</div>";
    }
} else {
    header('Location: food.html');
    exit();
}
?>
