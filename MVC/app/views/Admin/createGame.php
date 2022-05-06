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

    <h1>Create Games</h1>
    
    <form action='' method='post' enctype="multipart/form-data">

    <div class="form-group">
        <label for="titleinput">Title</label>
        <input name="title" type="text" class="form-control" id="titleinput" placeholder="Title">
    </div>
    <div class="form-group">
        <label for="descriptioninput">Description</label>
        <input name="description" type="text" class="form-control" id="descriptioninput" placeholder="Description">
    </div>
    <div class="form-group">
        <label for="genreinput">Genre</label>
        <input name="genre" type="text" class="form-control" id="genreinput" placeholder="Genre">
    </div>
    <div class="form-group">
        <label for="priceinput">Price</label>
        <input name="price" type="text" class="form-control" id="priceinput" placeholder="Price">
    </div>
    <div class="form-group">
        <label for="releaseDateinput">Release Date</label>
        <input name="releaseDate" type="text" class="form-control" id="releaseDateinput" placeholder="YYYY-MM-DD">
    </div>

    <div class="form-group">
        <label for="profileinput">Game picture</label>
        <input type='file' name='gamePicture' class='form-control' />
    </div>

    <button type="submit" name='register' class="btn btn-primary">Register</button>
    </form>

   
<?php require APPROOT . '/views/includes/footer.php'; ?>