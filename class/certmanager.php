<?
class certManager{
    public function __construct($user){
        global $database;
        $this->db = $database;
    }
    private function readAllCertificates(){        
        $userq = $this->db->querySQL("SELECT * FROM certs
                                      WHERE userid = '{$this->userid}'");
        if(count($userq)<1)
            return false;
        
        $returnValue = array();
        foreach($userq as $cert){
            try{
                $c = new Certificate(base64_decode($userq['content']));
            }catch(Exception $e){
                continue;
            }
            $returnValue[] = $c;
        }
        
        return $returnValue;
    }
}
?>
