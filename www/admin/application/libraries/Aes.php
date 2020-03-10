<?php

//$key = "abcdefghijklmnopqrstuvwxyz123456";
//$text = "imcore.net";
//echo encrypt($key, $text);
//echo "<br>";
//echo decrypt($key, "kWyuTmUELRiREWIPpLy3ZA==");
class Aes {

    public function encrypt($key, $value) {
        $padSize = 16 - (strlen($value) % 16);
        $value = $value . str_repeat(chr($padSize), $padSize);
        $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $value, MCRYPT_MODE_CBC, str_repeat(chr(0), 16));
        return base64_encode($output);
    }

    public function decrypt($key, $value) {
        $value = base64_decode($value);
        $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $value, MCRYPT_MODE_CBC, str_repeat(chr(0), 16));

        $valueLen = strlen($output);
        
        
        print_r($output.$valueLen);        die();
        if ($valueLen % 16 > 0)
            $output = "";

        $padSize = ord($output{$valueLen - 1});

        if (($padSize < 1) or ( $padSize > 16))
            $output = "";                // Check padding.                

        for ($i = 0; $i < $padSize; $i++) {
            if (ord($output{$valueLen - $i - 1}) != $padSize)
                $output = "";
        }
        $output = substr($output, 0, $valueLen - $padSize);

        return $output;
    }

    function replaceEncodeString($string) {
        $ret = strtr($string, array('+' => '.', '=' => '-', '/' => '~'));
        return $ret;
    }

    function replaceDecodeString($string) {
        $ret = strtr($string, array('.' => '+', '-' => '=', '~' => '/'));
        return $ret;
    }
}
