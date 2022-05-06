<?php require APPROOT . '/views/includes/header.php'; 
?>
	<?php 
	$this->gameModel = $this->model('gameModel');
	$game = $this->gameModel->getGame($data['game_id']);
		echo "<div class='container'>";
		echo "<div class='row border-container'>";
		echo "<div class='col-sm align-self-center'>";
		echo "<img class='center-image' style='width: 500px' src='".URLROOT.'/public/img/'.$game->filename."'/>";
		echo "<h2 class='center'>$game->game_title</h2>";
		echo "<p class='center'><b>Description:</b> $game->game_description</p>";
		echo "<p class='center'><b>Genre:</b> $game->genre</p>";
		echo "<p class='center'><b>Release date:</b> $game->release_date</p>";
		echo "<p class='center'><b>Price:</b> $game->price</p>";
		if (isLoggedIn()) {
		echo "<a href='/MVC/Purchase/addToCart/$game->game_id' class='btn btn-primary'>Add To Cart</a><br>";
        echo "<a href='/MVC/Wishlist/addToWishlist/$game->game_id' class='btn btn-success'>Add To Wishlist</a><br>";
    }
		echo "</div>";
		echo "</div>";
		echo "</div>";
	?>
<?php require APPROOT . '/views/includes/footer.php'; ?>