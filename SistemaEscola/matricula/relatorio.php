<html>

<head>
    <title>Relatorio de Matriculas</title>
</head>

<body>
    <form method="post">
        <table class="table">
            <tr>
                <h2>Relatorio de Matricula</h2> <input type="submit" name="voltar" value='Voltar'><BR><BR><BR>
                <td>Digite o codigo da matricula: </td>
                <td><input class="form-control" type="text" name="cod_matricula"></td>
                <td>&nbsp<input type="submit" name="buscar" value='Buscar Cadastro'></td>
                <td>&nbsp<input type="submit" name="alterar" value='Alterar Cadastro'></td>
                <td>&nbsp<input type="submit" name="excluir" value='Excluir Cadastro'></td>
            </tr>
            <tr>
                <td><BR><input type="submit" name="listar" value='Listar Todos os Cadastros'></td>
            </tr>
        </table>
    </form>
</body>

</html>

<?php

session_start();
if (isset($_SESSION['cod_matricula'])) {
    unset($_SESSION['cod_matricula']);
}

if (isset($_POST['voltar'])) {
    header('Location:../index.php');
}

if (isset($_POST['buscar'])) {
    if (empty($_POST['cod_matricula'])) {
        echo "Digite o codigo da matricula.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $cod_matricula = $_POST['cod_matricula'];

                $query = "SELECT * FROM matricula WHERE cod_matricula = '$cod_matricula'";
                $result_query = mysqli_query($con, $query);
                $row_matricula = mysqli_fetch_assoc($result_query);

                if ($row_matricula > 0) {
                    echo "<b>" . "Codigo da Matricula: " . $row_matricula['cod_matricula'] . "</b>" . "<br>" . "Materia: " . $row_matricula['matri_materia'] . "<br>" . "Aluno: " . $row_matricula['matri_aluno'] . "<br>" . "Professor: " . $row_matricula['matri_prof'] . "<br>" . "<br>";
                } elseif ($row_matricula == 0) {
                    echo "Matricula nao encontrada.";
                }
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao pesquisar." . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
            mysqli_close($con);
        }
    }
}

if (isset($_POST['alterar'])) {
    if (empty($_POST['cod_matricula'])) {
        echo "Digite o codigo da matricula.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $cod_matricula = $_POST['cod_matricula'];

                $query = "SELECT * FROM matricula WHERE cod_matricula = '$cod_matricula'";
                $result_query = mysqli_query($con, $query);
                $row_matricula = mysqli_fetch_assoc($result_query);

                if ($row_matricula > 0) {
                    header('Location:alterar.php');
                    session_start();
                    $_SESSION['cod_matricula'] = $cod_matricula;
                } elseif ($row_matricula == 0) {
                    echo "Matricula nao encontrada.";
                }
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao localizar cadastro." . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
            mysqli_close($con);
        }
    }
}

if (isset($_POST['excluir'])) {
    if (empty($_POST['cod_matricula'])) {
        echo "Digite o codigo da matricula.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $cod_matricula = $_POST['cod_matricula'];

                $query = "DELETE FROM matricula WHERE cod_matricula = '$cod_matricula'";
                $result_query = mysqli_query($con, $query);
                $sucess = mysqli_affected_rows($con);
                if ($result_query == true) {
                    if ($sucess != 0) {
                        echo "Matricula excluida.";
                    } else {
                        echo 'Nenhuma matricula excluida, verifique o codigo inserido.';
                    }
                } else {
                    echo "Erro ao excluir." . mysqli_connect_error();
                }
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao excluir." . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
        }
        mysqli_close($con);
    }
}

if (isset($_POST['listar'])) {
    $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

    if (!$con) {
        echo "Erro ao conectar no banco" . mysqli_connect_errno();
    } else {
        try {
            $query = "SELECT * FROM matricula";
            $result_query = mysqli_query($con, $query);

            while ($row_matricula = mysqli_fetch_assoc($result_query)) {
                echo "<b>" . "Codigo da Matricula: " . $row_matricula['cod_matricula'] . "</b>" . "<br>" . "Materia: " . $row_matricula['matri_materia'] . "<br>" . "Aluno: " . $row_matricula['matri_aluno'] . "<br>" . "Professor: " . $row_matricula['matri_prof'] . "<br>" . "<br>";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Erro ao listar" . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
        }
        mysqli_close($con);
    }
}
?>