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
  if(isset($_POST['expense'])){
      $subject=$_POST['subject'];
      $amount=$_POST['amount'];
      $credit=$expense->addExpense($subject,$amount);
  }
?>
        <center>

            <div class="card" style="width: 38rem;">
                <div class="card-body">
                    <h5 class="card-title">Add Your Expense Here</h5>
                    <form method="POST">
                        <div class="form-group row">
                            <label for="staticSubject" class="col-sm-2 col-form-label">Subject</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subject" id="staticSubject" placeholder="Subject" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputAmount" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="amount" id="inputAmount" placeholder="Amount" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-danger" name="expense" value="Add Expense">
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