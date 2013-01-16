<?
function getRandomString($length,
                         $vocabulary = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'
                        ){
    $ret = '';
    $maxrnd = strlen($vocabulary) - 1;
    for($i=0;$i<$length;$i++)
        $ret .= $vocabulary[rand(0,$maxrnd)];
    return $ret;
}
?>
