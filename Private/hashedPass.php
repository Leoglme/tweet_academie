<?php 

class HashedPass {

    private $password;
    private $hashedPass;

    function __construct($password) {
        $this->password = $password;
    }

    public function hashedPassRip160() {
        $salt = "vive le projet tweet_academy";
        
        $this->hashedPass = hash('ripemd160', $this->password . $salt);
        return $this->hashedPass;
    }
}