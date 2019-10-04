    <?php
    include 'session/Session.php';
    Session::checkSession();
    ?>
    <div class="container">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addcredit.php">Add Credit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="expense.php">Add Expense</a>
            </li>
         <?php   
            if(isset($_GET['action']) && $_GET['action']=='logout'){
                Session::destroy();
                
            }
         ?>
            <li class="nav-item">
                <a class="nav-link" href="?action=logout">Log Out</a>
            </li>
        </ul>