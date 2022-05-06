<?php require APPROOT . '/views/includes/header.php'; 
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
 

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/MVC/Admin/getUsers">Get Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/MVC/Admin/createUser">Create User</a>
      <li class="nav-item">
        <a class="nav-link" href="/MVC/Admin/createGame">Add a Game</a>
      <li class="nav-item">
        <a class="nav-link" href="/MVC/Admin/getGames">Get Games</a>
      </li>
</li>
     
    </ul>
   
  </div>
</nav>

    <h1>Admin Panel</h1>
    <h2>All Games</h2>
    
    <table  class="table table-bordered">
        <tr>
            <td>Image</td>
            <td>Game Id</td>
            <td>Title</td>
            <td colspan="3" class="text-center"> Actions</td>
        </tr>
        <?php
            foreach($data["games"] as $game){
                echo"<tr>";
                echo "<td style='width:150px'><img style='width: 100px' src='".URLROOT.'/public/img/'.$game->filename."'/></td>";
                echo"<td>$game->game_id</td>";
                echo"<td>$game->game_title</td>";
                echo"<td>
                <a href='/MVC/Admin/details/$game->game_id'> Details</a>
                </td>";
                echo"<td>
                <a href='/MVC/Admin/update/$game->game_id'> Update</a>
                </td>";
                echo"<td>
                <a href='/MVC/Admin/deleteGame/$game->game_id'> Delete</a>
                </td>";
                echo"</tr>";

            }
        ?>
    </table>


   
<?php require APPROOT . '/views/includes/footer.php'; ?>