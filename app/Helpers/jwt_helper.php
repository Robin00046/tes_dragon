<?php

use App\Models\Model_users;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($usersheader)
{
    if (is_null($usersheader)) {
        throw new Exception("Otentikasi Gagal");
    }
    return explode(" ", $usersheader)[1];
}
function validateJWT($encodedToken)
{
    $key = getenv('JWT_SECRET_KEY');
    $decodedToken = JWT::decode($encodedToken, new key($key, 'HS256'));
    $modelusers = new Model_users();

    $modelusers->getEmail($decodedToken->email);
}
function createJWT($email)
{
    $waktuRequest = time();
    $waktuToken = getenv('JWT_TIME_TO_LIVE');
    $waktuExpired = $waktuRequest + $waktuToken;
    $payload = [
        'email' => $email,
        'iat' => $waktuRequest,
        'exp' => $waktuExpired
    ];
    $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'), 'HS256');
    return $jwt;
}
