<?
class cipherText{
    /*
     * cipherText: capsule ciphertext and flags
     */
    function __construct($text,$encode=False){
        if(!$encode){
            try{
                $json = json_decode(gzuncompress(base64_decode($text)));
                if($json && array_key_exists('t',$json) && array_key_exists('d',$json)){
                    $this->_text = $json->t;
                    $this->_data = array();
                    foreach($json->d as $key=>$value)
                        $this->_data[$key] = $value;
                }
            }catch(Exception $e){
                throw CryptoException("failed parsing ciphertext block.");
            }
        } else {
            $this->_text = $text;
            $this->_data = array();
        }
        $this->_encode = $encode;
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
        if($this->_encode)
            return  base64_encode(gzcompress(json_encode(
                        array('t'=>base64_encode($this->_text),
                              'd'=>$this->_data,)
                    )));
        else
            return base64_decode($this->_text);
    }
}
/*
$test = new cipherText(md5('',True),True);
$test->digestmod = 'sha1';
$test->length = 10;

$str = sprintf("%s",$test);
print_r($str);

$t2 = new cipherText($str,False);
print $t2->length;
print sprintf("%s",$t2);
*/
?>
