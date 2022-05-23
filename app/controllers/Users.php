<?php
class Users extends Controller
{
    public function __construct()
    {
        if (isLoggedIn()) {
            header('location:' . URLROOT . '/projects/create');
        }
        $this->userModel = $this->model('User');
    }

    public function register()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $feedback = [];
            if (
                !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['Major']) && !empty($_POST['pass']) && !empty($_POST['pass2']) && !empty($_POST['s_code'])
            ) {



                $firstName = trim($_POST['fname']);
                $lastName = trim($_POST['lname']);
                $email = trim($_POST['email']);
                $password = trim($_POST['pass']);
                $pass_conf = trim($_POST['pass2']);
                $code = trim($_POST['s_code']);
                $major = trim($_POST['Major']);
                $hashPassword = password_hash($password, PASSWORD_BCRYPT);
                $params = [
                    ':code' => $code,
                    ':fname' => $firstName,
                    ':lname' => $lastName,
                    ':email' => $email,
                    ':pass' => $hashPassword,
                    ':major' => $major
                ];

                if ($pass_conf != $password) {
                    array_push($feedback, "Passwords dont match");
                }

                if (!$this->userModel->is_student($code, $firstName, $lastName)) {
                    array_push($feedback,  "The given information aren't listed in our database");
                }

                if ($this->userModel->Already_exist($email,  $code)) {
                    array_push($feedback,  "Email/Code already exists");
                }
                if (empty($feedback)) {
                    if ($this->userModel->register($params)) {
                        array_push($feedback,  "Account has been Created");
                        $this->view("users/login", $feedback);
                    } else {
                        array_push($feedback,  "Something went wrong");
                        $this->view("users/register", $feedback);
                    }
                } else {
                    $this->view("users/register", $feedback);
                }
            } else {
                array_push($feedback,  "Fields are required");
                $this->view("users/register", $feedback);
            }
        }
        $this->view("users/register");
    }



    public function login()

    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
            if (
                isset($_POST['pass'], $_POST['login_code'])
                && !empty($_POST['pass']) && !empty($_POST['login_code'])
            ) {


                $login_code = trim($_POST['login_code']);
                $password = trim($_POST['pass']);

                $data = ["login_code" => $login_code, "password" => $password];
                $logged_user = $this->userModel->login($data);

                if ($logged_user) {
                    $_SESSION["session_id"] = $logged_user['student_id'];
                    $_SESSION['fname']   = $logged_user["fname"];
                    $_SESSION['lname']   = $logged_user["lname"];
                    header('location:' . URLROOT . '/projects/create');
                } else {
                    array_push($errors, "Invalid username and password!");
                    $this->view("users/login", $errors);
                }
            } else {

                array_push($errors, 'Fields are required');
                $this->view("users/login", $errors);
            }
        }
        $this->view("users/login");
    }



    public function logout()
    {
        unset($_SESSION['session_id']);
        unset($_SESSION['fname']);
        unset($_SESSION['lname']);
        header('location:' . URLROOT . '/users/login');
    }
}
