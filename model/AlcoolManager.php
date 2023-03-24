<?php
    require_once('DbManager.php');
    class AlcoolManager extends DbManager{
        private $_name;
        private $_degree;
        private $_type;
        private $_category;
        private $_origin;
        private $_image;
        private $_presentation;
        private $_degustation;
        private $_price2cl;
        private $_price4cl;
        private $_active;

        public function __construct(
            $alcool_name,
            $alcool_degree,
            $alcool_type,
            $alcool_category,
            $alcool_origin,
            $alcool_image,
            $alcool_presentation,
            $alcool_degustation,
            $alcool_price2cl,
            $alcool_price4cl,
            $alcool_active
        ){
            $this->setName($alcool_name);
            $this->setDegree($alcool_degree);
            $this->setType($alcool_type);
            $this->setCategory($alcool_category);
            $this->setOrigin($alcool_origin);
            $this->setImage($alcool_image);
            $this->setPresentation($alcool_presentation);
            $this->setDegustation($alcool_degustation);
            $this->setPrice2cl($alcool_price2cl);
            $this->setPrice4cl($alcool_price4cl);
            $this->setActive($alcool_active);
        }

        protected function getName()        {return $this->_name;}
        protected function getDegree()      {return $this->_degree;}
        protected function getType()        {return $this->_type;}
        protected function getCategorie()   {return $this->_category;}
        protected function getOrigin()      {return $this->_origin;}
        protected function getImage()       {return $this->_image;}
        protected function getPresentation(){return $this->_presentation;}
        protected function getDegustation() {return $this->_degustation;}
        protected function getPrice2cl()    {return $this->_price2cl;}
        protected function getPrice4cl()    {return $this->_price4cl;}
        protected function getActive()      {return $this->_active;}

        protected function setName($alcool_name)                {$this->_name           = $alcool_name;}
        protected function setDegree($alcool_degree)            {$this->_degree         = $alcool_degree;}
        protected function setType($alcool_type)                {$this->_type           = $alcool_type;}
        protected function setCategory($alcool_category)        {$this->_category       = $alcool_category;}
        protected function setOrigin($alcool_origin)            {$this->_origin         = $alcool_origin;}
        protected function setImage($alcool_image)              {$this->_image          = $alcool_image;}
        protected function setPresentation($alcool_presentation){$this->_presentation   = $alcool_presentation;}
        protected function setDegustation($alcool_degustation)  {$this->_degustation    = $alcool_degustation;}
        protected function setPrice2cl($alcool_price2cl)        {$this->_price2cl       = $alcool_price2cl;}
        protected function setPrice4cl($alcool_price4cl)        {$this->_price4cl       = $alcool_price4cl;}
        protected function setActive($alcool_active)            {$this->_active         = $alcool_active;}

        public function addNewAlcool(){
            $db = $this->connection();
            $requestNewAlcool = $db->prepare('INSERT INTO alcool(
                name,
                degree,
                type,
                category,
                origin,
                image,
                presentation,
                degustation,
                price2cl,
                price4cl,
                active)
                VALUES(?,?,?,?,?,?,?,?,?,?,?)');
            $result = $requestNewAlcool->execute([
                $this->getName(),
                $this->getDegree(),
                $this->getType(),
                $this->getCategorie(),
                $this->getOrigin(),
                $this->getImage(),
                $this->getPresentation(),
                $this->getDegustation(),
                $this->getPrice2cl(),
                $this->getPrice4cl(),
                $this->getActive()
            ]);
            return $result;
        }

        public static function getAlcool($type){
            $db = self::connection();
            $requestAlcool = $db->prepare('SELECT * FROM alcool WHERE type=? AND active=1');
            $requestAlcool->execute([$type]);
            return $requestAlcool;
        }
        public static function getAlcoolAdmin($type){
            $db = self::connection();
            $requestAlcool = $db->prepare('SELECT * FROM alcool WHERE type=?');
            $requestAlcool->execute([$type]);
            return $requestAlcool;
        }

        public static function updateAlcool(
            $id,
            $name,
            $degree,
            $type,
            $category,
            $origin,
            $image,
            $presentation,
            $degustation,
            $price2cl,
            $price4cl,
            $active){
                $db = self::connection();
                if(empty($image)){
                    $requestUpdate = $db->prepare('UPDATE alcool SET 
                        name            =:name,
                        degree          =:degree,
                        type            =:type,
                        category        =:category,
                        origin          =:origin,
                        presentation    =:presentation,
                        degustation     =:degustation,
                        price2cl        =:price2cl,
                        price4cl        =:price4cl,
                        active          =:active
                        WHERE id        =:id');
                    $resultUpdate = $requestUpdate->execute([
                        'id'            =>$id,
                        'name'          =>$name,
                        'degree'        =>$degree,
                        'type'          =>$type,
                        'category'      =>$category,
                        'origin'        =>$origin,
                        'presentation'  =>$presentation,
                        'degustation'   =>$degustation,
                        'price2cl'      =>$price2cl,
                        'price4cl'      =>$price4cl,
                        'active'        =>$active]);
                }else{
                    $requestUpdate = $db->prepare('UPDATE alcool SET 
                        name            =:name,
                        degree          =:degree,
                        type            =:type,
                        category        =:category,
                        origin          =:origin,
                        image           =:image,
                        presentation    =:presentation,
                        degustation     =:degustation,
                        price2cl        =:price2cl,
                        price4cl        =:price4cl,
                        active          =:active
                        WHERE id        =:id');
                    $resultUpdate = $requestUpdate->execute([
                        'id'            =>$id,
                        'name'          =>$name,
                        'degree'        =>$degree,
                        'type'          =>$type,
                        'category'      =>$category,
                        'origin'        =>$origin,
                        'image'         =>$image,
                        'presentation'  =>$presentation,
                        'degustation'   =>$degustation,
                        'price2cl'      =>$price2cl,
                        'price4cl'      =>$price4cl,
                        'active'        =>$active]);
                }
                return $resultUpdate;                                
        }
    }