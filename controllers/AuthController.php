<?php
require_once __DIR__ . "/../models/usermodel.php";
require_once __DIR__ . "/../helpers/token_jwt.php";
require_once "passwordController.php";

class AuthController{
    public static function login($conn, $data) {
        $data['email'] = trim($data['email']);
        $data['password'] = trim($data['password']);
 
        if (empty($data['email']) || empty($data['password'])) {
            return jsonResponse([
                "status" => "erro",
                "message" => "Preencha todos os campos!"
            ], 401);
        }
 
        $user = usermodel::validarUser($conn, $data['email'], $data['password']);
        if ($user) {
            $token = createToken($user);
            return jsonResponse([ "token" => $token]);
        } else {
            return jsonResponse([
                "status" => "erro",
                "message" => "Credenciais inválidas!"
            ], 401);
        }
    }
}
 