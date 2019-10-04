<?php 
  include 'inc/header.php';
  include 'classes/Login.php';

  $db=new Login();

  if(isset($_POST['register'])){
      $username=$_POST['username'];
      $email=$_POST['email'];
      $password=$_POST['password'];

      $signup=$db->signup($username,$email,$password);
  }
?>
<body class="signup">
    <div class="container">
        <center>
            <div class="card" style="width: 38rem;">
               
                <div class="card-body">
                    <h5 class="card-title signup-title">Please Give Your Information Here To Register!!</h5>
                    <?php
                       if(isset($signup)){
                           echo $signup;
                       }
                    ?>
                    <form method="POST">
                        <div class="form-group row">
                            <label for="Username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" id="Username" placeholder="Abu Sayed" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" id="staticEmail" placeholder="email@example.com" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-primary" name="register" value="Register">
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