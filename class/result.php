<?
class result{
    protected $type = 'unknown';

    public function getJSON(){
        $ret = array('type'=>$this->type);
        if(isset($this->content)){
            switch($c=$this->content){
                case is_array($c):
                    $ret['data'] = $c;
                    break;
                case is_string($c):
                    # TODO translate
                    break;
                default:
                    break;
            }
        }
        return json_encode($ret);
    }
}
class success extends result{
    protected $type = 'success';

    public function __construct($mixed){
        $this->content = $mixed;
    }
}
class failure extends result{
    protected $type = 'failure';

    public function __construct($mixed){
        $this->content = $mixed;
    }
}

/* Test code
$a = new success('good');
print $a->getJSON();*/
?>
