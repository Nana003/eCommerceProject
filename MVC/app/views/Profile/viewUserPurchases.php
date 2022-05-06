<?php require APPROOT . '/views/includes/header.php'; 
?>
<?php
	$this->userModel = $this->model('userModel');
	$this->purchaseModel = $this->model('purchaseModel');
	$this->gameModel = $this->model('gameModel');
    $user = $this->userModel->getUserProfileInfo($data['user_id']);
    $purchases = $this->purchaseModel->getPurchase($data['user_id']);
    echo "<img style='width: 300px' src='".URLROOT.'/public/img/'.$user->filename."'/>";
    echo "<h5 class='bold'>$user->username</h5>";
    echo "<a href='/MVC/Wishlist/viewProfileWishlist/$user->user_id' class='btn btn-light btn-border'>View Wishlist</a><br>";
    echo "<a href='/MVC/Purchase/viewProfilePurchase/$user->user_id' class='btn btn-light btn-border'>View Game</a><br>";
    echo "<h1>View $user->username Purchased Games</h1>";
    echo "<table  class='table table-bordered'>";
    echo "<tr'>";
    echo "<td></td>";
    echo "<td>Game Title</td>";
    echo "<td>Price</td>";
    echo "<td>Date of Purchase</td>";
    echo "<td></td>";
    echo "</tr'>";
                foreach($purchases as $cartItem){
                $game = $this->gameModel->getGame($cartItem->game_id);
                echo"<tr>";
                echo "<td style='width:100px'><img style='width: 100px' src='".URLROOT.'/public/img/'.$game->filename."'/></td>";
                echo"<td style='width:300px'>$game->game_title</td>";
                echo"<td style='width:150px'>$cartItem->price</td>";
                echo"<td style='width:150px'>$cartItem->purchase_date</td>";
                echo"<td style='width:150px'><center><a href='/MVC/Game/viewGameDetails/$game->game_id' class='btn btn-secondary'> Details</a></center></td>";
                echo"</tr>";
            }
    echo "</table'>";
?>
<?php require APPROOT . '/views/includes/footer.php'; ?>