<?php 
require_once "../config/database.php";
require_once '../controllers/AuthController.php';
$title = "HOME";

$data = [
    'email'=>'gustavo@gmail.com',
    'password'=>'123'
];

AuthController::login($conn, $data);

?>

<h1> TESTE </h1>

<?php 
    require_once 'utils/rodape.php';
?>
       
        