<?php

    class userModel{
        public function __construct(){
            $this->db = new Model;
        }

        //get all user
        public function getUsers(){
            $this->db->query("SELECT * FROM user");
            return $this->db->getResultSet();
        }

        //get user with specific user_id
        public function getUser($user_id){
            $this->db->query("SELECT * FROM user WHERE user_id = :user_id");
            $this->db->bind(':user_id',$user_id);
            return $this->db->getSingle();
        }

        //get user with a specific username
        public function getUserByUsername($username){
            $this->db->query("SELECT * FROM user WHERE username = :username");
            $this->db->bind(':username',$username);
            return $this->db->getSingle();
        }

        //get all the information necessary for profile(we don't need password or role for profile)
        public function getUserProfileInfo($user_id){
            $this->db->query("SELECT user_id, username, show_game, show_wishlist, filename FROM user WHERE user_id = :user_id");
            $this->db->bind(':user_id', $user_id);
            return $this->db->getSingle();
        }

        //create a user
        public function createUser($data){
            $this->db->query("INSERT INTO user (username, password_hash, role, email) values (:username,:password_hash, :role, :email)");
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':password_hash', $data['password_hash']);
            $this->db->bind(':role', $data['role']);
            $this->db->bind(':email',$data['email']);
            

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }

        //update user information
        public function updateUser($data){
            $this->db->query("UPDATE user SET username=:username, email=:email, password_hash=:password_hash, show_game=:show_game, show_wishlist=:show_wishlist, filename=:filename WHERE user_id=:user_id");
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':password_hash', $data['password_hash']);
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':show_game',$data['show_game']);
            $this->db->bind(':show_wishlist',$data['show_wishlist']);
            $this->db->bind('user_id',$data['user_id']);
            $this->db->bind('filename',$data['filename']);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //update user password
        public function updateUserPassword($data){
            $this->db->query("UPDATE user SET password_hash=:password_hash WHERE user_id=:user_id");
            $this->db->bind(':password_hash', $data['password_hash']);
            $this->db->bind('user_id',$data['user_id']);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //update if the user want their wishlist to be seen or not
        public function updateUserShowWishlist($data){
            $this->db->query("UPDATE user SET show_wishlist=:show_wishlist WHERE user_id=:user_id");
            $this->db->bind(':show_wishlist',$data['show_wishlist']);
            $this->db->bind('user_id',$data['user_id']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //update if the user want their owned games to be seen or not
        public function updateUserShowGame($data){
            $this->db->query("UPDATE user SET show_game=:show_game WHERE user_id=:user_id");
            $this->db->bind(':show_game',$data['show_game']);
            $this->db->bind('user_id',$data['user_id']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //delete user
        public function delete($data){
            $this->db->query("DELETE FROM user WHERE user_id=:user_id");
            $this->db->bind('user_id',$data['user_id']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }
    }

?>