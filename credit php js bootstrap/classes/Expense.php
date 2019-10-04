<?php
    include_once 'database/Database.php';
    include_once 'helper/Format.php';

    class Expense{
        private $db;
        private $fm;
        private $email;

        public function __construct(){
            $this->db=new Database();
            $this->fm=new Format();
            $this->email =Session::get('email');
        }

        public function addExpense($subject,$amount){
            $subject=$this->fm->validation($subject);
            $subject=mysqli_real_escape_string($this->db->link,$subject);


            $amount=$this->fm->validation($amount);
            $amount=mysqli_real_escape_string($this->db->link,$amount);            

            if(empty($subject) || empty($amount)){
                $expensemsg="<h5>Please Add Your Expense</h5>";
                return $expensemsg;
            }else{
                $email=$this->email;
                $query="INSERT INTO expense(subject,amount,email,date) VALUES('$subject','$amount','$email',CURRENT_DATE())";
                $result=$this->db->insert($query);
                if($result){
                    header("Location:home.php");
                }
            }
        }

        //================read credit================

        public function readExpense(){
            $email=$this->email;
            $query="SELECT * FROM expense WHERE email='$email'";
            $result=$this->db->select($query);
            if($result){
                return $result;
            }
        }

        public function readexpenseByID($id){
            $id=$this->fm->validation($id);
            $id=mysqli_real_escape_string($this->db->link,$id);
            $query="SELECT * FROM expense WHERE expenseId='$id'";
            $result=$this->db->select($query);
            return $result;
        }

        public function updateexpenseData($id,$subject,$amount,$date){
            $subject=$this->fm->validation($subject);
            $subject=mysqli_real_escape_string($this->db->link,$subject);

            $amount=$this->fm->validation($amount);
            $amount=mysqli_real_escape_string($this->db->link,$amount);

            $date=$this->fm->validation($date);
            $date=mysqli_real_escape_string($this->db->link,$date);

            if(empty($subject) || empty($amount) || empty($date) ){
                $updateexpense="<h5>Fields should not be empty</h5>";
                return $updateexpense;
            }else{
                $query="UPDATE expense SET subject='$subject' , amount='$amount' , date='$date' WHERE expenseId='$id'";
                $result=$this->db->update($query);
                if($result){
                    header("Location:home.php");
                    
                }else{
                    $updateexpense="<h5>Data not updated!!</h5>";
                    return $updateexpense;                
                }
            }
        }


        public function deleteExpense($id){
            $query="DELETE FROM expense WHERE expenseId='$id'";
            $result=$this->db->delete($query);
            if($result){
                
                $deletemsg="<h5>Data  deleted!!</h5>";
                return $deletemsg;
                //Session::set('deletemsg','Data  deleted!!');
                header("Location:home.php");
            }else{
                Session::set('deletemsg','Data not  deleted!!');
                $deletemsg="<h5>Data not  deleted!!</h5>";
                return $deletemsg;                
            }
        }

        

        public function sumationExpense(){
            $email=$this->email;
            $query="SELECT sum(amount) as total FROM expense WHERE email='$email'";
            $result=$this->db->select($query);
            if($result){
                $value=$result->fetch_assoc();
                return $value['total'];
            }else{
                return false;
            }
        }


  

    }