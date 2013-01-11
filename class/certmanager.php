<?
class certManager{
    public function __construct($user){
        global $database;
        $this->db = $database;
        $this->u = $user;

        $this->readAllCertificates();
    }
    private function readAllCertificates(){        
        $userq = $this->db->querySQL("SELECT * FROM certs
                                      WHERE userid = '{$this->u->userid}'");
        if(count($userq)<1)
            return false;
        
        $this->certificates = array();
        foreach($userq as $cert){
            try{
                $c = new Certificate(base64_decode($userq['content']));
            }catch(Exception $e){
                continue;
            }
            $this->certificates[] = $c;
        }
    }
}
?>
