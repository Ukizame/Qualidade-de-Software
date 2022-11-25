<html>

<head>
    <title>Relatorio de Materias</title>
</head>

<body>
    <form method="post">
        <table class="table">
            <tr>
                <h2>Relatorio de Materias</h2> <input type="submit" name="voltar" value='Voltar'><BR><BR><BR>
                <td>Digite o codigo da materia: </td>
                <td><input class="form-control" type="text" name="cod_materia"></td>
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
if (isset($_SESSION['cod_materia'])) {
    unset($_SESSION['cod_materia']);
}

if (isset($_POST['voltar'])) {
    header('Location:../index.php');
}

if (isset($_POST['buscar'])) {
    if (empty($_POST['cod_materia'])) {
        echo "Digite o codigo da materia.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $cod_materia = $_POST['cod_materia'];

                $query = "SELECT * FROM materia WHERE cod_materia = '$cod_materia'";
                $result_query = mysqli_query($con, $query);
                $row_materia = mysqli_fetch_assoc($result_query);

                if ($row_materia > 0) {
                    echo "<b>" . "Codigo da Materia: " . $row_materia['cod_materia'] . "</b>" . "<br>" . "Nome: " . $row_materia['nome_materia'] . "<br>" . "Carga Horaria: " . $row_materia['carga_horaria'];
                } elseif ($row_materia == 0) {
                    echo "Materia nao encontrada.";
                }
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao pesquisar." . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
            mysqli_close($con);
        }
    }
}

if (isset($_POST['alterar'])) {
    if (empty($_POST['cod_materia'])) {
        echo "Digite o codigo da materia.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $cod_materia = $_POST['cod_materia'];

                $query = "SELECT nome_materia FROM materia, matricula WHERE nome_materia = matri_materia AND cod_materia='$cod_materia'";
                $result_query = mysqli_query($con, $query);
                $row_materia = mysqli_fetch_assoc($result_query);

                if ($row_materia == 0) {
                    $query_2 = "SELECT * FROM materia WHERE cod_materia = '$cod_materia'";
                    $result_query_2 = mysqli_query($con, $query_2);
                    $row_materia = mysqli_fetch_assoc($result_query_2);
                    if ($row_materia > 0) {
                        header('Location:alterar.php');
                        session_start();
                        $_SESSION['cod_materia'] = $cod_materia;
                    } elseif ($row_materia == 0) {
                        echo "Materia nao encontrada.";
                    }
                } elseif ($row_materia > 0) {
                    echo "<b>Materia</b> consta em uma <b>Matricula</b>, verifique as matriculas cadastradas antes de alterar ou excluir.";
                }
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao localizar cadastro." . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
            mysqli_close($con);
        }
    }
}

if (isset($_POST['excluir'])) {
    if (empty($_POST['cod_materia'])) {
        echo "Digite o codigo da materia.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $cod_materia = $_POST['cod_materia'];

                $query = "SELECT nome_materia FROM materia, matricula WHERE nome_materia = matri_materia AND cod_materia='$cod_materia'";
                $result_query = mysqli_query($con, $query);
                $row_materia = mysqli_fetch_assoc($result_query);

                if ($row_materia == 0) {
                    $query_2 = "DELETE FROM materia WHERE cod_materia = '$cod_materia'";
                    $result_query_2 = mysqli_query($con, $query_2);
                    $sucess = mysqli_affected_rows($con);
                    if ($result_query_2 == true) {
                        if ($sucess != 0) {
                            echo "Materia excluida.";
                        } else {
                            echo 'Nenhuma materia excluida, verifique o codigo inserido.';
                        }
                    } else {
                        echo "Erro ao excluir." . mysqli_connect_error();
                    }
                } elseif ($row_materia > 0) {
                    echo "<b>Materia</b> consta em uma <b>Matricula</b>, verifique as matriculas cadastradas antes de alterar ou excluir.";
                }
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao excluir." . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
            mysqli_close($con);
        }
    }
}

if (isset($_POST['listar'])) {
    $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

    if (!$con) {
        echo "Erro ao conectar no banco" . mysqli_connect_errno();
    } else {
        try {
            $query = "SELECT * FROM materia";
            $result_query = mysqli_query($con, $query);
            while ($row_materia = mysqli_fetch_assoc($result_query)) {
                echo "<b>" . "Codigo da Materia: " . $row_materia['cod_materia'] . "</b>" . "<br>" . "Nome: " . $row_materia['nome_materia'] . "<br>" . "Carga Horaria: " . $row_materia['carga_horaria'] . "<br>" . "<br>";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Erro ao listar" . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
        }
        mysqli_close($con);
    }
}
?>