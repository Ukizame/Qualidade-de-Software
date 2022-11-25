<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <title>Sistema Escolar</title>
  </head>
<body>
  <h1>Sistema Escolar</h1>
  <div>
    <ul class="container">
      <li>
        <h2>MATRICULAS</h2>
        <ul class="container-2">
          <li><a href="matricula/cadastro.php">Matricular Aluno</a></li>
          <li><a href="matricula/relatorio.php">Relatorio de Matriculas</a></li>
        </ul>
      </li>
      <li>
        <h2>CADASTROS</h2>
        <ul class="container-2">
          <li><a href="materia/cadastro.php">Cadastrar Materias</a></li>
          <li><a href="professor/cadastro.php">Cadastrar Professores</a></li>
          <li><a href="aluno/cadastro.php">Cadastrar Alunos</a></li>
        </ul>
      </li>
      <li>
        <h2>RELATORIO DE CADASTROS</h2>
        <ul class="container-2">
          <li><a href="materia/relatorio.php">Relatorios de Materias</a></li>
          <li><a href="professor/relatorio.php">Relatorios de Professores</a></li>
          <li><a href="aluno/relatorio.php">Relatorios de Alunos</a></li>
        </ul>
      </li>
      <p>Logado, deseja sair? Clique no botao abaixo.</p>
      <form method="post">
        <table class="table">
         <tr>
           <td><input type="submit" name="sair" value='Sair'></td>
        </tr>
        </table>
      </form>
    </ul>
  </div>
</body>

</html>

<?php
session_start();

if (empty($_SESSION['login']) and  (empty($_SESSION['senha']))) {
  header('Location:form.php');
}

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
