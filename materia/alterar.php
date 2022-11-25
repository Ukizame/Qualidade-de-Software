<html>

<head>
  <title>Alterar Cadastro de Materia</title>
</head>

<body>
  <h2>Alterar Cadastro de Materia</h2>
  <?php session_start();
  if (isset($_SESSION['cod_materia'])) {
    echo "<b>" . "Codigo de materia selecionado: " . "<u>" . $_SESSION['cod_materia'] . "</u>" . "</b>" . "<br>" . "<br>";
  } else {
    echo "<b>Nenhuma materia selecionada. <br> Clique em voltar para selecionar uma materia. </b> " . "<br>" . "<br>";
  } ?>
  <form method="post">
    <table class="table">
      <tr>
        <td>Nome: </td>
        <td><input class="form-control" type="text" name="nome_materia"></td>
      </tr>
      <tr>
        <td>Carga Horaria: </td>
        <td><input class="form-control" type="text" name="carga_horaria"></td>
      </tr>
      <tr>
        <td><input type="submit" name="alterar" value='Alterar'></td>
      </tr>
      <tr>
        <td><input type="submit" name="voltar" value='Voltar'></td>
      </tr>

    </table>
  </form>
</body>

</html>

<?php
if (isset($_POST['voltar'])) {
  if (isset($_SESSION['cod_materia'])) {
    unset($_SESSION['cod_materia']);
    header('Location:relatorio.php');
  } else {
    header('Location:relatorio.php');
  }
}

if (isset($_POST['alterar'])) {
  if (isset($_SESSION['cod_materia'])) {
    $cod_materia = $_SESSION['cod_materia'];
    if (empty($_POST['nome_materia'])) {
      echo "Prencha o nome da materia.";
    } elseif (empty($_POST['carga_horaria'])) {
      echo "Prencha a carga horaria da materia.";
    } else {
      $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

      if (!$con) {
        echo "Erro ao conectar no banco" . mysqli_connect_errno();
      } else {
        try {
          $nome_materia = $_POST['nome_materia'];
          $carga_horaria = $_POST['carga_horaria'];

          $query = "UPDATE materia SET nome_materia = '$nome_materia', carga_horaria = '$carga_horaria' WHERE cod_materia='$cod_materia'";
          $result_query = mysqli_query($con, $query);
          $sucess = mysqli_affected_rows($con);

          if ($result_query == true) {
            if ($sucess != 0) {
              echo "Materia alterada.";
            } else {
              echo 'Nenhuma materia alterada, verifique o codigo inserido.';
            }
          } else {
            echo "Erro ao alterar." . mysqli_connect_error();
          }
        } catch (mysqli_sql_exception $e) {
          echo "Erro ao alterar" . "<br>" . $e->getCode() . ' # ' . $e->getMessage();
        }
      }
      mysqli_close($con);
    }
  } else {
    echo "Nao foi possivel alterar, clique em voltar para selecionar uma materia valida.";
  }
}
