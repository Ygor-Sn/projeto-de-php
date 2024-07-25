<?php
include "conectar.php";
session_start(); //inicar sessão
// Authenticando Sessão
if (!isset($_SESSION['login_session'])) { //se usuario está logado e se tem privilegio de adm
    echo'<center><h1>Login Expirado Ou Você Não Tem Permissão Para Isso!</h1></center>'; //pede pra relogar
    header("refresh:2; url=/index.html"); //redirecionando
    exit();
}

// Verificando e sanitizando os inputs
$email_new = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$senha_new = $_POST['senha_new'] ?? '';
$id_user = $_GET['id_user'] ?? '';
$nome_usuario_new = $_POST['nome_usuario'] ?? '';
$cpf_new = $_POST['cpf'] ?? '';
$admin_new = isset($_POST['admin']) && $_POST['admin'] == 'true' ? 1 : 0;
$admin_master = $_GET['admin_master'] ?? 0;

$dados = $conn->query("SELECT * FROM usuario WHERE id_user != $id_user");
$email_existe = false; // Flag para verificar se o email já existe

while ($linha = $dados->fetch_assoc()) {
    $email_bd = $linha['email']; // Obtém o email do banco de dados
    
    if ($email_new === $email_bd) {
        $email_existe = true; // Marca que o email já existe no banco
        echo "<center><h1>Email já Cadastrado!!!</h1></center>"; // Informa ao usuário
        header("refresh:2;url=" . $_SERVER['HTTP_REFERER']); // Recarrega a página após 2 segundos
        exit; // Encerra o script após redirecionar
    }
}
if ($senha_new == null) { //se a nova senha for nula
    $login = $conn->query("SELECT * FROM usuario WHERE id_user = '$id_user'");// seleciona todos do banco pela ordem do admin descresente
    $linha = mysqli_fetch_array($login);//le linha por linha da tabela até retornar null

    if ($admin_master == 1) { // se o admin_master do atualizar for 1
        if ($senha == null) { //se a senha for nula
            $stmt = $conn->prepare("UPDATE usuario SET cpf = ?, email = ?, nome_usuario = ?, admin = ? WHERE id_user = ?"); // prepara a query 
            $stmt->bind_param("issii", $cpf_new, $email_new, $nome_usuario_new, $admin_new, $id_user);// troca ? pelas informações
        } else {
            $hashed_pass = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 10]);//criptografa a senha 
            $stmt = $conn->prepare("UPDATE usuario SET cpf = ?, email = ?, nome_usuario = ?, admin = ?, senha = ? WHERE id_user = ?");
            $stmt->bind_param("issisi", $cpf_new, $email_new, $nome_usuario_new, $admin_new, $hashed_pass, $id_user);
        }
        $stmt->execute(); //executa a query
        echo "<center><h1>Atualizando...</h1></center>";
        header("refresh:2;url=tela_adm.php");
    } else {
        $login = $conn->query("SELECT * FROM usuario WHERE id_user=$id_user");// seleciona as informações do id_user
    
        while ($linha = mysqli_fetch_array($login)) {//le linha por linha da tabela até retornar null
            $hashed_pass = $linha['senha']; //le a senha criptografada
        }

        if (!password_verify($senha, $hashed_pass)) { //se a senha inserida nao bater com a do banco
            echo "<center><h1>Senha Errada!</h1></center>";
            header("refresh:2;url=" . $_SERVER['HTTP_REFERER']);//retorna para pagina anterior
            exit();//termina o script
        } else {//senao
            $hashed_pass = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 10]);//scriptografa a senha
            $stmt = $conn->prepare("UPDATE usuario SET cpf = ?, email = ?, nome_usuario = ?, admin = ?, senha = ? WHERE id_user = ?"); //prepara a consulata
            $stmt->bind_param("issisi", $cpf_new, $email_new, $nome_usuario_new, $admin_new, $hashed_pass, $id_user);// troca os ? pelos valores
            $stmt->execute();// executa a query
            echo "<center><h1>Atualizando...</h1></center>";
            header("refresh:2;url=tela_user.php");
        }
    }
} else { //repete o mesmo processo do adm com uma diferença do user
    $login = $conn->query("SELECT * FROM usuario WHERE id_user=$id_user");
    while ($linha = mysqli_fetch_array($login)) {
        $hashed_pass = $linha['senha'];
    }

    if ($admin_master == 1) {
        if ($senha == null) {
            $stmt = $conn->prepare("UPDATE usuario SET cpf = ?, email = ?, nome_usuario = ?, admin = ? WHERE id_user = ?");
            $stmt->bind_param("issii", $cpf_new, $email_new, $nome_usuario_new, $admin_new, $id_user);
        } else {
            $hashed_pass = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 10]);
            $stmt = $conn->prepare("UPDATE usuario SET cpf = ?, email = ?, nome_usuario = ?, admin = ?, senha = ? WHERE id_user = ?");
            $stmt->bind_param("issisi", $cpf_new, $email_new, $nome_usuario_new, $admin_new, $hashed_pass, $id_user);
        }
        $stmt->execute();
        echo "<center><h1>Atualizando...</h1></center>";
        header("refresh:2;url=tela_adm.php");
    } else {
        if (!password_verify($senha, $hashed_pass)) { //faz a validação da senha
            $_SESSION['error_message'] = 'Email ou senha inválidos!';
            echo "<center><h1>Senha Errada!</h1></center>";
            header("refresh:2;url=" . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $hashed_pass = password_hash($senha_new, PASSWORD_BCRYPT, ['cost' => 10]); //se passa na validação criptografa a nova senha
            $stmt = $conn->prepare("UPDATE usuario SET nome_usuario = ?, cpf = ?, email = ?, senha = ?, admin = ? WHERE id_user = ?");
            $stmt->bind_param("sissii", $nome_usuario_new, $cpf_new, $email_new, $hashed_pass, $admin_new, $id_user);
            $stmt->execute();
            echo "<center><h1>Atualizando...</h1></center>";
            header("refresh:2;url=tela_user.php");
        }
    }
}



