<html>

<head>
  <title>Cadastro de Matricula</title>
</head>

<body>
  <h2>Cadastro de Matricula</h2>
  <form method="post">
    <table class="table">
      <tr>
        <td>Codigo da Matricula:
          <input class="form-control" type="user" name="cod_matricula">
        </td>
      </tr>
      <tr>
        <td>Selecione a materia:
          <select name=select_materia>
            <option value="">Selecione</option>
            <?php
            $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

            if (!$con) {
              echo "Erro ao conectar no banco" . mysqli_connect_errno();
            } else {
              $query_materia = "SELECT nome_materia FROM materia";
              $result_query_materia = mysqli_query($con, $query_materia);
              while ($row_materia = mysqli_fetch_assoc($result_query_materia)) { ?>
                <option value="<?php echo $row_materia['nome_materia']; ?>"><?php echo $row_materia['nome_materia']; ?></option>
            <?php
              }
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Selecione o aluno:
          <select name=select_aluno>
            <option value="">Selecione</option>
            <?php
            $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

            if (!$con) {
              echo "Erro ao conectar no banco" . mysqli_connect_errno();
            } else {
              $query_aluno = "SELECT nome_aluno FROM aluno";
              $result_query_aluno = mysqli_query($con, $query_aluno);
              while ($row_aluno = mysqli_fetch_assoc($result_query_aluno)) { ?>
                <option value="<?php echo $row_aluno['nome_aluno']; ?>"><?php echo $row_aluno['nome_aluno']; ?></option>
            <?php
              }
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Selecione o professor:
          <select name=select_professor>
            <option value="">Selecione</option>
            <?php
            $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

            if (!$con) {
              echo "Erro ao conectar no banco" . mysqli_connect_errno();
            } else {
              $query_prof = "SELECT nome_prof FROM professor";
              $result_query_prof = mysqli_query($con, $query_prof);
              while ($row_prof = mysqli_fetch_assoc($result_query_prof)) { ?>
                <option value="<?php echo $row_prof['nome_prof']; ?>"><?php echo $row_prof['nome_prof']; ?></option>
            <?php
              }
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td><input type="submit" name="cadastrar" value='Cadastrar'></td>
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
  header('Location:../index.php');
}

if (isset($_POST['cadastrar'])) {
  if (empty($_POST['cod_matricula'])) {
    echo "Digite um codigo de matricula.";
  } elseif (empty($_POST['select_materia'])) {
    echo "Selecione a materia.";
  } elseif (empty($_POST['select_aluno'])) {
    echo "Selecione o aluno.";
  } elseif (empty($_POST['select_professor'])) {
    echo "Selecione o professor.";
  } else {
    $con = mysqli_connect('localhost', 'root', '', 'sistema_escola');

    if (!$con) {
      echo "Erro ao conectar no banco" . mysqli_connect_errno();
    } else {
      try {
        $cod_matricula = $_POST['cod_matricula'];
        $matri_materia = $_POST['select_materia'];
        $matri_aluno = $_POST['select_aluno'];
        $matri_prof = $_POST['select_professor'];

        $query = "INSERT INTO matricula (cod_matricula, matri_materia, matri_aluno, matri_prof) VALUES ('$cod_matricula', '$matri_materia', '$matri_aluno', '$matri_prof')";
        $result_query = mysqli_query($con, $query);

        if ($result_query == true) {
          echo "Matricula cadastrada.";
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
