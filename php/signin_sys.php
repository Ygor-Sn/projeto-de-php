<?php
include "conectar.php";//incluir sistema de conexao com banco
$dados = $conn->query("SELECT * FROM usuario"); //seleciona todo da tabela do banco
$nome_usuario = $_POST['nome_usuario'];
$cpf = $_POST['cpf'];
$admin = 0; //todos usuarios novos nao terao privilegios de adm, só vão ganhar apenas se outro adm der
$email = $_POST['email'];
$senha = $_POST['senha']; // pega as variaveis do forms de criação de conta
$hasing_pass = password_hash($senha, PASSWORD_BCRYPT,['cost' => 10]); // criptografa a senha antes de salvar no banco

while ($linha = $dados->fetch_assoc()) {// faz e leitura constante no banco
    $email_bd = $linha['email']; //verificar sem em alguma linha da coluna email existe o email da criação de conta
}if ($email === $email_bd){ //se existe
    echo "<center><h1>Email já Cadastrado!!!</h1><center>"; // informa ao usuario
    header("refresh:2, signin_sys.php"); // recarrega a pagina
} else { //senao
    $conn->query("INSERT INTO usuario (id_user,nome_usuario,cpf,email,senha,admin) VALUES (NULL, '$nome_usuario','$cpf','$email','$hasing_pass','$admin')"); // insere os dados no banco na sequencia da primeira () lebrano que o id_user sempre será null para que o banco possa atribuir-lo
    echo "<center><h1>Cadastrado Com Sucesso!</h1><center>";
    $login = $conn->query("SELECT * FROM usuario WHERE email = '$email'"); // realiza uma busca do email atual no banco
    while ($linha = mysqli_fetch_array($login)) { // leitura das informações do usuario
        $id_user = $linha['id_user']; // pega o id_user
    }
    session_start(); //inicia a sessao
    $_SESSION['login_session'] = $email; //atribui todas as informações exeto senha na sessão para ser usado entre paginas
    $_SESSION['id_user_session'] = $id_user;
    $_SESSION['nome_usuario_session'] = $nome_usuario;
    $_SESSION['cpf_session'] = $cpf;
    $_SESSION['admin_session'] = $admin;
    $_SESSION['id_user_session'] = $id_user;// 1 vem a sessão, depois o nome que vai ser chamar a variavel global e por ultimo da onde vem seu valor
    header("refresh:10; url=tela_user.php");//vá para tela de usuario
}