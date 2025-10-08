<?php 
require_once __DIR__ . "/controllers/AuthController.php";
require_once __DIR__ . "/controllers/quartoController.php";
require_once __DIR__ . "/controllers/passwordController.php";
require_once __DIR__ . "/helpers/jwt/jwt_include.php";
require_once __DIR__ . "/controllers/clientesController.php";

//$title = "HOME";


//quartoController::getAll($conn);

// $data = [
//     "name" => "quartokk",
//     "number" => 20,
//     "qtd_cama_solt" => 300,
//     "qtd_cama_casal" => 200,
//     "preco" => 200,
//     "disponivel" => 1
// ];

//$data = [
     //"email"=>"gustavo@gmail.com",
     //"password"=>"123"
//];


//quartoController::create($conn, $data);

//quartoController::delete($conn, 11);

//AuthController::login($conn, $data);

//$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJtZXVzaXRlIiwiaWF0IjoxNzU2OTI2OTAxLCJleHAiOjE3NTY5MzA1MDEsInN1YiI6eyJpZCI6MSwibm9tZSI6Ik1hdGV1cyIsImVtYWlsIjoibWF0ZXVzQGdtYWlsLmNvbSIsImNhcmdvcyI6IkdlcmVuY2lhIn19.YaTAkyGcP1pB4AhhEWeDWL5sxLuTe2Mflwb5RtXfyVc';
//echo validateToken($token);

//echo password_hash("123",  PASSWORD_BCRYPT);

//echo $data['password'];
//echo passwordController::passwordHash($data['password']);

//echo passwordController::passwordVerificar($data,['password']);

$senha = passwordController::generateHash('12345');
echo $senha;


?>