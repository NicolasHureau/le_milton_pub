<?php
    require_once('DbManager.php');
    class UsersManager extends DbManager {
// Variables utilisateur
        private $_pseudo;
        private $_first_name;
        private $_last_name;
        private $_birthday;
        private $_email;
        private $_password;
        private $_secret;
        private $_role;
// Constructeur
        public function __construct(
            $user_pseudo,
            $user_first,
            $user_last,
            $user_bday,
            $user_email,
            $user_pass,
            $user_secret,
            $user_role
        ){
            $this->setPseudo($user_pseudo);
            $this->setFirstName($user_first);
            $this->setLastName($user_last);
            $this->setBirthday($user_bday);
            $this->setEmail($user_email);
            $this->setPassword($user_pass);
            $this->setSecret($user_secret);
            $this->setRole($user_role);
        }
// Getters
        protected function getPseudo()      {return $this->_pseudo;}
        protected function getFirstName()   {return $this->_first_name;}
        protected function getLastName()    {return $this->_last_name;}
        protected function getBirthday()    {return $this->_birthday;}
        protected function getEmail()       {return $this->_email;}
        protected function getpassword()    {return $this->_password;}
        protected function getSecret()      {return $this->_secret;}
        protected function getRole()        {return $this->_role;}
// Setters
        protected function setPseudo($user_pseudo)  {$this->_pseudo     = $user_pseudo;}
        protected function setFirstName($user_first){$this->_first_name = $user_first;}
        protected function setLastName($user_last)  {$this->_last_name  = $user_last;}
        protected function setBirthday($user_bday)  {$this->_birthday   = $user_bday;}
        protected function setEmail($user_email)    {$this->_email      = $user_email;}
        protected function setPassword($user_pass)  {$this->_password   = $user_pass;}
        protected function setSecret($user_secret)  {$this->_secret     = $user_secret;}
        protected function setRole($user_role)      {$this->_role       = $user_role;}
// Ajout d'utilisateur dans la BDD
        public function addNewUser(){
            $db = $this->connection();
            $requestNewUser = $db->prepare('INSERT INTO users(
                pseudo,
                first_name,
                last_name,
                birthday,
                email,
                password,
                secret,
                role)
                VALUES(?,?,?,?,?,?,?,?)');
            $result = $requestNewUser->execute([
                $this->getPseudo(),
                $this->getFirstName(),
                $this->getLastName(),
                $this->getBirthday(),
                $this->getEmail(),
                $this->getpassword(),
                $this->getSecret(),
                $this->getRole()
            ]);
            return $result;
        }
// Connection d'utilisateur
        public function Connect(){
            $_SESSION['connect']=1;
            $_SESSION['pseudo'] =$this->getPseudo();
            $_SESSION['email']  =$this->getEmail();
            $_SESSION['role']   =$this->getRole();
        }
        public static function getUsers(){
            $db = self::connection();
            $requestAdmin = $db->query('SELECT * FROM users');
            return $requestAdmin;
        }
        public static function updateUser(
            $id,
            $pseudo,
            $role,
            $first_name,
            $last_name,
            $birthday,
            $email,
            $ban){
                $db = self::connection();
                $requestUpdate = $db->prepare('UPDATE users SET
                    pseudo      =:pseudo,
                    role        =:role,
                    first_name  =:first_name,
                    last_name   =:last_name,
                    birthday    =:birthday,
                    email       =:email,
                    ban         =:ban
                    WHERE id    =:id');
                $resultUpdate = $requestUpdate->execute([
                    'id'        =>$id,
                    'pseudo'    =>$pseudo,
                    'role'      =>$role,
                    'first_name'=>$first_name,
                    'last_name' =>$last_name,
                    'birthday'  =>$birthday,
                    'email'     =>$email,
                    'ban'       =>$ban]);
                return $resultUpdate;
        }
    }