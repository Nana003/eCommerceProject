<?php

    class Purchase extends Controller{
        public function __construct(){
            $this->purchaseModel = $this->model('purchaseModel');
            if(!isLoggedIn()){
                header('Location: /MVC/Login');
            }
        }

        public function index(){
            $this->view('User/index');
        }

        public function getPurchase($user_id){
            //call function getPurchase and get the purchases of the specified user
            $purchases = $this->purchaseModel->getPurchase($user_id);
            //store data into array
            $data = [
                "purchases" => $purchases
            ];
            //go to view and pass array
            $this->view('User/getUsers',$data);
        }

        public function viewCart(){
            //go to cart view
            $this->view('User/cart');
        }

        //add a game to cart
        public function addToCart($game_id){
                //get game model
                $games = $this->gameModel = $this->model('gameModel');
                //call function getGame to get the game information
                $game = $this->gameModel->getGame($game_id);
                //get all the item in cart from the user
                $carts = $this->purchaseModel->getCartByGame($_SESSION['user_id'], $game_id);
                //if the current game_id is the same as the specified game_id
                if($carts){
                //store the info in data array
                $data=[
                    'game_id' => $game_id,
                    'user_id' => $_SESSION['user_id'],
                    'quantity' => $carts->quantity + 1,
                ];
                //update the quantity
                $this->purchaseModel->updatePurchaseQuantity($data);
                }else{
                $data=[
                    'game_id' => $game_id,
                    'user_id' => $_SESSION['user_id'],
                    'price' => $game->price,
                ];
             //call function createPurchase to add a purchase to database
            $this->purchaseModel->createPurchase($data);
                }
            //go to User/cart
            $this->view('User/cart');
        }

        //check if the user want their purchase to be displayed or not
        public function viewProfilePurchase($user_id) {
            //create user model
            $users = $this->userModel = $this->model('userModel');
            //call function getUserProfileInfo to get all the information about user profile
            $user = $this->userModel->getUserProfileInfo($user_id);
            //store user_id into array
            $data=[
                    'user_id' => $user->user_id
                ];
            //if show_game is set to one(visible) in database
            if($user->show_game == 1) {
                //user can see other user owner game
                $this->view('Profile/viewUserPurchases', $data);
            }else {
                //warning that the user don't want to show their owned game and redirect back to profile
                echo '<div class="alert alert-success">This user does not wish to display their owned game list</div>';
                header("Refresh: 2; URL=/MVC/User/displayUserProfile/$user_id");
            }
        }

        public function viewOrderHistory(){
            //go to order history view
            $this->view('User/orderHistory');
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

        //allow the user to checkout
        public function checkout(){
            $orderNo = mt_rand();
            $total = 0;
            //get every item in the cart with method getCart from purchase model
            $purchases = $this->purchaseModel->getCart($_SESSION['user_id']);
            foreach($purchases as $purchase){
            $total += $purchase->price * $purchase->quantity;
        }
            //for each item in the cart
            foreach($purchases as $purchase){
                //store this data in data array
                $data=[
                    //purchase_date become the current date
                    'purchase_date' => date("Y/m/d"),
                    'order_no' => $orderNo,
                    'total' => $total,
                    //purchase_id become the purchase_id of the current item in the array
                    'purchase_id' => $purchase->purchase_id
                ];
                //update the purchase table
                $this->purchaseModel->updatePurchaseDate($data);
            }
            //go back to cart
            //MAYBE ADD A CHECKOUT PAGE
            $this->view('User/cart',$data);
        }

        public function delete($purchase_id){
            //store purchase_id in $data array
            $data=[
                'purchase_id' => $purchase_id
            ];
            //delete the row that have the specified purchase_id
            if($this->purchaseModel->delete($data)){
                //go back to cart
                $this->view('User/cart',$data);
            }

        }

    }

?>