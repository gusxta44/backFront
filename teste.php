<?php 
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/passwordController.php';
require_once __DIR__ . "/helpers/jwt/jwt_include.php";
$title = "HOME";

$data = [
    'email'=>'mateus@gmail.com',
    'password'=>'1234'
];

//AuthController::login($conn, $data);

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJtZXVzaXRlIiwiaWF0IjoxNzU2OTI2OTAxLCJleHAiOjE3NTY5MzA1MDEsInN1YiI6eyJpZCI6MSwibm9tZSI6Ik1hdGV1cyIsImVtYWlsIjoibWF0ZXVzQGdtYWlsLmNvbSIsImNhcmdvcyI6IkdlcmVuY2lhIn19.YaTAkyGcP1pB4AhhEWeDWL5sxLuTe2Mflwb5RtXfyVc';
echo validateToken($token);
//echo passwordController::passwordHash($data,['password']);

//echo password_hash("teste123",  PASSWORD_BCRYPT);

//$oi = '$2y$10$j/nTs8hD8hTMlWkPPRlUq.vvKyCn6mVk.zJiBg94Qd.MvdvuBXnbW';

//echo password_verify("teste123", $oi);

//echo passwordController::passwordVerificar($data,['password']);



?>