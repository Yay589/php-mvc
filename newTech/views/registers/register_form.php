<div class="container">
    <!-- Navbar -->

    <!-- // Navbar -->

    <div style="width: 40%; margin: 20px auto;">
        <form method="post" action="/registers/submit">
            <h2>Register on lifeBlog</h2>

            <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
            <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
            <input type="password" name="password_1" placeholder="Password">
            <input type="password" name="password_2" placeholder="Password confirmation">
            <button type="submit" class="btn" name="reg_user">Register</button>
            <p>
                Already a member? <a href="login.php">Sign in</a>
            </p>
        </form>
    </div>
</div>