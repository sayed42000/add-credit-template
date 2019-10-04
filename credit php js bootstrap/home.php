<?php 
  include 'inc/header.php';
?>
<body class="information">
<?php 
  include 'inc/nav.php';
  include 'classes/Credit.php';
  include 'classes/Expense.php';
?>
<?php
  $expense=new Expense();

  $expenselist=$expense->readExpense();

  $total_expense=$expense->sumationExpense();


    if(isset($_GET['deleteexpense'])){
        $id=$_GET['deleteexpense'];
        $deleteExpense=$expense->deleteExpense($id);
    }

?>
<?php

    $credit=new Credit();
    $creditTable=$credit->readCredit();

    $total=$credit->sumation();

    if(isset($_GET['delete'])){
        $id=$_GET['delete'];
        $delete=$credit->delete($id);
    }

?>
        <div class="jumbotron jumbo">
            <h1>Hello, <?php echo Session::get('username'); ?>!</h1>
            <p class="lead">Your total credit is 
            <?php  
               if($total > 0){
                   echo $total;
               }else{
                   echo 0;
               }
            ?>  
            Taka and your expense is 
            <?php  
               if($total_expense>0){
                   echo  $total_expense;
               }else{
                   echo 0;
               }
            ?> 
            Taka.

            <?php
            if($total > 0 AND $total_expense > 0 ){
                echo ' Your remaining balance is '.($total-$total_expense).' Taka ';
            }else{

            }
            ?>
            
            </p>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
 
                    <h3>Your Credit Information</h3>

                    <span class="text-primary">
                       <?php
                         if(isset($delete)){
                         echo  $delete;
                         }
                       ?>
                    </span>
                    <table class="table table-hover">
                        <thead>
                            <tr >
                                <th scope="col">SiNo</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                           //if(isset($creditTable)){
                               //$i=0;
                               //while($value=$creditTable->fetch_assoc()){
                                   //$i++;
                        ?>     
                        <?php
                        
                        if(isset($creditTable)){
                          $i=0;
                            while($value=$creditTable->fetch_assoc()){
                                $i++;
                         ?>   
                            <tr>
                                <th scope="row"><?php echo $i ; ?></th>
                                <td><?php echo $value['amount']; ?></td>
                                <td><?php echo $value['date']; ?></td>
                                <td>
                                   <a href="update.php?update=<?php echo $value['creditId']; ?>">
                                      <button class="btn btn-danger">Update</button>
                                   </a>  
                                   <a href="?delete=<?php echo $value['creditId']; ?>"> 
                                    <button class="btn btn-success">Delete</button>
                                    </a> 
                                </td>
                            </tr>
                           <?php } } ?>


                        </tbody>
                    </table>
                <?php //} } ?>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">

                 <h3>Your Expense List</h3>
                    <span class="text-danger">
                    <?php 
                      if(isset($deleteExpense)){
                          echo $deleteExpense;
                      }
                      
                      //echo Session::get('deletemsg');
                    
                    ?>
                    </span>
                    <table class="table table-hover expense">
                        <thead>
                            <tr>
                                <th scope="col">SiNo</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
            <?php
               //if(isset($expenselist)){
                   //while(($value=$expenselist->fetch_assoc())>0){
                       //print_r($value);
                if(isset($expenselist)){
                    $i=0;
                   while($value=$expenselist->fetch_assoc()){
                       $i++;
                                            
              ?>
                  
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><?php echo $value['subject']; ?></td>
                                <td><?php echo $value['amount']; ?></td>
                                <td><?php echo $value['date']; ?></td>
                                <td>
                                   <a href="updateexpense.php?updateexpense=<?php echo $value['expenseId']; ?>">
                                      <button class="btn btn-danger">Update</button>
                                   </a>  
                                   <a href="?deleteexpense=<?php echo $value['expenseId']; ?>"> 
                                       <button class="btn btn-success">Delete</button>
                                    </a>                                 
                                </td>
                            </tr>
                   <?php } } ?>

                        </tbody>
                    </table>
            </div>
            
        </div>
    </div>
<?php 
  include 'inc/footer.php';
?>