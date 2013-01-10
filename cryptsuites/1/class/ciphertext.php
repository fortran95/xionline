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
        $this->_text = $text;
        $this->_data = array();
        /* Now detect if text already capsuled. */
    }
    function __set($name,$value){
        if(substr($name,0,1) != '_')
            $this->_data[$name] = $value;
    }
    function __toString(){
        # TODO save values and serialize them.
    }
}
?>
