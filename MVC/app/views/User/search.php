<?php require APPROOT . '/views/includes/header.php'; 
?>
<h1>Games</h1>
<form action="/MVC/Game/searchGame" class="center" method="POST">
            <input style ="width: 500px;" name="searchGame" type="search">
            <input name="" name="action" id="" type="submit"  value="Search"></input type="" name="">
        </form>
<?php
            foreach($data['search_query'] as $game){
                echo "<div class='card' style='width: 19rem;'>";
                echo "<img class='card-img-top' src='".URLROOT.'/public/img/'.$game->filename."' alt='Card image cap' style='width:302px; height: 302px;'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title bold'> $game->game_title</h5>";
                echo "<p class='card-text'>Price: $game->price</p>";
                if (isLoggedIn()) {
                    echo "<a href='/MVC/Purchase/addToCart/$game->game_id' class='btn btn-primary'>Add To Cart</a><br>";
                    echo "<a href='/MVC/Wishlist/addToWishlist/$game->game_id' class='btn btn-success'>Add To Wishlist</a><br>";
                    echo "<a href='/MVC/Game/viewGameDetails/$game->game_id' class='btn btn-secondary'>Details</a>";
                } 
                echo "</div>";
                echo "</div>";
            }
        ?>
<?php require APPROOT . '/views/includes/footer.php'; ?>