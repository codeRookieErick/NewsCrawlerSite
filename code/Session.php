<?PHP
    if(isset($_SESSION['newsHistory'])){
        $_SESSION['newsHistory'] = array();
    }

    class Session{
        private $data = array(), $name = '';

        public function __get($prop){
            return $this->data[$prop] ?? null;
        }

        public function __set($prop, $val){
            $this->data[$prop] = $val;
        }

        public function __construct($name){
            $this->name = $name;
            if(isset($_SESSION[$this->name])){
                $this->data = $_SESSION[$this->name];
            }
        }

        public function __destruct(){
            $_SESSION[$this->name] = $this->data;
        }
    }
?>