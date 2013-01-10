<?
class cipherText{
    /*
     * cipherText: capsule ciphertext and flags
     * 
     * feeding this instance when initializing,
     * and it will automatically decide if the feed
     * is a previous cipherText->__toString()
     * result, or new.
     *
     */
    function __construct($text){
        try{
            $json = json_decode($text);
            if($json && array_key_exists('t',$json) && array_key_exists('d',$json)){
                print_r($json);
                $this->_text = $json->t;
                $this->_data = array();
                foreach($json->d as $key=>$value){
                    $this->_data[$key] = $value;
                }
                return;
            }
        }catch(Exception $e){}
        $this->_text = $text;
        $this->_data = array();
    }
    function __set($name,$value){
        if(substr($name,0,1) != '_'){
            $this->_data[$name] = $value;
            return;
        }

        $this->$name = $value;
        return;
    }
    function __get($name){
        if(substr($name,0,1) != '_'){
            if(array_key_exists($name,$this->_data))
                return $this->_data[$name];
            else
                return false;
        }
        return $this->$name;
    }
    function __toString(){
        return json_encode(array('t'=>$this->_text,
                                 'd'=>$this->_data,));
    }
}
/*
$test = new cipherText('this is some text.');
$test->digestmod = 'sha1';
$test->length = 10;

$str = sprintf("%s",$test);
print_r($str);

$t2 = new cipherText($str);
print $t2->length;
*/
?>
