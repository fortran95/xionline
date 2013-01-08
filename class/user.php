<?
class User{
    public function __construct($userid,
                                $username,
                                $rawpass){
        global $database;
        $this->db = $database;

        $this->userid = $userid;
        $this->username = $username;

        $this->jabber = $this->getJabberAccounts();
    }
    private function getJabberAccounts(){
        # TODO decrypt & load Jabber Accounts for this user.
    }
}
?>
