<?php

    class purchaseModel{
        public function __construct(){
            $this->db = new Model;
        }

        //get all purchases made
        public function getPurchases(){
            $this->db->query("SELECT * FROM purchase");
            return $this->db->getResultSet();
        }

        //get all the purchases of a specific user
        public function getPurchase($user_id){
            //get all the purchase with a specific user_id and with a purchase_date
            $this->db->query("SELECT * FROM purchase WHERE user_id = :user_id AND purchase_date IS NOT NULL");
            $this->db->bind(':user_id',$user_id);
            return $this->db->getResultSet();
        }

        //get all the purchases of a specific user
        public function getPurchaseByGame($game_id){
            //get all the purchase with a specific user_id and with a purchase_date
            $this->db->query("SELECT * FROM purchase WHERE game_id = :game_id");
            $this->db->bind(':game_id',$game_id);
            return $this->db->getResultSet();
        }

        //get what in the cart of the user currently
        public function getCart($user_id){
            //get all the purchase with a specific user_id and with no purchase_date(since if there is no date, it mean they didn't checkout)
            $this->db->query("SELECT * FROM purchase WHERE user_id = :user_id AND purchase_date IS NULL");
            $this->db->bind(':user_id',$user_id);
            return $this->db->getResultSet();
        }

        //get what in the cart of the user currently
        public function getCartByGame($user_id, $game_id){
            //get all the purchase with a specific user_id and with no purchase_date(since if there is no date, it mean they didn't checkout)
            $this->db->query("SELECT * FROM purchase WHERE user_id = :user_id AND game_id = :game_id AND purchase_date IS NULL");
            $this->db->bind(':user_id',$user_id);
            $this->db->bind(':game_id',$game_id);
            return $this->db->getSingle();
        }

        //get what in the cart of the user currently
        public function getOrderNo($user_id){
            //get all the purchase with a specific user_id and with no purchase_date(since if there is no date, it mean they didn't checkout)
            $this->db->query("SELECT DISTINCT order_no FROM purchase WHERE user_id = :user_id AND purchase_date IS NOT NULL");
            $this->db->bind(':user_id',$user_id);
            return $this->db->getResultSet();
        }

        public function getAllPurchaseFromUser($user_id){
            $this->db->query("SELECT * FROM purchase WHERE user_id = :user_id");
            $this->db->bind(':user_id',$user_id);
            return $this->db->getResultSet();
        }

        public function getOrderDetails($order_no){
            //get all the purchase with a specific user_id and with no purchase_date(since if there is no date, it mean they didn't checkout)
            $this->db->query("SELECT * FROM purchase WHERE order_no = :order_no");
            $this->db->bind(':order_no',$order_no);
            return $this->db->getResultSet();
        }

        public function getOrderTotal($order_no){
            //get all the purchase with a specific user_id and with no purchase_date(since if there is no date, it mean they didn't checkout)
            $this->db->query("SELECT DISTINCT total FROM purchase WHERE order_no = :order_no");
            $this->db->bind(':order_no',$order_no);
            return $this->db->getSingle();
        }

        //add a purchase to the database
        public function createPurchase($data){
            $this->db->query("INSERT INTO purchase (game_id, user_id, purchase_date, price, quantity) values (:game_id, :user_id, :purchase_date, :price, :quantity)");
            $this->db->bind('game_id',$data['game_id']);
            $this->db->bind('user_id',$data['user_id']);
            $this->db->bind('purchase_date', NULL);
            $this->db->bind(':price',$data['price']);
            $this->db->bind(':quantity', 1);
            

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }

        //update purchase with specific purchase_id
        public function updatePurchase($data){
            $this->db->query("UPDATE purchase SET purchase_date=:purchase_date, quantity=:quantity  WHERE purchase_id=:purchase_id");
            $this->db->bind('purchase_date', $data['purchase_date']);
            $this->db->bind('purchase_id',$data['purchase_id']);
            $this->db->bind(':quantity',$data['quantity']);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }

                //update purchase with specific purchase_id
        public function updatePurchaseDate($data){
            $this->db->query("UPDATE purchase SET purchase_date=:purchase_date, order_no=:order_no, total=:total  WHERE purchase_id=:purchase_id");
            $this->db->bind('purchase_date', $data['purchase_date']);
            $this->db->bind('order_no', $data['order_no']);
            $this->db->bind('total', $data['total']);
            $this->db->bind('purchase_id',$data['purchase_id']);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }

                //update purchase with specific purchase_id
        public function updatePurchaseQuantity($data){
            $this->db->query("UPDATE purchase SET quantity=:quantity  WHERE game_id=:game_id AND user_id=:user_id");
            $this->db->bind('game_id',$data['game_id']);
            $this->db->bind('user_id',$data['user_id']);
            $this->db->bind(':quantity',$data['quantity']);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }

        //delete a purchase
        public function delete($data){
            $this->db->query("DELETE FROM purchase WHERE purchase_id=:purchase_id");
            $this->db->bind('purchase_id',$data['purchase_id']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }
    }

?>