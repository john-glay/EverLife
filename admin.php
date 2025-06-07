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
    <style>
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }
        
        .shake {
            animation: shake 0.5s;
        }
    </style>
</head>
<body>
    <form id="loginForm"> 
        <div class="auth-base-admin">
            <img class="auth-img" src="images/logo-name.png" alt="philhealth-logo" draggable="false">
            <p class="auth-admin text-center">ADMINISTRATOR</p>
            <div id="without-error" class='no-warning' role='alert'>
                <p class='m-0'>Please enter the admin username and password.</p>
            </div>
            <div id="with-error" class='register-warning alert alert-danger alert-dismissible fade show' role='alert'>
                <p class='m-0'>Incorrect username or password.</p>
            </div>
            <label class="auth-label d-block">Username<small>&nbsp;*</small></label>
            <input type="text" class="input-form" name="username" placeholder="admin" required>
            <label class="auth-label d-block">Password<small>&nbsp;*</small></label>
            <input type="password" class="input-form" name="password" placeholder="admin" required>
            <div class="auth-buttons">
                <button type="button" class="clear-btn" onclick="window.location.href='index.php';">Cancel</button>
                <button type="submit" class="submit-btn">Log in</button>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const username = event.target.username.value;
            const password = event.target.password.value;

            if (username === 'admin' && password === 'admin') {
                window.location.href = 'admin/admin-home.php';
            } else {
                document.getElementById('with-error').style.display = 'block';
                document.getElementById('without-error').style.display = 'none';
                const form = document.getElementById('with-error');
                form.classList.add('shake');
                setTimeout(() => form.classList.remove('shake'), 500);
            }
        });
    </script>
</body>
</html>