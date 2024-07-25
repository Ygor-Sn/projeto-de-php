<!-- diferença dessa pagina para a index.html é a adição de da div de alert-danger  -->
<!DOCTYPE html> 
<html lang="pt-br">

<head>
  <title>Tela de Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <main class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center mb-4">Login</h5>
            <form action="login_sys.php" method="post">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu email">
              </div>
              <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha">
              </div>
              <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
            <br>
            <div class="alert alert-danger" role="alert">
            <center>Email Ou Senha Invalidos!!!</center>
            </div>
            <div class="mt-3 text-center">
              <a href="/html/cadastro.html">Criar Conta</a>
            </div>
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
