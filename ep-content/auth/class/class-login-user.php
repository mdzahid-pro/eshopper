<?php 
session_start();
    class AUTH_LOGIN{
        public function __construct(protected $con,private $email, private $pass)
        {
            
        }

        //make a function that will filter all coming data from browser 
        private function filter(){
            $this->email = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->email)));
            $this->pass = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->pass)));
        }

        //make a function to check youser email and password is true or false
        private function checkEmeilPass(){
            //make a query to get all data from database
            $query = $this->con->query("SELECT * FROM ep_users WHERE email='$this->email'");
            //now fetch data 
            $row = $query->fetch_assoc();

            if($row['password'] === md5(sha1($this->pass))){
                $_SESSION['user_pass'] = $this->pass;
                $_SESSION['user_id'] = $row['id'];
                return true; 
            }else{
                return false;
            }
            
        }

        public function execute(){
            if($this->checkEmeilPass()){
                header("Location: ../../../index.php?logged=in_success");
            }else{
                $_SESSION['login_msg'] = "Your Email or password id not matched";
                header("Location: ../../../login.php?request=failed");
            }
        }
    }