<?php 
namespace Zems;
class Hash
{
    public static function token($data){
        $rand1 = self::rand_gen(4);
        $rand2 = self::rand_gen(4);
        $set_token = self::hash5(self::token_origin($data));
        return (object)['code'=>$rand1.$data.$rand2, 'set'=>$set_token];
    }
    public static function rand_gen($length = 3){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public static function find_key(){ 
        $originalString = $_POST['token'];
        // $originalString = "Hello World";
        $numCharsToSplit = 4;

        // Get the part of the string before the last few characters
        $beforeLastChars = substr($originalString, 0, -$numCharsToSplit);

        // Get the last few characters
        $lastChars = substr($beforeLastChars,  $numCharsToSplit);
        return $lastChars;
    }
    public static function token_find($originalString){ 
        // $originalString = "Hello World";
        $numCharsToSplit = 4;

        // Get the part of the string before the last few characters
        $beforeLastChars = substr($originalString, 0, -$numCharsToSplit);

        // Get the last few characters
        $lastChars = substr($beforeLastChars,  $numCharsToSplit);

        // echo "Before Last Characters: " . $beforeLastChars . "\n";
        // echo "Last Characters: " . $lastChars . "\n";
        // $origin_data = self::token_origin($lastChars);
        return $lastChars;
    }
    public static function token_origin($data){ 
        // $origin_data = self::token_find($data);
        // return [$data, $origin_data];
        $referrer = $_SERVER['HTTP_REFERER'];
        // echo "Ref:". $referrer." === ";
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        // echo "Your IP Address is " . $ipaddress." == ";
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        // echo  $user_agent . "\n\n === ";
        $tkn = $referrer.$ipaddress.$data.$user_agent;
        return $tkn;
    }
    public static function hash5($data){ 
        $enc = password_hash($data,PASSWORD_DEFAULT);
        return $enc;
    }
    public static function hash_verify($data, $hash){ 
        // Verify the hash against the password entered
        $verify = password_verify($data, $hash);
        if ($verify) {
            // echo 'Password Verified!';
            return true;
        } else {
            // echo 'Incorrect Password!';
            return false;
        }
    }
}