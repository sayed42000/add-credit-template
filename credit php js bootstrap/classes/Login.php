<?php
    include 'session/Session.php';
    Session::checkLogin();
    include_once 'database/Database.php';
    include_once 'helper/Format.php';

    class Login{
        private $db;
        private $fm;
        public function __construct(){
            $this->db=new Database();
            $this->fm=new Format();
        }


        public function signin($email,$password){
            $email=$this->fm->validation($email);
            $password=$this->fm->validation($password);


            $email=mysqli_real_escape_string($this->db->link,$email);
            $password=mysqli_real_escape_string($this->db->link,md5($password));

            if(empty($email) || empty($password)){
                $loginmsg="<h5>Username and Password Must not be empty!!</h5>";
                return $loginmsg;
            }else{
                $query="SELECT * FROM login WHERE email='$email' AND password='$password'";
                $result=$this->db->select($query);
                if($result != false ){
                    $value=$result->fetch_assoc();
                    Session::set("userlogin",true);
                    Session::set("userId",$value['userId']);   
                    Session::set("username",$value['username']);                  
                    Session::set("email",$value['email']);
                    header('Location:home.php');

                }else{
                    $loginmsg="<h5>Username and Password not match</h5>";
                    return $loginmsg;
                }
            }
        }



        //Signup form====================================================     

        public function signup($username,$email,$password){
            $username=$this->fm->validation($username);
            $email=$this->fm->validation($email);
            $password=$this->fm->validation($password);

            $username=mysqli_real_escape_string($this->db->link,$username);
            $email=mysqli_real_escape_string($this->db->link,$email);
            $password=mysqli_real_escape_string($this->db->link,md5($password));

            if(empty($username) || empty($email) || empty($password)){
                $signupmsg='<h5>All Fields Are Must Be Required</h5>';
                return $signupmsg;
            }elseif (filter_var($email,FILTER_VALIDATE_EMAIL)===false){
                $signupmsg='<h5>Email Are Not Valid</h5>';
            }elseif($this->findusername($username)===true){
                $signupmsg='<h5>Username Not Available!!</h5>';
                return $signupmsg;
            }elseif($this->findemail($email)===true){
               $signupmsg='<h5>Email Are Not Available!!</h5>';
                return $signupmsg;
            }
            else{
                $query="INSERT INTO login(username,email,password) VALUES('$username','$email','$password')";
                $result=$this->db->insert($query);
                $queryOne="SELECT * FROM login WHERE email='$email'";
                $queryOne=$this->db->select($queryOne);
                if($queryOne){
                    $value=$queryOne->fetch_assoc();
                    Session::set("userlogin",true);
                    Session::set("userId",$value['userId']);   
                    Session::set("username",$value['username']);                  
                    Session::set("email",$value['email']);
                    header('Location:home.php');
                }else{
                    $signupmsg='<h5>Your Registration is not complete!!</h5>';
                    return $signupmsg;
                }
            }
        }


        public function findusername($username){
            $query="SELECT * FROM login WHERE username='$username'";
            $result=$this->db->select($query);
            if($result){
               //$value=$result->fetch_assoc();
               //return $value;
               return true;
            }else{
                return false;
            }  
        }  

        public function findemail($email){
            $query="SELECT * FROM login WHERE email='$email'";
            $result=$this->db->select($query);
            if($result){
               //$value=$result->fetch_assoc();
               //return $value;
               return true;
            }else{
                return false;
            }   
        }
 

    }