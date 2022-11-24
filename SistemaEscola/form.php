<html>
    <head>
      <title>Sistema Escolar</title>
    </head>

    <body>
            <h2>Sistema Escolar</h2>
            <form  method="post">
            <table class="table">
                <tr>
                    <td>Codigo de Acesso: </td>
                    <td><input class="form-control" type="user" name="cod_acesso"></td>
                </tr>
                <tr>
                    <td>Senha: </td>
                    <td><input class="form-control" type="password" name="senha"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="logar" value='Login'></td>
                </tr>
                <tr>
                    <td><input type="submit" name="cadastrar" value='Cadastrar'></td>
                </tr>

            </table>
            </form>
    </body>
    </html>
    
    <?php
    session_start();
    if(isset($_SESSION['login']) and (isset($_SESSION['senha']))){
        header('Location:index.php');
    }
    if(isset($_POST['logar'])){
        $cod_acesso= $_POST['cod_acesso'];
        $senha= $_POST['senha'];
        include 'autenticacao_login.php' ;
    }
    
    if(isset($_POST['cadastrar'])){
      header('Location:cadastro.php');
    }
     if(isset($_COOKIE['status_login'])){
        if($_COOKIE['status_login']=='true'){
        echo 'Codigo de acesso ou senha invalidos.';
        setcookie('status_login', 'false');
     }
}


