<?php 
  include 'inc/header.php';
?>
<body class="signup">
    <div class="container">
<?php 
  include 'inc/nav.php';
?>
<?php
  include 'classes/Credit.php';
  $credit=new Credit();
  if(isset($_GET['update'])){
      $id=$_GET['update'];
      $creditData=$credit->readCreaditByID($id);
  }
  if(isset($_POST['credit'])){
      $amount=$_POST['inputcredit'];
      $date=$_POST['inputdate'];

      $updateData=$credit->updateData($id,$amount,$date);
  }
?>

        <center>
            <?php 
              if(isset($creditData)){
                 while(($result=$creditData->fetch_assoc())>0){

            ?>

            <div class="card" style="width: 38rem;">
                <div class="card-body">
                    <h5 class="card-title">Add Your Credit Here</h5> 
                         <?php  
                         if(isset($updateData)){ 
                             echo $updateData; 
                             
                        } ?>                                       
                    <form method="POST">
                        <div class="form-group row">
                            <label for="inputAmount" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="inputcredit"  id="inputAmount" value="<?php echo $result['amount']; ?>" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="inputdate"  id="inputAmount" value="<?php echo $result['date']; ?>" >
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-primary" name="credit" value="Update Credit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

          <?php } } ?>
        </center>
    </div>
<?php 
  include 'inc/footer.php';
?>