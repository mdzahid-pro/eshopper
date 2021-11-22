<?php 
    class SLIDER{
        public function __construct(protected $con){

        }

        function getSlider(){
            $slider = $this->con->query("SELECT * FROM slider WHERE slider_status=1");
            $index = 0;
            $data = array();
            while($row = $slider->fetch_assoc()){
                $data[$index] = $this->getOne($row['id']);
                $index++;
            }

            return $data;
        }

        private function getOne($id){
            $slider = $this->con->query("SELECT * FROM slider WHERE id=$id");
            return $slider->fetch_assoc();
        }
    }