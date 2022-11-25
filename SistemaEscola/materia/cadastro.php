<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastro.css">
    <title>Cadastro de Materia</title>
</head>

<body>
    <h1>Cadastro de Materia</h1>
    <form method="post">
        <div class="container">
            <table class="table">
                <tr>
                    <td>Codigo da Materia: </td>
                    <td><input class="form-control" type="text" name="cod_materia"></td>
                </tr>
                <tr>
                    <td>Nome: </td>
                    <td><input class="form-control" type="text" name="nome_materia"></td>
                </tr>
                <tr>
                    <td>Carga horaria: </td>
                    <td><input class="form-control" type="text" name="carga_horaria"></td>
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
    if (empty($_POST['cod_materia'])) {
        echo "Prencha o codigo da materia.";
    } elseif (empty($_POST['nome_materia'])) {
        echo "Prencha o nome da materia.";
    } elseif (empty($_POST['carga_horaria'])) {
        echo "Prencha a carga horaria da materia.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $cod_materia = $_POST['cod_materia'];
                $nome_materia = $_POST['nome_materia'];
                $carga_horaria = $_POST['carga_horaria'];

                $query = "INSERT INTO materia (cod_materia, nome_materia, carga_horaria) VALUES ('$cod_materia', '$nome_materia', '$carga_horaria')";
                $result_query = mysqli_query($con, $query);

                if ($result_query == true) {
                    echo "Materia cadastrada.";
                } else {
                    echo "Erro ao cadastrar, confira o codigo inserido e tente novamente." . mysqli_connect_error();
                }
                mysqli_close($con);
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao cadastrar" . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
        }
    }
}
