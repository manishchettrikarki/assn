<?php




if(!function_exists('help_generateRandomString')){
    function help_generateRandomString($length=4){
        /*
         * inherited from
         * https://stackoverflow.com/a/13733588/8489719
         * */

        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet);

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }

        return $token;
    }
}

if(!function_exists('site')){
    function site($key=null, $default=null){
        return Setting::get($key, $default);
    }
}

if(!function_exists('social')){
    function social($key,$default=null){
        return Social::getFirst($key,$default);
    }
}
