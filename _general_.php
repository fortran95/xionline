<?
$basepath = dirname(__FILE__);

# Read in user configuration
include("$basepath/config/database.php");
include("$basepath/config/security.php");

###############################################################################

# Below inclusions, defining classes that may exists in sessions, should be
# done with priority.
include("$basepath/class/user.php");



# Authenticate a session
include("$basepath/lib/authenticate.php");
session_start();
$__validator = isset($_COOKIE['validator'])?$_COOKIE['validator']:'';
if(!verifySessionFingerprint($_unique_key, $__validator)){
    unset($_SESSION['user']);
    session_regenerate_id(True);
} else
    session_regenerate_id();
$__validator = signSessionFingerprint($_unique_key);
setcookie('validator',$__validator);



# Connect Database
include("$basepath/class/database.php");
switch($_database_credentials['type']){
    case 'mysql':
        $database = new MySQL($_database_credentials['server'],
                              $_database_credentials['user'],
                              $_database_credentials['password'],
                              $_database_credentials['dbname']);
        break;
}


include("$basepath/lib/security.php");
include("$basepath/class/usermanager.php");
include("$basepath/class/certificate.php");
include("$basepath/class/time.php");
include("$basepath/lib/smarty.php");

$render = new Render();
?>
