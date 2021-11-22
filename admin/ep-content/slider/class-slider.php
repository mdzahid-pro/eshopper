<?php 
    class SLIDER extends insert{
        public function __construct(
            protected object $con,
            private string $heading,
            private string $description,
            private string $status ='0',
            private array $image=[],
        ){}

        //make a function to filter all data get from browser
        private function filterAll(){
            $this->heading = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->heading)));
            $this->description = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->description)));
            $this->status = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->status)));
        }

        //make a function to filter file that recive from browser
        private function imageFilter(){
            // make a random name for slider image
            $file = "/media/slider/__" . rand(0,90).md5(time()).".png";
            // now send image into server
            move_uploaded_file($this->image['tmp_name'],"../../..".$file);
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

        private function checkStatus(){
            if($this->status == 1){
                return 1;
            }else{
                return 0;
            }
        }

        public function execute(){
            $this->filterAll();

            $status = $this->checkStatus();

            if(strlen($this->image['tmp_name']) !== 0){
                //make a array to store data for insert into database
                $data = array(
                    'slider_heading'=>$this->heading,
                    'slider_description'=>$this->description,
                    'slider_image'=>$this->imageFilter($this->image),
                    'slider_status'=>$status,
                );
            }else{
                //make a array to store data for insert into database
                $data = array(
                    'slider_heading'=>$this->heading,
                    'slider_description'=>$this->description,
                    'slider_image'=>'',
                    'slider_status'=>$status,
                );
            }

            $insert = $this->insert('slider',$data);
            if($insert == false)
                echo "Sorry to insert any data".$this->con->error;
            return true;
        }
    }