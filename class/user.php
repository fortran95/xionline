<?
class User{
    public function __construct($userid,
                                $username,
                                $rawpass){
        global $database;
        $this->db = $database;

        $this->userid = $userid;
        $this->username = $username;

        $this->certs = $this->getCerts();
    }
    private function getCerts(){        
        $userq = $this->db->querySQL("SELECT * FROM certs
                                      WHERE userid = '{$this->userid}'");
        if(count($userq)<1)
            return false;
        
        $returnValue = array();
        foreach($userq as $cert)
            $returnValue[] = (new Certificate($userq['content'])); 
        
        return $returnValue;
    }
}
?>
