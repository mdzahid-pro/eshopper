<?php 
session_start();
    //make a class that name will be create user
    class CREATEuser extends insert{
        public function __construct(protected $con,private $fname,private $lname,private $email,private $pass)
        {
            
        }

        private function validation(){
            $this->fname = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->fname)));
            $this->lname = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->lname)));
            $this->email = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->email)));
            $this->pass  = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->pass)));
        }

        //make a function to check your email is already have or not
        //if your email is have in database than you will redirect to login page with a massege
        private function checkMail(){
            $query = $this->con->query("SELECT * FROM ep_users WHERE email='".$this->email."'");
            if($this->con->error)
                return "Something went wrong";

            return $query->num_rows;
        }

        //now make a execute function to execute for insert all data iinto database
        public function execute(){
            //call validate function to validation
            $this->validation();
            if(strlen($this->fname) <= 30 && strlen($this->lname) <= 30  && strlen($this->email) <= 60  && strlen($this->pass) >= 6 ){
                //call checkMail function 
                if($this->checkMail() === 0){
                    $emails = sendmail($this->email,'Account Verification');
                    if($emails[0] == true){
                        // call insert function 
                        $data = array(
                            'fname' => $this->fname,
                            'lname' => $this->lname,
                            'password' => md5(sha1($this->pass)),
                            'email' => $this->email,
                            'email_status' => 0
                        );

                        $id = $this->insert('ep_users',$data);

                        $email = array(
                            'user_id' => $id,
                            'code' => $emails[1],
                            'status' => 0
                        );

                        $this->insert('ep_mail_confirm',$email);
                        $_SESSION['new_user_id'] = $id;
                        return true;                        
                    }else{
                        return "Please Give me a valied Gmail account";
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
            
        }
    }