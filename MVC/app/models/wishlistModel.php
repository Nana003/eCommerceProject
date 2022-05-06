<?php

    class wishlistModel{
        public function __construct(){
            $this->db = new Model;
        }
        public function getWishlist(){
            $this->db->query("SELECT * FROM wishlist");
            return $this->db->getResultSet();
        }

        //get specified user wishlist
        public function getUserWishlist($user_id){
            $this->db->query("SELECT * FROM wishlist WHERE user_id = :user_id");
            $this->db->bind(':user_id',$user_id);
            return $this->db->getResultSet();
        }

        //create a wishlist
        public function createWishlist($data){
            $this->db->query("INSERT INTO wishlist (game_id, user_id, price) values (:game_id, :user_id, :price)");
            $this->db->bind('user_id',$data['user_id']);
            $this->db->bind('game_id',$data['game_id']);
            $this->db->bind(':price',$data['price']);
            

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }

        //update a wishlist
        public function updateWishlist($data){
            $this->db->query("UPDATE wishlist SET price=:price WHERE wish_id=:wish_id");
            $this->db->bind(':price',$data['price']);
            $this->db->bind(':wish_id', $data['wish_id']);
            
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }

        //delete a wishlist
        public function delete($data){
            $this->db->query("DELETE FROM wishlist WHERE wish_id=:wish_id");
            $this->db->bind('wish_id',$data['wish_id']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }
    }

?>