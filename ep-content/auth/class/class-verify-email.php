<?php 
session_start();
    class VERIFYemail{
        public function __construct(protected $con){

        }

        //make a function to get differece bitween to time when request and when verifying email
        private function checkTime($request){
            date_default_timezone_set("Asia/Dhaka");
            // we hold like this 09-03-2021 1-47-50
            // time to str time
            $str_time = strtotime($request);
            //echo $str_time;
            $time = time() - $str_time;
            //echo "<br>".time();
            if(round($time / 60) <= 65){
                return true;
            }else{
                $_SESSION['massege'] = "Session Time Failed";
                header("Location: ../../../login.php");
            }
        }


        public function execute($verify_code){
            $id = $_SESSION['new_user_id'];
            if($id == ''){
                $_SESSION['massege'] = "Fake Request";
                header("Location: ../../../login.php");
            }

            $query = $this->con->query("SELECT * FROM ep_mail_confirm WHERE user_id=$id");
            $em = $this->con->query("SELECT * FROM `ep_users` WHERE id=$id");
            $row = $query->fetch_assoc();
            $email = $em->fetch_assoc();

            if($row['code'] === $verify_code){
                $this->checkTime($row['create_time']);
                $this->con->query("UPDATE ep_mail_confirm SET status=1 WHERE id={$row['id']}");
                $this->con->query("UPDATE ep_users SET email_status=1 WHERE id=$id");
                welcomemail($email['email']);

                return true;
            }
        }
    }