<?
$REALPATH = dirname(__FILE__);
include("$REALPATH/smarty/Smarty.class.php");

class Render extends Smarty {

   function __construct()
   {

        // Class Constructor.
        // These automatically get set with each new instance.
        global $REALPATH;

        parent::__construct();

        $this->setTemplateDir("$REALPATH/../templates/");
        $this->setCompileDir("$REALPATH/../templates_c/");
#        $this->setConfigDir('/web/www.example.com/guestbook/configs/');
        $this->setCacheDir("$REALPATH/../cache/");

        $this->caching = 0;#Smarty::CACHING_LIFETIME_CURRENT;
#        $this->assign('app_name', 'Guest Book');
   }

}
?>
