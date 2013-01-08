<?
function getSessionFingerprint(){
    global $_SERVER;
    $s1 = isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'';
    $s2 = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'';
    $s3 = session_id();
    return sha1("$s1;$s2;$s3");
}
function signSessionFingerprint($key){
    return hash_hmac('sha1',getSessionFingerprint(),$key);
}
function verifySessionFingerprint($key,$validator){
    return signSessionFingerprint($key) == $validator;
}
?>
