<?php 
include "conectar.php";
session_start();
// Authenticando Sessão
if (!isset($_SESSION['login_session'])) { //se usuario está logado e se tem privilegio de adm
  echo'<center><h1>Login Expirado Ou Você Não Tem Permissão Para Isso!</h1></center>'; //pede pra relogar
  header("refresh:2; url=/index.html"); //redirecionando
  exit();
}

$id_user = $_GET['id_user'];// pega o id da url
$admin_master = $_SESSION['admin_session'];// joga o a informação de admin em outra variavel
$dados = $conn->query("SELECT * FROM usuario WHERE id_user = $id_user");// seleciona todos do banco pela ordem do admin descresente
while ($linha = $dados->fetch_assoc()) {//le linha por linha da tabela até retornar null
  $nome_usuario = $linha['nome_usuario'];
  $cpf = $linha['cpf'];
  $email = $linha['email'];//$email busca a informação,['email'] define qual é o nome da linha
  $senha = $linha['senha'];
  $admin = $linha['admin'];
  $id_user = $linha['id_user'];
}

$checkbox = ($admin == 1) ? "checked" : ""; // se o adm for igual 1 exibe checked e a checkbox fica marcada, se nao exibe nada

// logo a baixo um heredoc de html para incorporar dentro do php e fazer uma exibição condicional
$tela_admin = <<<HTML
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Atualização de Usuário</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
  <main class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center mb-4">Atualização de Informações</h5>
            <form action="atualizando.php?id_user=$id_user&admin_master=$admin_master" method="post"
              enctype="multipart/form-data">

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId"
                  placeholder="Digite seu email" value="{$email}" maxlength="64">
              </div>
              <div class="mb-3">
                <label for="nome_usuario" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome_usuario" id="nome_usuario" maxlength="50" placeholder="Seu nome"
                  value="{$nome_usuario}">
              </div>
              <div class="mb-3">
                <label for="senha" class="form-label">Atualizar Senha</label>
                <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha" maxlength="15">
              </div>
              <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="number" class="form-control" name="cpf" id="cpf" placeholder="111.222.333-04" min="10000000000" max="99999999999"
                  value="{$cpf}">
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="true" id="admin" name="admin" $checkbox > <!-- exibe o resultado do checkboxs -->
                <label class="form-check-label" for="admin">
                  Privilegios de Administrador
                </label>
              </div>
              <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-yiBpBQg/3mKvJj2fcqcu8hV+bvnMMI8t72Z9tmcrWJTxUtmOsPQ+0AZa46s8yoiv"
    crossorigin="anonymous"></script>
</body>

</html>


HTML;

$tela_user = <<<HTML
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Atualização de Usuário</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
  <main class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center mb-4">Atualização de Informações</h5>
            <form action="atualizando.php?id_user=$id_user&admin_master=$admin_master" method="post"
              enctype="multipart/form-data">

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId"
                  placeholder="Digite seu email" value="{$email}" maxlength="64">
              </div>
              <div class="mb-3">
                <label for="nome_usuario" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome_usuario" id="nome_usuario"
                  placeholder="Seu nome" value="{$nome_usuario}" maxlength="50">
              </div>
              <div class="mb-3">
                <label for="senha" class="form-label">Confirme a Senha</label>
                <input type="password" class="form-control" name="senha" id="senha" value="" required maxlength="15">
              </div>
              <div class="mb-3">
                <label for="senha_new" class="form-label">Senha Nova</label>
                <input type="password" class="form-control" name="senha_new" id="senha_new"
                  placeholder="Caso Não Queira Alterar A Senha, Não Coloque Nada No Campo" maxlength="15">
              </div>
              <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="number" class="form-control" name="cpf" id="cpf" placeholder="111.222.333-04"
                  value="{$cpf}" min="10000000000" max="99999999999">
              </div>
              <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-yiBpBQg/3mKvJj2fcqcu8hV+bvnMMI8t72Z9tmcrWJTxUtmOsPQ+0AZa46s8yoiv"
    crossorigin="anonymous"></script>
</body>

</html>

HTML;

if ($admin_master == 1){ // se o usuario logado for admin 
  echo"$tela_admin"; // exibe a tela admin
} else {
  echo"$tela_user";// senao a tela de user
};

?>
