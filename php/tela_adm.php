<?php
session_start();

// Authenticando Sessão
if (!isset($_SESSION['login_session']) || $_SESSION['admin_session'] != 1) { //se usuario está logado e se tem privilegio de adm
    echo'<center><h1>Login Expirado Ou Você Não Tem Permissão Para Isso!</h1></center>'; //pede pra relogar
    header("refresh:2; url=/index.html"); //redirecionando
    exit(); //termina o codigo
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Lista de Usuários</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <main class="container mt-5">
        <h3 class="text-center mb-4">Lista de Usuários</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id Usuário</th>
                        <th>Nome Usuário</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Privilegios de Administrador</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "conectar.php";//inclui a conexão
                    $admin_master = $_SESSION['admin_session'];//pega o $admin e joga em outra variavel
                    $dados = $conn->query("SELECT * FROM usuario ORDER BY admin desc");// seleciona todos do banco pela ordem do admin descresente
                    while ($linha = $dados->fetch_assoc()) { //le linha por linha da tabela até retornar null
                        $id_user = $linha['id_user'];
                        $nome_usuario = $linha['nome_usuario'];
                        $cpf = $linha['cpf'];
                        $email = $linha['email'];//$email busca a informação,['email'] define qual é o nome da linha
                        $admin = $linha['admin'];

                        echo "<tr>
                            <td>$id_user</td>
                            <td>$nome_usuario</td>
                            <td>$cpf</td>
                            <td>$email</td>
                            <td>$admin</td>
                            <td>
                                <a href='atualizar.php?id_user=$id_user' class='btn btn-sm btn-info'>Editar</a>
                                <a href='apagar.php?id_user=$id_user' class='btn btn-sm btn-danger'>Excluir</a>
                            </td>
                        </tr>";
                        //exibe as informações em linha e joga o id_user na url 
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="sair.php" class="btn btn-danger">Sair</a>
    </main>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>
</body>

</html>