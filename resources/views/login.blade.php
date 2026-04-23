<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            transition: 0.3s;
        }

        input:focus {
            border-color: #5b6ef5;
            outline: none;
        }

        .password-box {
            position: relative;
        }

        .toggle {
            position: absolute;
            right: 10px;
            top: 12px;
            cursor: pointer;
            font-size: 14px;
            color: #777;
        }

        .forgot {
            text-align: right;
            font-size: 13px;
            margin-top: 5px;
        }

        .forgot a {
            text-decoration: none;
            color: #5b6ef5;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #667eea, #5b6ef5);
            color: white;
            border: none;
            border-radius: 8px;
            margin-top: 15px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: center;
        }

        .logo {
            text-align: center;
            margin-bottom: 15px;
        }

        .logo img {
            width: 60px;
        }

        @media(max-width: 400px) {
            .login-card {
                padding: 20px;
            }
        }

    </style>
</head>

<body>

<div class="container">

    <div class="login-card">

        <div class="logo">
            <img src="https://cdn-icons-png.flaticon.com/512/906/906334.png">
        </div>

        <h2>Sign In</h2>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Password *</label>

                <div class="password-box">
                    <input type="password" id="password" name="password" placeholder="Enter password" required>
                    <span class="toggle" onclick="togglePassword()">👁</span>
                </div>

                <div class="forgot">
                    <a href="#">Forgot Password?</a>
                </div>
            </div>

            <button class="btn">Login</button>

        </form>

    </div>

</div>

<script>
function togglePassword() {
    let pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}
</script>

</body>
</html>