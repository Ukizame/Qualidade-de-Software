<html>
<h2>Sistema Escolar</h2>
<div id="menu">
  <ul>
    <li>
      <h4>MATRICULAS</h4>
      <ul>
        <li><a href="matricula/cadastro.php">Matricular Aluno</a></li>
        <li><a href="matricula/relatorio.php">Relatorio de Matriculas</a></li>
      </ul>
    </li>
    <li>
      <h4>CADASTROS</h4>
      <ul>
        <li><a href="materia/cadastro.php">Cadastrar Materias</a></li>
        <li><a href="professor/cadastro.php">Cadastrar Professores</a></li>
        <li><a href="aluno/cadastro.php">Cadastrar Alunos</a></li>
      </ul>
    </li>
    <li>
      <h4>RELATORIO DE CADASTROS</h4>
      <ul>
        <li><a href="materia/relatorio.php">Relatorios de Materias</a></li>
        <li><a href="professor/relatorio.php">Relatorios de Professores</a></li>
        <li><a href="aluno/relatorio.php">Relatorios de Alunos</a></li>
      </ul>
    </li>
  </ul>
</div>

</html>

<?php
session_start();

if (empty($_SESSION['login']) and  (empty($_SESSION['senha']))) {
  header('Location:form.php');
}

echo "<br>" . "<br>" . "Logado, deseja sair? Clique no botao abaixo.";


if (isset($_POST['sair'])) {
  if (isset($_SESSION['login']) and  (isset($_SESSION['senha']))) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('Location:form.php');
  } else {
    header('Location:form.php');
  }
}

?>

<html>

<body>
  <form method="post">
    <table class="table">
      <tr>
        <td><input type="submit" name="sair" value='Sair'></td>
      </tr>

    </table>
  </form>
</body>

</html>