<?php

    class gameModel{
        public function __construct(){
            $this->db = new Model;
        }

        //get all games
        public function getGames(){
            $this->db->query("SELECT * FROM game");
            return $this->db->getResultSet();
        }

        //get a game with a specific id
        public function getGame($game_id){
            $this->db->query("SELECT * FROM game WHERE game_id = :game_id");
            $this->db->bind(':game_id',$game_id);
            return $this->db->getSingle();
        }

        //get a game with a specific title
        public function getGameByTitle($game_title){
            $this->db->query("SELECT * FROM game WHERE game_title = :game_title");
            $this->db->bind(':game_title',$game_title);
            return $this->db->getSingle();
        }

        //add a game to the database
        public function createGame($data){
            $this->db->query("INSERT INTO game (game_title, game_description, genre, price, release_date, filename) values (:game_title, :game_description, :genre, :price, :release_date, :filename)");
            $this->db->bind(':game_title', $data['game_title']);
            $this->db->bind(':game_description', $data['game_description']);
            $this->db->bind(':genre', $data['genre']);
            $this->db->bind(':price',$data['price']);
            $this->db->bind('release_date',$data['release_date']);
            $this->db->bind(':filename',$data['filename']);
            

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }

        //update a game with a specific game_id
        public function updateGame($data){
            $this->db->query("UPDATE game SET game_title=:game_title, game_description=:game_description, genre=:genre, price=:price, release_date=:release_date, filename=:filename WHERE game_id = :game_id");
            $this->db->bind(':game_title', $data['game_title']);
            $this->db->bind(':game_description', $data['game_description']);
            $this->db->bind(':genre', $data['genre']);
            $this->db->bind(':price',$data['price']);
            $this->db->bind('release_date',$data['release_date']);
            $this->db->bind(':filename',$data['filename']);
            $this->db->bind('game_id',$data['game_id']);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }

        //search games by title.
        public function searchGame($search_query) {
            //select all the games where the search_query is similar to a game_title
        $this->db->query("SELECT * FROM game WHERE game_title LIKE :search_query");
        $this->db->bind(':search_query', '%' . $search_query . '%');
        return $this->db->getResultSet();
        }

        //delete a game with a specific game_id
        public function delete($data){
            $this->db->query("DELETE FROM game WHERE game_id = :game_id");
            $this->db->bind('game_id',$data['game_id']);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }

        }
    }

?>