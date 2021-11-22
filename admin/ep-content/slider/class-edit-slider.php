<?php 
    class EDITslider extends update{
        public function __construct(protected $con)
        {
            
        }

        //make a function to filter file that recive from browser
        private function imageFilter($image){
            // make a random name for slider image
            $file = "/media/slider/__" . rand(0,90).md5(time()).".png";
            // now send image into server
            move_uploaded_file($image['tmp_name'],"../../..".$file);
            // now resize image
            $this->resize("../../..".$file);
            //now return only file path
            return $file;
        }

        private function resize($file){
            $image = imagecreatefromstring(file_get_contents($file));
            // if imagecreatefromjpeg can't handle this file than execute this logic
            /*if($image){
                $image = imagecreatefromstring(file_get_contents($file));
            }*/

            // now get file size ,Height and Width
            $width = imagesx($image);
            $height = imagesy($image);

            //now create a new height and width
            $new_width = 484;
            $new_height = 441;

            //call a funciton that name imacreatetruecolor
            $images = imagecreatetruecolor($new_width,$new_height);

            // Make a new transparent image and turn off alpha blending to keep the alpha channel
            $background = imagecolorallocatealpha($images, 255, 255, 255, 127);
            imagecolortransparent($images, $background);
            imagealphablending($images, false);
            imagesavealpha($images, true);

            // now call a function to resampled image old into new
            imagecopyresampled($images,$image,0,0,0,0,$new_width,$new_height,$width,$height);
            //save image
            imagepng($images,$file);
        }

        private function checkStatus($status){
            if($status == 1){
                return 1;
            }else{
                return 0;
            }
        }

        public function editSlider($id,$heading,$description,$status,$image){
            $id = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$id)));
            $heading = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$heading)));
            $description = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$description)));
            $status = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$status)));

            $status = $this->checkStatus($status);

            $query = $this->con->query("SELECT * FROM slider WHERE id=$id");
            $fetch = $query->fetch_assoc();

            $past = $fetch['slider_image'];

            if($image !== ''){
                $image = $this->imageFilter($image);
            }else{
                $image = $fetch['slider_image'];
            }

            // now make a array to store all data for update databse
            $data = array(
                'slider_heading'=>$heading,
                'slider_description'=>$description,
                'slider_image'=>$image,
                'slider_status'=>$status,
            );

            $where = array(
                'id'=>$id
            );

            $query = $this->update('slider',$data,$where);
            if($query == false){
                $_SESSION['error'] = "Something Went wrong".$this->con->error;
                return false;
            }

            //delete old image from the server
            unlink("../../..".$past);
            
            $_SESSION['massege'] = "Successfully Update data";
            return true;
        }

        public function delete($id){
            $id = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$id)));
            $query = $this->con->query("SELECT * FROM slider WHERE id=$id");
            $fetch = $query->fetch_assoc();

            //delete image from server
            unlink("../../..".$fetch['slider_image']);

            //delete data from database
            $query = $this->con->query("DELETE FROM slider WHERE id=$id");
            if($query == false){
                $_SESSION['error'] = "Sorry to delete data from database";
                return false;
            }
            
            return true;
        }

        public function active($id){
            $id = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$id)));
            // now make a array to store all data for update databse
            $data = array(
                'slider_status'=>1,
            );

            $where = array(
                'id'=>$id
            );

            $query = $this->update('slider',$data,$where);
            if($query == false){
                $_SESSION['error'] = "Something Went wrong".$this->con->error;
                return false;
            }
            
            $_SESSION['massege'] = "Successfully Update data";
            return true;
        }

        public function de_active($id){
            $id = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$id)));
            // now make a array to store all data for update databse
            $time = date("y-m-d h-i-s");
            $query = mysqli_query($this->con,"UPDATE slider SET slider_status='0'  WHERE id='$id' ");

            if($this->con->error){
                $_SESSION['error'] = "Something Went wrong".$this->con->error;
                return false;
            }else{
                $_SESSION['massege'] = "Successfully Update data";
                return true;
            }

        }
    }