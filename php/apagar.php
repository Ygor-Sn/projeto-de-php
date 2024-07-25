<?php
session_start(); //inicar sessão
// Authenticando Sessão
if (!isset($_SESSION['login_session']) || $_SESSION['admin_session'] != 1) { //se usuario está logado e se tem privilegio de adm
    echo'<center><h1>Login Expirado Ou Você Não Tem Permissão Para Isso!</h1></center>'; //pede pra relogar
    header("refresh:2; url=/index.html"); //redirecionando
    exit();
}else { // se estiver tudo certo
    include "conectar.php"; // incluir a conexão com banco
    $id_user = $_GET['id_user'];// pega o id da url
    mysqli_query($conn, "DELETE FROM usuario WHERE id_user = $id_user"); // deleta o usuario com base no id
    echo "<center><h1>Apagado!!</h1><center>";
    header("refresh:2; tela_adm.php");// manda de volta para tela de adm
} //processo de authenciar sessão é necessario para impedir uso indevido do sistema de apagar