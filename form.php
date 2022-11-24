<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/form.css">
    <title>Sistema Escolar</title>
</head>

<body>
    <div class="container">
        <h1>Sistema Escolar</h1>
        <form method="post">
            <table class="table">
                <tr>
                    <td class="texto">Codigo de Acesso: </td>
                    <td><input class="form-control" type="user" name="cod_acesso"></td>
                </tr>
                <tr>
                    <td class="texto">Senha: </td>
                    <td><input class="form-control" type="password" name="senha"></td>
                </tr>
            </table>
            <table class="botoes">
                <tr>
                    <td><input type="submit" name="logar" value='Login'></td>
                </tr>
                <tr>
                    <td><input type="submit" name="cadastrar" value='Cadastrar'></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
<?php
session_start();
if (isset($_SESSION['login']) and (isset($_SESSION['senha']))) {
    header('Location:index.php');
}

if (isset($_POST['logar'])) {
    $cod_acesso = $_POST['cod_acesso'];
    $senha = $_POST['senha'];
    include 'autenticacao_login.php';
}

if (isset($_POST['cadastrar'])) {
    header('Location:cadastro.php');
}

if (isset($_COOKIE['status_login'])) {
    if ($_COOKIE['status_login'] == 'true') {
        echo 'Codigo de acesso ou senha invalidos.';
        setcookie('status_login', 'false');
    }
}
