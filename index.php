<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links -->
    <link rel="icon" type="image/x-icon" href="images/logo-icon.jpg">
    <link rel="stylesheet" href="styles/css/auth.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>EverLife</title>
</head>
<body>
    <div class="auth-base-user">
        <img class="auth-img" src="images/logo-name.png" alt="logo-name" draggable="false">
        <p class="auth-welcome text-center">Welcome!</p>
        <div class="auth-buttons">
            <a class="submit-btn" href="user/user-home.php">User</a>
            <a class="submit-btn" href="admin.php">Admin</a>
        </div>
    </div>
    
    <script>
        localStorage.setItem('disclaimerShown', 'false');
        localStorage.setItem('instructionShown', 'false');
        localStorage.setItem('successfulRegistration', 'false');
        localStorage.setItem('memberDeleted', null);
        localStorage.setItem('memberUpdated', null);
        localStorage.setItem('dependentDeleted', null);
        localStorage.setItem('dependentUpdated', null);
    </script>
</body>
</html>