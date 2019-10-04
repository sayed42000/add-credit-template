<?php 
  include 'inc/header.php';
  include 'classes/Login.php';


  $db=new Login();

  if(isset($_POST['login'])){
      $email=$_POST['email'];
      $password=$_POST['password'];


      $login=$db->signin($email,$password);


  }

?>
<body class="login">
    <div class="container">
        <center>
                    <div class="card" style="width: 38rem;">
                        <img src="img/card.jpg" class="card-img-top card-image" alt="card image">
                        <div class="card-body">
                            <h5 class="card-title">Log In Or!!  <a href="signup.php" class="card-title btn btn-primary">Register Here</a></h5>
                            <span class="bg-red text-primary">
                                <?php 
                                if(isset($login)){
                                    echo $login;
                                }
                                ?>
                            </span>
                            <form method="POST">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="staticEmail" name="email" placeholder="email@example.com" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="submit" class="btn btn-primary" name="login" value="Log In">  
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
        </center>
    </div>
<?php 
  include 'inc/footer.php';
?>