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
    <h2>get Users</h2>
    
    <table  class="table table-bordered">
        <tr>
            <td>Image</td>
            <td>User Id</td>
            <td>Username</td>
            <td>Email</td>
            <td>Role</td>
            <td>Show game</td>
            <td>Show wishlist</td>
            <td colspan="3" class="text-center"> Actions</td>
        </tr>
        <?php
            foreach($data["users"] as $user){
                echo"<tr>";
                echo "<td style='width:150px'><img style='width: 100px' src='".URLROOT.'/public/img/'.$user->filename."'/></td>";
                echo"<td>$user->user_id</td>";
                echo"<td>$user->username</td>";
                echo"<td>$user->email</td>";
                echo"<td>$user->role</td>";
                echo"<td>$user->show_game</td>";
                echo"<td>$user->show_wishlist</td>";
                echo"<td>
                <a href='/MVC/Admin/details/$user->user_id'> Details</a>
                </td>";
                echo"<td>
                <a href='/MVC/Admin/update/$user->user_id'> Update</a>
                </td>";
                echo"<td>
                <a href='/MVC/Admin/delete/$user->user_id'> Delete</a>
                </td>";
                echo"</tr>";

            }
        ?>
    </table>


   
<?php require APPROOT . '/views/includes/footer.php'; ?>