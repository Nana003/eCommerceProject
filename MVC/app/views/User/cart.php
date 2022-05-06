<?php require APPROOT . '/views/includes/header.php'; 
?>
    <h1>Cart</h1>
    
    <table  class="table table-bordered">
        <tr>
            <td></td>
            <td>Game</td>
            <td>Price</td>
            <td>Quantity</td>
            <td></td>
        </tr>
        <?php
            $total = 0;
            $this->gameModel = $this->model('gameModel');
            $this->purchaseModel = $this->model('purchaseModel');
            $purchases = $this->purchaseModel->getCart($_SESSION['user_id']);
            foreach($purchases as $cartItem){
                $game = $this->gameModel->getGame($cartItem->game_id);
                echo"<tr>";
                echo "<td style='width:150px'><img style='width: 100px' src='".URLROOT.'/public/img/'.$game->filename."'/></td>";
                echo"<td style='width:340px'>$game->game_title</td>";
                echo"<td style='width:150px'>$cartItem->price</td>";
                echo"<td style='width:150px'>$cartItem->quantity</td>";
                echo"<td style='width:150px'><center><a href='/MVC/Purchase/delete/$cartItem->purchase_id' class='btn btn-danger'> Delete</a></center></td>";
                echo"</tr>";
                $total += $cartItem->price * $cartItem->quantity;
            }
                        var_dump($data);
        ?>
        <tr><th>Total</th><th><?=$total ?></th><th></th><th></th></tr>
    </table>
    <a style='width:100px' href='/MVC/Purchase/checkout' class='btn btn-primary'>Checkout</a><br><br>



   
<?php require APPROOT . '/views/includes/footer.php'; ?>