<?php

    class Wishlist extends Controller{
        public function __construct(){
            $this->wishlistModel = $this->model('wishlistModel');
            if(!isLoggedIn()){
                header('Location: /MVC/Login');
            }
        }

        public function index(){
            $this->view('User/wishlist');
        }

        public function getWishlist($user_id){
            $wishlist = $this->wishlistModel->getUserWishlist($user_id);
            $data = [
                "wishlist" => $wishlist
            ];
            $this->view('User/getUsers',$data);
        }

        public function viewWishlist(){
            //go to cart view
            $this->view('User/wishlist');
        }

        public function addToWishlist($game_id){
                $games = $this->gameModel = $this->model('gameModel');
                $game = $this->gameModel->getGame($game_id);
                $data=[
                    'game_id' => $game_id,
                    'user_id' => $_SESSION['user_id'],
                    'price' => $game->price,
                ];
                  $this->wishlistModel->createWishlist($data); 
            $this->view('User/wishlist');
        }

        public function viewProfileWishlist($user_id) {
            $users = $this->userModel = $this->model('userModel');
            $user = $this->userModel->getUserProfileInfo($user_id);
            $data=[
                    'user_id' => $user->user_id
                ];
            if($user->show_wishlist == 1) {
                $this->view('Profile/viewUserWishlist', $data);
            }else {
                echo '<div class="alert alert-success">This user does not wish to display their wishlist</div>';
                header("Refresh: 2; URL=/MVC/User/displayUserProfile/$user_id");
            }
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

        public function details($user_id){
            $user = $this->userModel->getUser($user_id);
                $this->view('User/details',$user);
            
        }

        public function delete($wish_id){
            //store wish_id in $data array
            $data=[
                'wish_id' => $wish_id
            ];
            //delete the row that have the specified wish_id
            if($this->wishlistModel->delete($data)){
                //go back to cart
                $this->view('User/wishlist',$data);
            }

        }

    }

?>