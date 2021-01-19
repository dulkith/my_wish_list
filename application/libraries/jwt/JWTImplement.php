<?php

use Firebase\JWT\JWT;

require_once APPPATH.'/libraries/jwt/JWT.php';

class JWTImplement {

    PRIVATE $key = "dukawishlistIIT12215";

    public function newAccessToken($data){
        $jwt = JWT::encode($data, $this->key);
        return $jwt;
    }

    public function decodeAccessToken($token){
            $decoded = JWT::decode($token, $this->key, array('HS256'));
            $decodedData = (array)$decoded;
            return $decodedData;
    }
}

?>