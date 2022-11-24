<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastro.css">
    <title>Cadastro de Professor</title>
</head>

<body>
    <h1>Cadastro de Professor</h1>
    <form method="post">
        <div class="container">
            <table class="table">
                <tr>
                    <td>Matricula do Professor: </td>
                    <td><input class="form-control" type="text" name="mat_prof"></td>
                </tr>
                <tr>
                    <td>Nome: </td>
                    <td><input class="form-control" type="text" name="nome_prof"></td>
                </tr>
                <tr>
                    <td>E-mail: </td>
                    <td><input class="form-control" type="text" name="email_prof"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="cadastrar" value='Cadastrar'></td>
                </tr>
                <tr>
                    <td><input type="submit" name="voltar" value='Voltar'></td>
                </tr>
            </table>
        </div>
    </form>
</body>

</html>

<?php

if (isset($_POST['voltar'])) {
    header('Location:../index.php');
}

if (isset($_POST['cadastrar'])) {
    if (empty($_POST['mat_prof'])) {
        echo "Prencha a matricula do professor.";
    } elseif (empty($_POST['nome_prof'])) {
        echo "Prencha o nome do professor.";
    } elseif (empty($_POST['email_prof'])) {
        echo "Prencha o E-mail do professor.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $mat_prof = $_POST['mat_prof'];
                $nome_prof = $_POST['nome_prof'];
                $email_prof = $_POST['email_prof'];

                $query = "INSERT INTO professor (mat_prof, nome_prof, email_prof) VALUES ('$mat_prof', '$nome_prof', '$email_prof')";
                $result_query = mysqli_query($con, $query);

                if ($result_query == true) {
                    echo "Professor cadastrado.";
                } else {
                    echo "Erro ao cadastrar, confira a matricula inserida e tente novamente." . mysqli_connect_error();
                }
                mysqli_close($con);
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao cadastrar" . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
        }
    }
}
