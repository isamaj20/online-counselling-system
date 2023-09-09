<?php

function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $secret_key = 'muni';
    $secret_iv = 'muni123';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
    	//decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}
//Call this encryptor function like this for encryption
//
//encryptor(‘encrypt’, 5);
//
//and for decryption
//
//encryptor(‘decrypt’, ‘cjhwYlZ6RFdmU0dBbFdLSlBzZXZtUT09’).
//This is one example on how to encrypt and decrypt the URL in your system. You can't use this if you are using Drupals menu system where a certain segment should be the encrypted part because this encrypted string can contain slashes and make the call and arguments distributed in an uncontrolled way.
//
//Your planned URL:
//mysite.se/mymodulepath/EnCrYptedParTOne/EnCrYptedParTTwo
//...can end up like:
//mysite.se/mymodulepath/EnCrYpt/dParTOne/EnC//YptedParTTwo
//
//But if you send it like a GET value it works like a charm.
//mysite.se/mymodulepath?x=EnCrYptedParTOne&y=EnCrYptedParTTwo
//..and fetch it with $_GET['x'] and $_GET['y'].

function encrypt_url($string) {
  $key = "MAL_979805"; //key to encrypt and decrypts.
  $result = '';
  $test = "";
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)+ord($keychar));

     $test[$char]= ord($char)+ord($keychar);
     $result.=$char;
   }

   return urlencode(base64_encode($result));
}

function decrypt_url($string) {
    $key = "MAL_979805"; //key to encrypt and decrypts.
    $result = '';
    $string = base64_decode(urldecode($string));
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)-ord($keychar));
     $result.=$char;
   }
   return $result;
}
//EDIT:
//In this case I was building a system that needed to receive some input from a unauthorized user in a already existing system that is configured to receive data from the URL with a pattern like : /aaa/bbb/ccc etc. Just a regular cusomized module with hook_menu and function receiving the path and doing some operation. Can't even remember what project this was from, but I guess the path contained a user reference, some user given value and some password hash. So my first thought was to encrypt the whole URL, but since it can get extra slashes "/" within the encrypted section of the path, it will get corrupted. So the solution here is to use GET insted and use different parameters insted of slashes.
//
//Knowledge keywords: 
//Drupal 6.x
//PHP
//encryption
//Related: 
//Simple way to encrypt and decrypt
?>