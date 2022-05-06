<?php require APPROOT . '/views/includes/header.php'; 
?>
    <h1> Order History</h1>
    <div class="container-sm">
        <?php
            $total = 0;
            $this->gameModel = $this->model('gameModel');
            $this->purchaseModel = $this->model('purchaseModel');
            $purchases = $this->purchaseModel->getPurchase($_SESSION['user_id']);
            $purchases = $this->purchaseModel->getPurchase($_SESSION['user_id']);
            $purchaseOrderNo = $this->purchaseModel->getOrderNo($_SESSION['user_id']);
            foreach($purchaseOrderNo as $nbOfPurchase){
                $purchaseOrderDetails = $this->purchaseModel->getOrderDetails($nbOfPurchase->order_no);
                $purchaseOrderTotal = $this->purchaseModel->getOrderTotal($nbOfPurchase->order_no);
                //$game = $this->gameModel->getGame($item->game_id);
                echo "
                <h3>Order#: $nbOfPurchase->order_no</h3>
                <table class='table'>
                    <thead class='table-dark'>
                      <tr>
                        <td></td>
                        <td>Game</td>
                        <td>Price</td>
                        <td>Date of Purchase</td>
                        <td>Quantity</td>
                      </tr>
                    </thead>    
                    <tbody>";
                foreach($purchaseOrderDetails as $item){
                    $game = $this->gameModel->getGame($item->game_id);
                echo "
                <tr>
                <td style='width:150px'><img style='width: 100px' src='".URLROOT.'/public/img/'.$game->filename."'/></td>
                <td style='width:340px'>$game->game_title</td>
                <td style='width:150px'>$item->price</td>
                <td style='width:150px'>$item->purchase_date</td>
                <td style='width:150px'>$item->quantity</td>
                </tr>
                ";
            }
            echo "
            <tr>
                <th>Total</th>
                <td>$purchaseOrderTotal->total</td>
            </tr>
                    </tbody>
                </table>
                <br><br>
                ";
        }
        ?>
    </div>
<?php require APPROOT . '/views/includes/footer.php'; ?>