<?php
class Register extends Model
{
    public $id;
    public $username;
    public $email;
    public $role;
    public $password;
    public $created_at;
    public $updated_at;


    public function checkUser()
    {
        // Ensure that no user is registered twice. 
        // the email and usernames should be unique
        $user_check_query = "SELECT * FROM users WHERE username='$username' 
        OR email='$email' LIMIT 1";

        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
            if ($user['username'] === $username) {
                array_push($errors, "Username already exists");
            }
            if ($user['email'] === $email) {
                array_push($errors, "Email already exists");
            }
        }
    }
}
