<html>

<head>
    <title>Relatorio de Professores</title>
</head>

<body>
    <form method="post">
        <table class="table">
            <tr>
                <h2>Relatorio de Professores</h2> <input type="submit" name="voltar" value='Voltar'><BR><BR><BR>
                <td>Digite a matricula do professor: </td>
                <td><input class="form-control" type="text" name="mat_prof"></td>
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
if (isset($_SESSION['mat_prof'])) {
    unset($_SESSION['mat_prof']);
}

if (isset($_POST['voltar'])) {
    header('Location:../index.php');
}

if (isset($_POST['buscar'])) {
    if (empty($_POST['mat_prof'])) {
        echo "Digite a matricula do professor.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $mat_prof = $_POST['mat_prof'];

                $query = "SELECT * FROM professor WHERE mat_prof = '$mat_prof'";
                $result_query = mysqli_query($con, $query);
                $row_prof = mysqli_fetch_assoc($result_query);

                if ($row_prof > 0) {
                    echo "<b>" . "Numero de Matricula: " . $row_prof['mat_prof'] . "</b>" . "<br>" . "Nome: " . $row_prof['nome_prof'] . "<br>" . "E-mail: " . $row_prof['email_prof'];
                } elseif ($row_prof == 0) {
                    echo "Professor nao encontrado.";
                }
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao pesquisar." . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
            mysqli_close($con);
        }
    }
}

if (isset($_POST['alterar'])) {
    if (empty($_POST['mat_prof'])) {
        echo "Digite a matricula do professor.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $mat_prof = $_POST['mat_prof'];

                $query = "SELECT nome_prof FROM professor, matricula WHERE nome_prof = matri_prof AND mat_prof='$mat_prof'";
                $result_query = mysqli_query($con, $query);
                $row_prof = mysqli_fetch_assoc($result_query);

                if ($row_prof == 0) {
                    $query_2 = "SELECT * FROM professor WHERE mat_prof = '$mat_prof'";
                    $result_query_2 = mysqli_query($con, $query_2);
                    $row_prof_2 = mysqli_fetch_assoc($result_query_2);

                    if ($row_prof_2 > 0) {
                        header('Location:alterar.php');
                        session_start();
                        $_SESSION['mat_prof'] = $mat_prof;
                    } elseif ($row_prof_2 == 0) {
                        echo "Professor nao encontrado.";
                    }
                } elseif ($row_prof > 0) {
                    echo "<b>Professor</b> consta em uma <b>Matricula</b>, verifique as matriculas cadastradas antes de alterar ou excluir.";
                }
            } catch (mysqli_sql_exception $e) {
                echo "Erro ao localizar cadastro." . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
            }
            mysqli_close($con);
        }
    }
}

if (isset($_POST['excluir'])) {
    if (empty($_POST['mat_prof'])) {
        echo "Digite a matricula do professor.";
    } else {
        $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

        if (!$con) {
            echo "Erro ao conectar no banco" . mysqli_connect_errno();
        } else {
            try {
                $mat_prof = $_POST['mat_prof'];

                $query = "SELECT nome_prof FROM professor, matricula WHERE nome_prof = matri_prof AND mat_prof='$mat_prof'";
                $result_query = mysqli_query($con, $query);
                $row_prof = mysqli_fetch_assoc($result_query);

                if ($row_prof == 0) {
                    $query_2 = "DELETE FROM professor WHERE mat_prof = '$mat_prof'";
                    $result_query_2 = mysqli_query($con, $query_2);
                    $sucess = mysqli_affected_rows($con);
                    if ($result_query_2 == true) {
                        if ($sucess != 0) {
                            echo "Professor excluido.";
                        } else {
                            echo 'Nenhum professor excluido, verifique a matricula inserida.';
                        }
                    } else {
                        echo "Erro ao excluir." . mysqli_connect_error();
                    }
                } elseif ($row_prof > 0) {
                    echo "<b>Professor</b> consta em uma <b>Matricula</b>, verifique as matriculas cadastradas antes de alterar ou excluir.";
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
            $query = "SELECT * FROM professor";
            $result_query = mysqli_query($con, $query);
            while ($row_prof = mysqli_fetch_assoc($result_query)) {
                echo "<b>" . "Numero de Matricula: " . $row_prof['mat_prof'] . "</b>" . "<br>" . "Nome: " . $row_prof['nome_prof'] . "<br>" . "E-mail: " . $row_prof['email_prof'] . "<br>" . "<br>";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Erro ao listar" . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
        }
        mysqli_close($con);
    }
}
?>