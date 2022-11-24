<?php
$con = mysqli_connect('localhost', 'root', '', 'sistema_escola');
if (!$con) {
  echo "Erro ao conectar no banco" . mysqli_connect_errno();
} else {
  $query = "Select cod_acesso, senha from login where cod_acesso='$cod_acesso' and senha='$senha'";
  $result_query = mysqli_query($con, $query);
  $result = mysqli_fetch_assoc($result_query);

  if ($result > 0) {
    header('Location: index.php');
    session_start();
    $_SESSION['login'] = $cod_acesso;
    $_SESSION['senha'] = $senha;
  } elseif ($result == 0) {
    setcookie('status_login', 'true');
    header('Location: form.php');
  }
}
mysqli_close($con);
