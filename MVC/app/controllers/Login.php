<?php

class Login extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('userModel');
    }

public function index()
    {
        if(!isset($_POST['login'])){
            $this->view('Login/index');
        }
        else{
            $user = $this->userModel->getUserByUsername($_POST['username']);
        
            if($user != null){
                $hashed_pass = $user->password_hash;
                $password = $_POST['password'];
                if(password_verify($password,$hashed_pass)){
                   $this->createSession($user);
                    $data = [
                        'msg' => "Welcome, $user->username!",
                    ];
                    $this->view('Home/home',$data);  
                }
                else{
                    $data = [
                        'msg' => "Password incorrect! for $user->username",
                    ];
                    $this->view('Login/index',$data);
                }
            }
            else{
                $data = [
                    'msg' => "User: ". $_POST['username'] ." does not exists",
                ];
                $this->view('Login/index',$data);
            }
        }
    }

    public function create()
    {
        if(!isset($_POST['signup'])){
            $this->view('Login/create');
        }
        else{
            $user = $this->userModel->getUserByUsername($_POST['username']);
            if($user == null){
                $data = [
                    'username' => trim($_POST['username']),
                    'email' => $_POST['email'],
                    'role' => 'customer',
                    'pass' => $_POST['password'],
                    'pass_verify' => $_POST['verify_password'],
                    'password_hash' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'username_error' => '',
                    'password_error' => '',
                    'password_match_error' => '',
                    'password_len_error' => '',
                    'msg' => '',
                    'email_error' => ''
                ];
                if($this->validateData($data)){
                    if($this->userModel->createUser($data)){
                        echo '
                        <div class="text-center">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Please wait creating the account for '.trim($_POST["username"]).'</span>
                        </div>
                      </div>';
                        echo '<meta http-equiv="Refresh" content="2; url=/MVC/Login/">';
                 }
                } 
            }
            else{
                $data = [
                    'msg' => "User: ". $_POST['username'] ." already exists",
                ];
                $this->view('Login/create',$data);
            }
            
        }
    }

    public function validateData($data){
        if(empty($data['username'])){
            $data['username_error'] = 'Username can not be empty';
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $data['email_error'] = 'Please check your email and try again';
        }
        if(strlen($data['pass']) < 6){
            $data['password_len_error'] = 'Password can not be less than 6 characters';
        }
        if($data['pass'] != $data['pass_verify']){
            $data['password_match_error'] = 'Password does not match';
        }

        if(empty($data['username_error']) && empty($data['password_error']) && empty($data['password_len_error']) && empty($data['password_match_error'])){
            return true;
        }
        else{
            $this->view('Login/create',$data);
        }
    }

    public function createSession($user){
        $purchases = $this->purchaseModel = $this->model('purchaseModel');
        $cart = $this->purchaseModel->getCart($user->user_id);
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['user_role'] = $user->role;
        $_SESSION['user_cart'] = $cart;
        $_SESSION['user_filename'] = $user->filename;
    }

    public function logout(){
        unset($_SESSION['user_id']);
        session_destroy();
        echo '<meta http-equiv="Refresh" content="1; url=/MVC/Login/">';
    }
}
