<?php require APPROOT . '/views/includes/header.php'; 
?>
<?php
	$this->userModel = $this->model('userModel');
	$this->wishlistModel = $this->model('wishlistModel');
	$this->gameModel = $this->model('gameModel');
    $user = $this->userModel->getUserProfileInfo($data['user_id']);
    $wishlist = $this->wishlistModel->getUserWishlist($data['user_id']);
    echo "<img style='width: 300px' src='".URLROOT.'/public/img/'.$user->filename."'/>";
    echo "<h5 class='bold'>$user->username</h5>";
    echo "<a href='/MVC/Wishlist/viewProfileWishlist/$user->user_id' class='btn btn-light btn-border'>View Wishlist</a><br>";
    echo "<a href='/MVC/Purchase/viewProfilePurchase/$user->user_id' class='btn btn-light btn-border'>View Game</a><br>";
    echo "<h1>View $user->username Wishlist</h1>";
    echo "<table  class='table table-bordered'>";
    echo "<tr'>";
    echo "<td></td>";
    echo "<td>Game Title</td>";
    echo "<td>Price</td>";
    echo "<td></td>";
    echo "</tr'>";
                foreach($wishlist as $wishlistItem){
                $game = $this->gameModel->getGame($wishlistItem->game_id);
                echo"<tr>";
                echo "<td><img style='width: 100px' src='".URLROOT.'/public/img/'.$game->filename."'/></td>";
                echo"<td>$game->game_title</td>";
                echo"<td style='width:150px'>$wishlistItem->price</td>";
                echo"<td style='width:150px'><center><a href='/MVC/Game/viewGameDetails/$game->game_id' class='btn btn-secondary'> Details</a></center></td>";
                echo"</tr>";
            }
    echo "</table'>";
?>
<?php require APPROOT . '/views/includes/footer.php'; ?>