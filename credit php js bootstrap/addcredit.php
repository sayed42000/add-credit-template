<?php 
  include 'inc/header.php';

?>


<body class="signup">
    <div class="container">
<?php 
  include 'inc/nav.php';
  include 'classes/Credit.php';
  $credit=new Credit();

  if(isset($_POST['credit'])){
      $inputcredit=$_POST['inputcredit'];
      $addcredit=$credit->addCredit($inputcredit);
  }
?>
        <center>
            <div class="card" style="width: 38rem;">
                <div class="card-body">
                    <h5 class="card-title">Add Your Credit Here</h5>
                    <?php 

                    if(isset($addcredit)){
                        echo $addcredit;
                    }

                    ?>
                    <form method="POST">
                        <div class="form-group row">
                            <label for="inputAmount" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="inputcredit"  id="inputAmount" placeholder="Amount" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-primary" name="credit" value="Add Credit">
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