<?php
session_start();
if (!isset($_SESSION['login_session'])) { // verificar se $_session não está definida
  echo'<center><h1>Login Expirado! Logue Novamente!</h1></center>';// texto para usuario
  header("refresh:2; url=/index.html");// joga para logar novamente
  exit();// termina o codigo
}
else if ($_SESSION['admin_session'] == 1) { //verifica se é adm
  header('Location: tela_adm.php'); //se for joga para página certa
  exit();//termina o codgio
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Perfil do Usuário</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


  <main class="container mt-5">
    <h3 class="text-center mb-4">Bem-Vindo <?php $nome_usuario = $_SESSION['nome_usuario_session']; echo"$nome_usuario";  ?>!</h3>
    <ul class="list-group">
      <?php
      include "conectar.php";//inclui a conexão
      $id_user = $_SESSION['id_user_session'];//pega o id do usuario logado
      $dados = $conn->query("SELECT * FROM usuario where id_user = $id_user"); //seleciona todo dele no banco
      while ($linha = $dados->fetch_assoc()) { //le linha por linha da tabela até retornar null
        $id_user = $linha['id_user'];
        $nome_usuario = $linha['nome_usuario'];
        $cpf = $linha['cpf'];
        $email = $linha['email'];//$email busca a informação,['email'] define qual é o nome da linha

        echo "<li class='list-group-item'>Id Usuário: $id_user</li>
              <li class='list-group-item'>Nome Usuário: $nome_usuario</li>
              <li class='list-group-item'>CPF: $cpf</li>
              <li class='list-group-item'>Email: $email</li>";
              //exibe as informações em linha
      }
      ?>
    </ul>
    <div class="d-grid mt-3">
      <a href="atualizar.php?id_user=<?php echo $id_user; ?>" class="btn btn-primary">Editar</a> <!-- passa o id para url do atualizar -->
      <a href="sair.php" class="btn btn-danger">Sair</a>
    </div>
  </main>



  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
    crossorigin="anonymous"></script>
</body>

</html>