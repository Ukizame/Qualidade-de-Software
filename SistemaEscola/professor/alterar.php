<html>

<head>
  <title>Alterar Cadastro de Professor</title>
</head>

<body>
  <h2>Alterar Cadastro de Professor</h2>
  <?php session_start();
  if (isset($_SESSION['mat_prof'])) {
    echo "<b>" . "Matricula selecionada: " . "<u>" . $_SESSION['mat_prof'] . "</u>" . "</b>" . "<br>" . "<br>";
  } else {
    echo "<b>Nenhum professor selecionado. <br> Clique em voltar para selecionar um professor. </b> " . "<br>" . "<br>";
  } ?>
  <form method="post">
    <table class="table">
      <tr>
        <td>Nome: </td>
        <td><input class="form-control" type="text" name="nome_prof"></td>
      </tr>
      <tr>
        <td>E-mail: </td>
        <td><input class="form-control" type="text" name="email_prof"></td>
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
  if (isset($_SESSION['mat_prof'])) {
    unset($_SESSION['mat_prof']);
    header('Location:relatorio.php');
  } else {
    header('Location:relatorio.php');
  }
}

if (isset($_POST['alterar'])) {
  if (isset($_SESSION['mat_prof'])) {
    $mat_prof = $_SESSION['mat_prof'];
    if (empty($_POST['nome_prof'])) {
      echo "Prencha o nome do professor.";
    } elseif (empty($_POST['email_prof'])) {
      echo "Prencha o e-mail do professor.";
    } else {
      $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

      if (!$con) {
        echo "Erro ao conectar no banco" . mysqli_connect_errno();
      } else {
        try {
          $nome_prof = $_POST['nome_prof'];
          $email_prof = $_POST['email_prof'];

          $query = "UPDATE professor SET nome_prof = '$nome_prof', email_prof = '$email_prof' WHERE mat_prof='$mat_prof'";
          $result_query = mysqli_query($con, $query);
          $sucess = mysqli_affected_rows($con);

          if ($result_query == true) {
            if ($sucess != 0) {
              echo "Professor alterado.";
            } else {
              echo 'Nenhum professor alterado, verifique a matricula inserida.';
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
    echo "Nao foi possivel alterar, clique em voltar para selecionar um professor valido.";
  }
}
