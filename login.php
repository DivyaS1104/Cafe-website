<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Start session and redirect to dashboard
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: dashboard.html');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Invalid email or password.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(135deg, #74ebd5, #9face6);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif;
    }
    .form-container {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }
    .form-container h2 {
        margin-bottom: 1.5rem;
        color: #6c63ff;
        text-align: center;
    }
    .btn-custom {
        background: #6c63ff;
        color: white;
        border: none;
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
        margin-top: 1rem;
        border-radius: 5px;
    }
    .btn-custom:hover {
        background: #574bbd;
    }
    a {
        text-decoration: none;
        color: #6c63ff;
    }
    a:hover {
        text-decoration: underline;
    }
</style>

</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-custom">Login</button>
        </form>
        <p class="text-center mt-3">Don't have an account? <a href="signup.php">Signup</a></p>
    </div>
</body>
</html>
