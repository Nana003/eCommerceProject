<?php

    class Game extends Controller{
        public function __construct(){
            $this->gameModel = $this->model('gameModel');
            if(!isLoggedIn()){
                header('Location: /MVC/Login');
            }
        }

        public function index(){
            $this->view('User/index');
        }

        //view game details
        public function viewGameDetails($game_id){
            //store game_id to data array
            $data = [
                "game_id" => $game_id
            ];
            //go to view and pass the array to Game/details view
            $this->view('Game/details',$data);
        }

        public function addGame(){
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
               
                if($this->gameModel->createGame($data)){
                    echo 'Please wait we are creating the user for you!';
                    header('Location: /MVC/User/getUsers');
                    //echo '<meta http-equiv="Refresh" content="2; url=/MVC/User/getUsers">';
                }

            }
        }

        //search a game
        public function searchGame() {
        //call function searchGame from gameModel and get all the games similar to the search query
        $game = $this->gameModel->searchGame($_POST['searchGame']);
        //store the result
        $data = [
                "search_query" => $game
            ];
        // go to view and pass the array into User/search view
        $this->view('User/search', $data);
    }

        // public function imageUpload(){
        //     //default value for the picture
        //     $filename=false;
            
        //     //save the file that gets sent as a picture
        //     $file = $_FILES['picture'];
            
        //     $acceptedTypes = ['image/jpeg'=>'jpg',
        //         'image/gif'=>'gif',
        //         'image/png'=>'png'];
        //     //validate the file
            
        //     if(empty($file['tmp_name']))
        //         return false;

        //     $fileData = getimagesize($file['tmp_name']);

        //     if($fileData!=false && 
        //         in_array($fileData['mime'],array_keys($acceptedTypes))){

        //         //save the file to its permanent location
                    
        //         $folder = dirname(APPROOT).'/public/img';
        //         $filename = uniqid() . '.' . $acceptedTypes[$fileData['mime']];
        //         move_uploaded_file($file['tmp_name'], "$folder/$filename");
        //     }
        //     return $filename;
        // }

        public function delete($game_id){
            //store game_id in $data array
            $data=[
                'game_id' => $game_id
            ];
            //delete the row that have the specified game_id
            if($this->gameModel->delete($data)){
                //go back to cart
                $this->view('User/cart',$data);
            }
        }
    }
?>