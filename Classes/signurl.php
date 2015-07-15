<?php
class signurl{
    public static function urlSigner($urlDomain, $urlPath, $partner, $key){
        settype($urlDomain, 'String');
        settype($urlPath, 'String');
        settype($partner, 'String');
        settype($key, 'String');
        $URL_sig = "hash";
        $URL_partner = "asid";
        $URLreturn = "";
        $URLtmp = "";
        $s = "";
        // replace " " by "+"
        if (!(strpos($urlPath, '?'))) {
            $urlPath = $urlPath.'?';
        }
        $urlPath = str_replace(" ", "+", $urlPath);
        // format URL
        if (substr($urlPath, -1) == '?') {
            $URLtmp = $urlPath . $URL_partner . "=" . $partner;
        }
        else {
            $URLtmp = $urlPath . "&" . $URL_partner . "=" . $partner;
        }
        // URL needed to create the tokken
        //$s = $urlPath . "&" . $URL_partner . "=" . $partner . $key;
        $s = $URLtmp . $key;
        $tokken = "";
        $tokken = base64_encode(pack('H*', md5($s)));
        $tokken = str_replace(array("+", "/", "="), array(".", "_", "-"), $tokken);
        $URLreturn = $urlDomain . $URLtmp . "&" . $URL_sig . "=" . $tokken;
        return $URLreturn;
    }

    public static function checkUrl($key) {
        $urlPath = stristr($_SERVER['REQUEST_URI'], '&hash', True);
        $hash = str_replace ($urlPath.'&hash=', '', $_SERVER['REQUEST_URI']);
        // replace " " by "+"
        $urlPath = str_replace(" ", "+", $urlPath);
        $urlPath = str_replace("%22", '"', $urlPath);
        // URL needed to create the tokken
        $s = $urlPath.$key;
        $tokken = "";
        $tokken = base64_encode(pack('H*', md5($s)));
        $tokken = str_replace(array("+", "/", "="), array(".", "_", "-"), $tokken);
        /*var_dump($s);
         var_dump($tokken);
        var_dump($hash);*/
        if ($tokken == $hash) {
            return True;
        }
        else {
            return False;
        }
    }
}