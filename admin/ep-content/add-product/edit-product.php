<?php 
    //include update functon from update class
    include "update.php";
    class EDITproduct extends update{
        public function __construct(
            protected $con,
            private string $prd_id,
            private string $prd_name,
            private string $prd_auth,
            private string $prd_price,
            private string $prd_ask_price,
            private string $prd_currency,
            private string $prd_condition,
            private string $prd_availability,
            private string $prd_title,
            private string $prd_description,
            private string $prd_brand,
            private string $prd_category,
            private array $prd_p_image,
            private array $prd_image_one,
            private array $prd_image_two,
            private array $prd_image_three,
            private array $prd_image_for,
            )
        {
            
        }
		
		//make a function to filter all data i get from user
		//that function name will be filter_all
        private function filter_all(){
            $this->prd_name = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_name)));
            $this->prd_id = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_id)));
            $this->prd_auth = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_auth)));
            $this->prd_price = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_price)));
            $this->prd_ask_price = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_ask_price)));
            $this->prd_currency = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_currency)));
            $this->prd_condition = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_condition)));
            $this->prd_availability = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_availability)));
            $this->prd_title = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_title)));
            $this->prd_description = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_description)));
            $this->prd_brand = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_brand)));
        }
		
        //make a function to filter all images i get from users
		//that function name will be image_filter
        private function image_filter($image,$type='sub'){
            $fileType = $type;
            $img_name = "__".rand(0,90).md5(date("Y-M-D H-I-s")).".jpg";

            if($type == 'primary'){
                $types = '../../../media/product/primary/';
            }else if($type == 'sub'){
                $types = '../../../media/product/sub/';
            }

            if($type == 'sub'){
                $type = 'media/product/sub/';
            }else if($type == 'primary'){
                $type = 'media/product/primary/';
            }

            move_uploaded_file($image['tmp_name'],$types.$img_name);

            if($fileType == 'sub'){
                $this->resize_image_sub($types.$img_name);
            }else if($fileType == 'primary'){
                $this->resize_image($types.$img_name);
            }

            return $type.$img_name;
        }
		
        //make a function to resize image
        private function resize_image($image){
            // load image and get image size
            $img = imagecreatefromstring(file_get_contents($image));
            
            $width = imagesx( $img );
            $height = imagesy( $img );

            // calculate thumbnail size
            $new_width = 266;
            $new_height = 381;//floor( $height * ( 300 / $width ) );

            // create a new temporary image
            $tmp_img = imagecreatetruecolor( $new_width, $new_height );

            // copy and resize old image into new image 
            imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

            // save thumbnail into a file
            imagejpeg( $tmp_img, $image,100);
            return substr($image,9);
        }

		//make a function to resize product sub image
        private function resize_image_sub($image){
            $file = $image;
            $image = imagecreatefromjpeg($image);
            if($image == false){
                $image = imagecreatefromstring(file_get_contents($file));
            }
            $width = imagesx($image);
            $height = imagesy($image);
            $new_width = 85;
            $new_height = 85;

            $images = imagecreatetruecolor($new_width,$new_height);
            imagecopyresized($images, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            
            imagejpeg($images,$file,100);
            return substr($file,9);
        }
        
        private function imageChecker($image){
            if($image['tmp_name'] == "")
                return false;
            return true;
        }

		// make a function to check product id have or not in database
		public function cProductId(){
			$query = $this->con->query("SELECT * FROM ep_product WHERE product_id='".$this->productId()."'");
			if(mysqli_error($this->con)){
				echo "Sorry to run this query ".mysqli_error($this->con);
			}
			return $query->num_rows;
		}

        // now make a function to delete image from browser
        private function deleteImage($path){
            $image = "../../../$path";
            //now delete image
            if(unlink($image))
                return true;
            else
                return false;
        }

        //make a function for update image
        private function update_image($images){
            switch($images){
                case $images == 'image_one':
                    $image_name = $this->prd_image_one;
                break;
                case $images == 'image_two':
                    $image_name = $this->prd_image_two;
                break;
                case $images == 'image_three':
                    $image_name = $this->prd_image_three;
                break;
                case $images == 'image_for':
                    $image_name = $this->prd_image_for;
                break;
                default :
                    $image_name = "";
            }
            
            //call getOne function to get all image path info
            $imgs = $this->getOne('ep_product_image',$this->prd_id);

            if($images == 'primary_image'){
                // now store image one array to image one from database
                $all_image = $imgs['primary_image'];
                //call imageDelete funciton to delete image from server
                $this->deleteImage($all_image);
                //now update a new image by call imageFilter function 
                $all_image = $this->image_filter($this->prd_p_image,'primary');
            }else{
                // now store image one array to image one from database
                $all_image = $imgs[$images];
                //call imageDelete funciton to delete image from server
                $this->deleteImage($all_image);
                //now update a new image by call imageFilter function 
                $all_image = $this->image_filter($image_name);
            }

            return $all_image;
        }

        //make a function to check which number of image come from browser
        private function getImageNumber(){
            $all_image = array();
            //call getOne function to get all image path info
            $img = $this->getOne('ep_product_image',$this->prd_id);
            // make a variable to store array data and that array data will store all image path
            $all_image['image_one'] = ($this->imageChecker($this->prd_image_one) == true) ? $this->update_image('image_one') : $img['image_one'];
            $all_image['image_two'] = ($this->imageChecker($this->prd_image_two) == true) ? $this->update_image('image_two') : $img['image_two'];
            $all_image['image_three'] = ($this->imageChecker($this->prd_image_three) == true) ? $this->update_image('image_three') : $img['image_three'];
            $all_image['image_for'] = ($this->imageChecker($this->prd_image_for) == true) ? $this->update_image('image_for') : $img['image_for'];
            $all_image['primary_image'] = ($this->imageChecker($this->prd_p_image) == true) ? $this->update_image('primary_image') : $img['primary_image'];

            return $all_image;
        }

        //make a function to access database info 
        private function getOne($table,$id){
            $query = $this->con->query("SELECT * FROM $table WHERE id=$id");
            if($query == false){
                return "Sorry Failed Request".$this->con;
            }
            return $query->fetch_assoc();
        }

        //make method to execute all thing
        public function execute(){
            // now call all filter function to sanitize all data
            $this->filter_all();
            $image = $this->getImageNumber();
            // call getOne funciton to get productid
            $id = $this->getOne('ep_product',$this->prd_id);
            //call update function to update product table data 
            //make a array to store all data
            $data = array(
                'category_id' => $this->prd_category,
                'manufacture_id' => $this->prd_brand,
                'product_name' => $this->prd_name,
                'product_id' => $id['product_id'],
                'product_price' => $this->prd_price,
                'product_ask_price' => $this->prd_ask_price,
                'product_carency' => $this->prd_currency,
                'product_condition' => $this->prd_condition,
                'product_availability' => $this->prd_availability,
                'product_brand' => $this->prd_brand,
                'product_image' => $image['primary_image'],
            );

            //call update method for update database value
            $this->update('ep_product',$data,['id' => $this->prd_id]);

            //now update product details table
            $datas = array(
                'auth_name' => $this->prd_auth,
                'product_brand' => $this->prd_brand,
                'product_title' => $this->prd_title,
                'product_details' => $this->prd_description,
            );

            //call update method for update database value
            $this->update('ep_product_details',$datas,['product_id' => $this->prd_id]);

            //call update method for update database value
            $query = $this->update('ep_product_image',$image,['product_id' => $this->prd_id]);
            if($query){
                return true;
            }else{
                return false;
            }
        }
    }