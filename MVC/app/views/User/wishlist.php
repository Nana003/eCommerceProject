<?php require APPROOT . '/views/includes/header.php'; 
?>
    <h1>Wishlist</h1>
    
    <table  class="table table-bordered">
        <tr>
            <td></td>
            <td>Game</td>
            <td>Price</td>
            <td></td>
        </tr>
        <?php
            $this->gameModel = $this->model('gameModel');
            $this->wishlistModel = $this->model('wishlistModel');
            $wishlist = $this->wishlistModel->getUserWishlist($_SESSION['user_id']);
            foreach($wishlist as $wishlistItem){
                $game = $this->gameModel->getGame($wishlistItem->game_id);
                echo"<tr>";
                echo "<td style='width:150px'><img style='width: 100px' src='".URLROOT.'/public/img/'.$game->filename."'/></td>";
                echo"<td style='width:340px'>$game->game_title</td>";
                echo"<td style='width:150px'>$wishlistItem->price</td>";
                echo"<td style='width:150px'><center><a href='/MVC/Wishlist/delete/$wishlistItem->wish_id' class='btn btn-danger'> Delete</a></center></td>";
                echo"</tr>";
            }
        ?>
    </table>
<?php require APPROOT . '/views/includes/footer.php'; ?>