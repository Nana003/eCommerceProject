<?php

    class User extends Controller{
        public function __construct(){
            $this->userModel = $this->model('userModel');
            if(!isLoggedIn()){
                header('Location: /MVC/Login');
            }
        }

        public function index(){
            $this->view('User/index');
        }

        public function getUsers(){
            $users = $this->userModel->getUsers();
            $data = [
                "users" => $users
            ];
            $this->view('User/getUsers',$data);
        }

        public function createUser(){
            if(!isset($_POST['register'])){
                $this->view('User/createUser');
            }
            else{
                $filename= $this->imageUpload();
                $data=[
                    'name' => trim($_POST['name']),
                    'city' => trim($_POST['city']),
                    'phone' => trim($_POST['phone']),
                    'picture' => $filename
                ];
               
                if($this->userModel->createUser($data)){
                    echo 'Please wait we are creating the user for you!';
                    header('Location: /MVC/User/getUsers');
                    //echo '<meta http-equiv="Refresh" content="2; url=/MVC/User/getUsers">';
                }

            }
        }

        //display user profile
        public function displayUserProfile($user_id) {
            //store user_id
            $data = [
                "user" => $user_id
            ];
            //redirect to profile and pass data
            $this->view('Profile/profile', $data);
        }

        //view user settings
        public function viewUserSettings($user_id) {
            //store user_id
            $data = [
                "user_id" => $user_id
            ];
            //redirect to user settings and pass data
            $this->view('User/userSettings', $data);
        }

        public function imageUpload(){
            //default value for the picture
            $filename=false;
            
            //save the file that gets sent as a picture
            $file = $_FILES['picture'];
            
            $acceptedTypes = ['image/jpeg'=>'jpg',
                'image/gif'=>'gif',
                'image/png'=>'png'];
            //validate the file
            
            if(empty($file['tmp_name']))
                return false;

            $fileData = getimagesize($file['tmp_name']);

            if($fileData!=false && 
                in_array($fileData['mime'],array_keys($acceptedTypes))){

                //save the file to its permanent location
                    
                $folder = dirname(APPROOT).'/public/img';
                $filename = uniqid() . '.' . $acceptedTypes[$fileData['mime']];
                move_uploaded_file($file['tmp_name'], "$folder/$filename");
            }
            return $filename;
        }

        public function details($user_id){
            $user = $this->userModel->getUser($user_id);

           
                $this->view('User/details',$user);
            
        }

        public function update($user_id){
            $user = $this->userModel->getUser($user_id);
            if(!isset($_POST['update'])){
                $this->view('User/updateUser',$user);
            }
            else{
                $filename= $this->imageUpload();
                $data=[
                    'name' => trim($_POST['name']),
                    'city' => trim($_POST['city']),
                    'phone' => trim($_POST['phone']),
                    'picture' => $filename,
                    'ID' => $user_id
                ];
                if($this->userModel->updateUser($data)){
                    echo 'Please wait we are upating the user for you!';
                    //header('Location: /MVC/User/getUsers');
                    echo '<meta http-equiv="Refresh" content="2; url=/MVC/User/getUsers">';
                }
                
            }
        }

        //set if the user want their wishlist to be displayed in profile or not
        public function updateShowWishlist(){
            //call function getUser and get current user information
            $user = $this->userModel->getUser($_SESSION['user_id']);
            //if show_wishlist is set to 1(visible), set show_wishlist to 0 in the data array 
            //and pass it to updateUserShowWishlist function
            if($user->show_wishlist==1){
                $data=[
                    'show_wishlist' => 0,
                    'user_id' => $user->user_id
                ];
                $this->userModel->updateUserShowWishlist($data);
            }
            else{
                //else, set show_wishlist to 1 in the data array and and update it
                $data=[
                    'show_wishlist' => 1,
                    'user_id' => $user->user_id
                ];
                $this->userModel->updateUserShowWishlist($data);
            }
                //go back to user settings
                $this->viewUserSettings($data['user_id']);
        }

        //set if the user want their game owned to be displayed in profile or not
        public function updateShowGameOwned(){
            //call function getUser and get current user information
            $user = $this->userModel->getUser($_SESSION['user_id']);
            //if show_game is set to 1(visible), set show_game to 0 in the data array 
            //and pass it to updateUserShowGame function
            if($user->show_game==1){
                $data=[
                    'show_game' => 0,
                    'user_id' => $user->user_id
                ];
                $this->userModel->updateUserShowGame($data);
            }
            else{
                //else, set show_game to 1 in the data array and update it
                $data=[
                    'show_game' => 1,
                    'user_id' => $user->user_id
                ];
                $this->userModel->updateUserShowGame($data);
            }
                //go back to settings
                $this->viewUserSettings($data['user_id']);
        }

        public function updatePassword(){
            //get current user information
            $user = $this->userModel->getUser($_SESSION['user_id']);
            //if the 2 password field are identical
            if($_POST['changePassword'] == $_POST['changePasswordReType']){
                //store data into data array
                $data = [
                    'user_id' => $_SESSION['user_id'],
                    'pass' => $_POST['changePassword'],
                    'pass_verify' => $_POST['changePasswordReType'],
                    'password_hash' => password_hash($_POST['changePassword'], PASSWORD_DEFAULT),
                    'password_error' => '',
                    'password_match_error' => '', 
                    'password_len_error' => '',
                    'msg' => '',
                ];
                //if data is validated
                if($this->validateUpdatedPasswordData($data)){
                    if($this->userModel->updateUserPassword($data)){
                        //loading screen that inform the user that the password will change
                        echo '
                        <div class="text-center">
                        <div class="spinner-border" role="status">
                          <span class="sr-only">Please wait while we change your password '.trim($_SESSION["user_username"]).'</span>
                        </div>
                      </div>';
                        //header("Refresh: 2; URL=/MVC/User/displayUserProfile/$user_id");
                        echo '<meta http-equiv="Refresh" content="3; url=/MVC/User/viewUserSettings/'.$_SESSION['user_id'].'">';
                 }
               } 
            }          
        }

        //delete user with specified user_id
        public function delete($user_id){
            $data=[
                'user_id' => $user_id
            ];
            if($this->userModel->delete($data)){
                echo 'Please wait we are deleting the user for you!';
                //header('Location: /MVC/User/getUsers');
            }

        }

            public function validateUpdatedPasswordData($data){
        if(strlen($data['pass']) < 6){
            $data['password_len_error'] = 'Password can not be less than 6 characters';
        }
        if($data['pass'] != $data['pass_verify']){
            $data['password_match_error'] = 'Password does not match';
        }
        //if everything is empty, then it means everything is alright
        if(empty($data['password_error']) && empty($data['password_len_error']) && empty($data['password_match_error'])){
            return true;
        }else{
            echo "Incorrect";
        }
    }

    }

?>