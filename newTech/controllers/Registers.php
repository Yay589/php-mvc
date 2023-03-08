<?php

class Registers extends \App\Controller
{
    public function esc(String $value)
    {
        // bring the global db connect object into function
        global $conn;

        $val = trim($value); // remove empty space sorrounding string
        $val = mysqli_real_escape_string($conn, $value);

        return $val;
    }
    public function register_form()
    {
        $this->render('register_form');
    }
    public function submit()
    {
        $this->loadModel("Register");

        // variable declaration
        $username = "";
        $email    = "";
        $errors = array();

        // REGISTER USER
        if (isset($_POST['reg_user'])) {
            // receive all input values from the form
            $username = $this->esc($_POST['username']);
            $email = $this->esc($_POST['email']);
            $password_1 = $this->esc($_POST['password_1']);
            $password_2 = $this->esc($_POST['password_2']);

            // form validation: ensure that the form is correctly filled
            if (empty($username)) {
                array_push($errors, "Uhmm...We gonna need your username");
            }
            if (empty($email)) {
                array_push($errors, "Oops.. Email is missing");
            }
            if (empty($password_1)) {
                array_push($errors, "uh-oh you forgot the password");
            }
            if ($password_1 != $password_2) {
                array_push($errors, "The two passwords do not match");
            }

            $check = $this->Register->checkUser($username, $email, $password_1);
            $this->render('register_form');
        }
    }
}
