<?php require APPROOT . '/views/includes/header.php'; 
?>

    <h1>User Settings</h1>
    <form action="/MVC/User/updatePassword" method="POST">
              <div class="form-group">
                <label for="changePassword">Password</label>
                <input type="password" class="form-control width-form <?php echo (!empty($data['password_len_error'])) ? 'is-invalid' : ''; ?>" id="changePassword" name="changePassword" placeholder="Password">
                <span class="invalid-feedback"><?php echo $data['password_len_error']; ?> </span>
                </div>
                <div class="form-group">
                    <label for="changePasswordReType"> Re-Enter your Password</label>
                    <input type="password" class="form-control width-form <?php echo (!empty($data['password_match_error'])) ? 'is-invalid' : ''; ?>" id="changePasswordReType" name="changePasswordReType" placeholder="Re-Type Password">
                    <span class="invalid-feedback"><?php echo $data['password_match_error']; ?> </span>
                </div>
                <button type="submit" class="btn btn-primary margin-5px">Change Password</button>
        </form>
        <?php
            $this->userModel = $this->model('userModel');
            $user = $this->userModel->getUser($data['user_id']);
            if($user->show_wishlist==1){
                echo "<a style='width: 250px; margin: 10px' href='/User/updateShowWishlist' class='btn btn-secondary'>Make Wishlist Private</a><br>";
                }else{
                    echo "<a style='width: 250px; margin: 10px' href='/User/updateShowWishlist' class='btn btn-secondary'>Make Wishlist Public</a><br>";
                }
            if($user->show_game==1){
                echo "<a style='width: 250px; margin: 10px' href='/User/updateShowGameOwned' class='btn btn-secondary'>Make Game Purchased Private</a><br>";
                }else{
                    echo "<a style='width: 250px; margin: 10px' href='/User/updateShowGameOwned' class='btn btn-secondary'>Make Game Purchased Public</a><br>";
                }
            ?>


   
<?php require APPROOT . '/views/includes/footer.php'; ?>