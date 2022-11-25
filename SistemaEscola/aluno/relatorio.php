<html>

<head>
    <title>Relatorio de Alunos</title>
</head>

<body>
    <form method="post">
        <table class="table">
            <tr>
                <h2>Relatorio de Alunos</h2> <input type="submit" name="voltar" value='Voltar'><BR><BR><BR>
                <td>Digite a matricula do aluno: </td>
                <td><input class="form-control" type="text" name="mat_aluno"></td>
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
if (isset($_SESSION['mat_aluno'])) {
    unset($_SESSION['mat_aluno']);
}

if (isset($_POST['voltar'])) {
    header('Location:../index.php');
}

if (isset($_POST['buscar'])) {
    if (empty($_POST['mat_aluno'])) {
        echo "Digite a matricula do aluno.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $mat_aluno = $_POST['mat_aluno'];

                $query = "SELECT * FROM aluno WHERE mat_aluno = '$mat_aluno'";
                $result_query = mysqli_query($con, $query);
                $row_aluno = mysqli_fetch_assoc($result_query);

                if ($row_aluno > 0) {
                    echo "<b>" . "Numero de Matricula: " . $row_aluno['mat_aluno'] . "</b>" . "<br>" . "Nome: " . $row_aluno['nome_aluno'] . "<br>" . "E-mail: " . $row_aluno['email_aluno'];
                } elseif ($row_aluno == 0) {
                    echo "Aluno nao encontrado.";
                }
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao pesquisar." . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
            mysqli_close($con);
        }
    }
}

if (isset($_POST['alterar'])) {
    if (empty($_POST['mat_aluno'])) {
        echo "Digite a matricula do aluno.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $mat_aluno = $_POST['mat_aluno'];

                $query = "SELECT nome_aluno FROM aluno, matricula WHERE nome_aluno = matri_aluno AND mat_aluno='$mat_aluno'";
                $result_query = mysqli_query($con, $query);
                $row_aluno = mysqli_fetch_assoc($result_query);

                if ($row_aluno == 0) {
                    $query_2 = "SELECT * FROM aluno WHERE mat_aluno = '$mat_aluno'";
                    $result_query_2 = mysqli_query($con, $query_2);
                    $row_aluno_2 = mysqli_fetch_assoc($result_query_2);

                    if ($row_aluno_2 > 0) {
                        header('Location:alterar.php');
                        session_start();
                        $_SESSION['mat_aluno'] = $mat_aluno;
                    } elseif ($row_aluno_2 == 0) {
                        echo "Aluno nao encontrado.";
                    }
                } elseif ($row_aluno > 0) {
                    echo "<b>Aluno</b> consta em uma <b>Matricula</b>, verifique as matriculas cadastradas antes de alterar ou excluir.";
                }
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao localizar cadastro." . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
            mysqli_close($con);
        }
    }
}

if (isset($_POST['excluir'])) {
    if (empty($_POST['mat_aluno'])) {
        echo "Digite a matricula do aluno.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $mat_aluno = $_POST['mat_aluno'];

                $query = "SELECT nome_aluno FROM aluno, matricula WHERE nome_aluno = matri_aluno AND mat_aluno='$mat_aluno'";
                $result_query = mysqli_query($con, $query);
                $row_aluno = mysqli_fetch_assoc($result_query);

                if ($row_aluno == 0) {
                    $query_2 = "DELETE FROM aluno WHERE mat_aluno = '$mat_aluno'";
                    $result_query_2 = mysqli_query($con, $query_2);
                    $sucess = mysqli_affected_rows($con);
                    if ($result_query_2 == true) {
                        if ($sucess != 0) {
                            echo "Aluno excluido.";
                        } else {
                            echo 'Nenhum aluno excluido, verifique a matricula inserida.';
                        }
                    } else {
                        echo "Erro ao excluir." . mysqli_connect_error();
                    }
                } elseif ($row_aluno > 0) {
                    echo "<b>Aluno</b> consta em uma <b>Matricula</b>, verifique as matriculas cadastradas antes de alterar ou excluir.";
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
            $query = "SELECT * FROM aluno";
            $result_query = mysqli_query($con, $query);
            while ($row_aluno = mysqli_fetch_assoc($result_query)) {
                echo "<b>" . "Numero de Matricula: " . $row_aluno['mat_aluno'] . "</b>" . "<br>" . "Nome: " . $row_aluno['nome_aluno'] . "<br>" . "E-mail: " . $row_aluno['email_aluno'] . "<br>" . "<br>";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Erro ao listar" . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
        }
        mysqli_close($con);
    }
}
?>