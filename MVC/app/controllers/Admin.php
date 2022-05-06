<?php

    class Admin extends Controller{
        public function __construct(){
            $this->userModel = $this->model('userModel');
            if(!isLoggedIn()){
                header('Location: /MVC/Login');
            }
        }

        public function index(){
            $this->view('Admin/index');
        }

        public function getUsers(){
            $users = $this->userModel->getUsers();
            $data = [
                "users" => $users
            ];
            $this->view('Admin/getUsers',$data);
        }

        public function getGames(){
            $games = $this->gameModel = $this->model('gameModel');
            $game = $this->gameModel->getGames();
            $data = [
                "games" => $game
            ];
            $this->view('Admin/getGames',$data);
        }

        public function createUser(){
            if(!isset($_POST['register'])){
                $this->view('Admin/createUser');
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
                    header('Location: /MVC/Admin/getUsers');
                    //echo '<meta http-equiv="Refresh" content="2; url=/MVC/User/getUsers">';
                }

            }
        }

        public function createGame(){
            $games = $this->gameModel = $this->model('gameModel');
            if(!isset($_POST['register'])){
                $this->view('Admin/createGame');
            }
            else{
                $filename= $this->imageUpload();
                $data=[
                    'game_title' => trim($_POST['title']),
                    'game_description' => trim($_POST['description']),
                    'genre' => trim($_POST['genre']),
                    'price' => trim($_POST['price']),
                    'release_date' => trim($_POST['releaseDate']),
                    'filename' => $filename
                ];
               
                if($this->gameModel->createGame($data)){
                    echo 'Please wait we are creating the game for you!';
                    header('Location: /MVC/Admin/getGames');
                    var_dump($filename);
                    //echo '<meta http-equiv="Refresh" content="2; url=/MVC/User/getUsers">';
                }

            }
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

           
                $this->view('Admin/details',$user);
            
        }

        public function update($user_id){
            $user = $this->userModel->getUser($user_id);
            if(!isset($_POST['update'])){
                $this->view('Admin/updateUser',$user);
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
                    //header('Location: /MVC/Admin/getUsers');
                    echo '<meta http-equiv="Refresh" content="2; url=/MVC/Admin/getUsers">';
                }
                
            }
        }

        //delete user with specified user_id
        public function deleteGame($game_id){
            $games = $this->gameModel = $this->model('gameModel');
            $data=[
                'game_id' => $game_id
            ];
            if($this->gameModel->delete($data)){
                echo 'Please wait we are deleting the game for you!';
                 echo '<meta http-equiv="Refresh" content="2; url=/MVC/Admin/getGames">';
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