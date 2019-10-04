<?php
    include_once 'database/Database.php';
    include_once 'helper/Format.php';


    class Credit{
        private $db;
        private $fm;
        private $email;


        public function __construct(){
            $this->db=new Database();
            $this->fm=new Format();
            $this->email =Session::get('email');


        }

        public function addCredit($inputcredit){
            $addcredit=$this->fm->validation($inputcredit);
            $addcredit=mysqli_real_escape_string($this->db->link,$addcredit);

            if(empty($addcredit)){
                $creditmsg="<h5>Please Add Your Credit</h5>";
                return $creditmsg;
            }else{
                $email=$this->email;
                $query="INSERT INTO credit(amount,email,date) VALUES('$addcredit','$email',CURRENT_DATE())";
                $result=$this->db->insert($query);
                if($result){
                    header("Location:home.php");
                }
            }
        }

        //================read credit================

        public function readCredit(){
            $email=$this->email;
            $query="SELECT * FROM credit WHERE email='$email'";
            $result=$this->db->select($query);
            if($result){
                return $result;
            }
        }

        public function readCreaditByID($id){
            $id=$this->fm->validation($id);
            $id=mysqli_real_escape_string($this->db->link,$id);
            $query="SELECT amount,date FROM credit WHERE creditId='$id'";
            $result=$this->db->select($query);
            if($result){
                return $result;
            }
        }

        public function updateData($id,$amount,$date){
            $amount=$this->fm->validation($amount);
            $amount=mysqli_real_escape_string($this->db->link,$amount);

            $date=$this->fm->validation($date);
            $date=mysqli_real_escape_string($this->db->link,$date);

            if(empty($amount) || empty($date)){
                $update="<h5>Fields should not be empty</h5>";
                return $update;
            }else{
                $query="UPDATE credit SET amount='$amount' , date='$date' WHERE creditId='$id'";
                $result=$this->db->update($query);
                if($result){
                    header("Location:home.php");
                    Session::set("updateMessage","Data updated successfully!!");
                }else{
                    $update="<h5>Data not updated!!</h5>";
                    return $update;                
                }
            }
        }


        public function delete($id){
            $query="DELETE FROM credit WHERE creditId='$id'";
            $result=$this->db->delete($query);
            if($result){
                
                $deletemsg="<h5>Data  deleted!!</h5>";
                return $deletemsg;
                header("Location:home.php");
            }else{
                $deletemsg="<h5>Data not  deleted!!</h5>";
                return $deletemsg;                
            }
        }


        public function sumation(){
            $email=$this->email;
            $query="SELECT sum(amount) as total FROM credit WHERE email='$email'";
            $result=$this->db->select($query);
            if($result){
                $value=$result->fetch_assoc();
                return $value['total'];
            }else{
                return false;
            }
        }


  

    }