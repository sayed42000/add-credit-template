<?php 
  include 'inc/header.php';
?>
<body class="signup">
<?php 
  include 'inc/nav.php';
?>
<?php
  include 'classes/Expense.php';
  $expense=new Expense();

  if(isset($_GET['updateexpense'])){
      $id=$_GET['updateexpense'];
      $expenseData=$expense->readexpenseByID($id);
  }


  if(isset($_POST['expense'])){
      $subject=$_POST['subject'];
      $amount=$_POST['amount'];
      $date=$_POST['date'];

      $update_expense_Data=$expense->updateexpenseData($id,$subject,$amount,$date);
  }
?>
        <center>
           <?php 
              if(isset($expenseData)){
                 while(($result=$expenseData->fetch_assoc())>0){

            ?>
            <div class="card" style="width: 38rem;">
                <div class="card-body">
                    <h5 class="card-title">Update Your Expense Here</h5>
                            <span class="text-primary">
                               <?php 
                                    if(isset($update_expense_Data)){
                                       echo $update_expense_Data;
                                    }
                                ?>
                            </span>
                    <form method="POST">
                        <div class="form-group row">
                            <label for="staticSubject" class="col-sm-2 col-form-label">Subject</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subject" id="staticSubject" value="<?php echo $result['subject']; ?>" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputAmount" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="amount" id="inputAmount" value="<?php echo $result['amount']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputAmount" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="date" id="inputAmount" value="<?php echo $result['date']; ?>">
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-danger" name="expense" value="Update Expense">
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