<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastro.css">
    <title>Cadastro de Acesso</title>
</head>

<body>
    <h1>Cadastro de Acesso</h1>
    <div class="container">
        <form method="post">
            <table class="table">
                <tr>
                    <td>Codigo de Acesso: </td>
                    <td><input class="form-control" type="user" name="cod_acesso"></td>
                </tr>
                <tr>
                    <td>Senha: </td>
                    <td><input class="form-control" type="password" name="senha"></td>
                </tr>
                <tr>
                    <td>Nome: </td>
                    <td><input class="form-control" type="text" name="usuario"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="cadastrar" value='Cadastrar'></td>
                </tr>
                <tr>
                    <td><input type="submit" name="voltar" value='Voltar'></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>

<?php

if (isset($_POST['voltar'])) {
    header('Location:form.php');
}

if (isset($_POST['cadastrar'])) {
    if (empty($_POST['cod_acesso'])) {
        echo "Prencha o codigo de acesso.";
    } elseif (empty($_POST['senha'])) {
        echo "Prencha a senha.";
    } elseif (empty($_POST['usuario'])) {
        echo "Prencha o nome de usuario.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $cod_acesso = $_POST['cod_acesso'];
                $senha = $_POST['senha'];
                $usuario = $_POST['usuario'];

                $query = "INSERT INTO login (cod_acesso, senha, nome_usuario) VALUES ('$cod_acesso', '$senha', '$usuario')";
                $result_query = mysqli_query($con, $query);

                if ($result_query == true) {
                    echo "Usuario cadastrado.";
                } else {
                    echo "Erro ao cadastrar, confira o codigo de acesso inserido." . mysqli_connect_error();
                }
                mysqli_close($con);
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao cadastrar" . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
        }
    }
}
