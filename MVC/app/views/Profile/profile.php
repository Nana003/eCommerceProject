<?php require APPROOT . '/views/includes/header.php'; 
?>
<?php
	$this->userModel = $this->model('userModel');
    $user = $this->userModel->getUserProfileInfo($data['user']);
    echo "<img style='width: 300px' src='".URLROOT.'/public/img/'.$user->filename."'/>";
    echo "<h5 class='bold'>$user->username</h5>";
    echo "<a href='/MVC/Wishlist/viewProfileWishlist/$user->user_id' class='btn btn-light btn-border'>View Wishlist</a><br>";
    echo "<a href='/MVC/Purchase/viewProfilePurchase/$user->user_id' class='btn btn-light btn-border'>View Game</a><br>";
    var_dump($user->user_id);
?>
<?php require APPROOT . '/views/includes/footer.php'; ?>