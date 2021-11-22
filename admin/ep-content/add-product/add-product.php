<?php 
    class ADDproduct extends insert{
		// Call Constructor 
        public function __construct(
            protected $con,
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
            private array $prd_image_three = [],
            private array $prd_image_for,
            )
        {
            
        }
		
		//make a function to filter all data i get from user
		//that function name will be filter_all
        private function filter_all(){
            $this->prd_name = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_name)));
            $this->prd_auth = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_auth)));
            $this->prd_price = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_price)));
            $this->prd_ask_price = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_ask_price)));
            $this->prd_currency = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_currency)));
            $this->prd_condition = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_condition)));
            $this->prd_availability = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_availability)));
            $this->prd_title = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_title)));
            $this->prd_description = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_description)));
            $this->prd_brand = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_brand)));
            $this->prd_category = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$this->prd_category)));
        }
		
		//make a function to filter all images i get from users
		//that function name will be image_filter
        private function image_filter($image,$type='sub'){
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
            $image = imagecreatefromstring(file_get_contents($file));
            $width = imagesx($image);
            $height = imagesy($image);
            $new_width = 85;
            $new_height = 85;

            $images = imagecreatetruecolor($new_width,$new_height);
            imagecopyresized($images, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            
            imagejpeg($images,$file,100);
            return substr($file,9);
        }
		// make a function to check product id have or not in database
		public function cProductId(){
			$query = $this->con->query("SELECT * FROM ep_product WHERE product_id='".$this->productId()."'");
			if(mysqli_error($this->con)){
				echo "Sorry to run this query ".mysqli_error($this->con);
			}
			return $query->num_rows;
		}
		
		// make a function that function will return a uniqid for product
		private function productId(){
			//that function will return 8 digits unique number
			return substr(time(),3,10);
		}
		
		
		//let's make a function to execute with all those function 
        public function execute(){
			if($this->cProductId() === 1){
				return 'false';
			}
			
			//let's call filter all function to filter all the data i get from user
            $this->filter_all();
			// now call image filter image to filter primary and opsional image
            $p_img = $this->resize_image("../../../".$this->image_filter($this->prd_p_image,'primary'));
            $img_1 = $this->resize_image_sub("../../../".$this->image_filter($this->prd_image_one),'sub');
            $img_2 = $this->resize_image_sub("../../../".$this->image_filter($this->prd_image_two,'sub'));
            $img_3 = $this->resize_image_sub("../../../".$this->image_filter($this->prd_image_three,'sub'));
            $img_4 = $this->resize_image_sub("../../../".$this->image_filter($this->prd_image_for,'sub'));
			// call productId function and store it in a veriable
			$prd_id = $this->productId();
			
			// make a array of data to insert in database 
			// insert product info in database
			$product = array(
				"category_id" => $this->prd_category,
				"manufacture_id" => $this->prd_brand,
				"product_name" => $this->prd_name,
				"product_id" => $prd_id,
				"product_price" => $this->prd_price,
				"product_ask_price" => $this->prd_ask_price,
				"product_carency" => $this->prd_currency,
				"product_condition" => $this->prd_condition,
				"product_availability" => $this->prd_availability,
				"product_brand" => $this->prd_brand,
				"product_image" => $p_img,
			);
			// that veriable are store the inserted id number
			$product_id = $this->insert('ep_product',$product);
			
			// make a array of data to insert in database 
			// insert image in database
			$image_arr = array(
				"product_id" => $product_id,
				"primary_image" => $p_img,
				"image_one" => $img_1,
				"image_two" => $img_2,
				"image_three" => $img_3,
				"image_for" => $img_4,
			);
			
			// now call insert function that function come from insert_product file class
			$this->insert('ep_product_image',$image_arr);
			
			// make a array of data to insert in database 
			// insert image in database
			$details_arr = array(
				"auth_name" => $this->prd_auth,
				"product_brand" => $this->prd_brand,
				"product_title" => $this->prd_title,
				"product_details" => $this->prd_auth,
				"product_id" => $product_id,
			);
			$this->insert('ep_product_details',$details_arr);

            return true;
        }
    }