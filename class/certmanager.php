<?
class certManager{
    public function __construct($user){
        global $database;
        $this->db = $database;
        $this->u = $user;

        $this->readAllCertificates();
    }
    public function insertCertificate($xml){
    }
    public function insertSignature($xml){
        /* TODO
         *  1) use *cryptsuite* to find out from and to whom this signature is.
         *  2) load both certificates and verify this signature.
         *  3) load the signature.
         */
    }
    public function insertRevocation($xml){
    }
    public function markCertificate($id, $level){
    }
    public function deleteCertificate($id){
    }
    private function readAllCertificates(){        
        $this->certificates = array();

        $userq = $this->db->querySQL("SELECT * FROM certs
                                      WHERE userid = '{$this->u->userid}'");
        if(count($userq)<1)
            return false;
        
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
