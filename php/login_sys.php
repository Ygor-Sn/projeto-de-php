<?php
session_start(); // inicar sessão 
include "conectar.php"; //incluir sistema de conexao com banco

$email = $_POST['email'];
$senha = $_POST['senha']; // pega as informções do forms login
$login = $conn->query("SELECT * FROM usuario WHERE email = '$email'"); // procura o email do forms no banco
$check = mysqli_num_rows($login); // checa se achou
if($check == 0){ // caso não ache
    header("Location: index_erroLogin.php"); // vai para tela de erro login
    exit(); //termina o codigo
}

while ($linha = mysqli_fetch_array($login)) { // leitura das informações do usuario
    $hashed_pass = $linha['senha'];
    if (!password_verify($senha,$hashed_pass)){ //caso senha diferent do banco repede o mesmo precesso se nao achar email
        header("Location: index_erroLogin.php");
        exit();
    }
    $id_user = $linha['id_user']; // caso esteja certo, ira ler o resto das informações
    $nome_usuario = $linha['nome_usuario'];
    $cpf = $linha['cpf'];
    $admin = $linha['admin'];
    
}
    $_SESSION['login_session'] = $email; //atribui todas as informações exeto senha na sessão para ser usado entre paginas
    $_SESSION['id_user_session'] = $id_user;
    $_SESSION['nome_usuario_session'] = $nome_usuario;
    $_SESSION['cpf_session'] = $cpf;
    $_SESSION['admin_session'] = $admin;
    $_SESSION['id_user_session'] = $id_user;// 1 vem a sessão, depois o nome que vai ser chamar a variavel global e por ultimo da onde vem seu valor

if ($admin == 1){// se for adm, vá para pagina de adm, se não pagina de usuario
    header('Location: tela_adm.php');
} else {
    header("Location: tela_user.php");
}