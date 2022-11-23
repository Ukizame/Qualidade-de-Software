
<html>
    <head>
      <title>Alterar Cadastro de Aluno</title>
    </head>

    <body>
            <h2>Alterar Cadastro de Aluno</h2>
            <?php session_start();
            if(isset($_SESSION['mat_aluno'])){
            echo "<b>". "Matricula selecionada: " . "<u>" . $_SESSION['mat_aluno']. "</u>" . "</b>" . "<br>" . "<br>";
            }else{
            echo "<b>Nenhum aluno selecionado. <br> Clique em voltar para selecionar um aluno. </b> ". "<br>" . "<br>" ;
            }?>
            <form  method="post">
            <table class="table">
                <tr>
                    <td>Nome: </td>
                    <td><input class="form-control" type="text" name="nome_aluno"></td>
                </tr>
                <tr>
                    <td>E-mail: </td>
                    <td><input class="form-control" type="text" name="email_aluno"></td>
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
    if(isset($_POST['voltar'])){
      if(isset($_SESSION['mat_aluno'])){
        unset($_SESSION['mat_aluno']);
        header('Location:relatorio.php');
        } else {
        header('Location:relatorio.php');
        }
    }

    if(isset($_POST['alterar'])){
        if(isset($_SESSION['mat_aluno'])){
        $mat_aluno = $_SESSION['mat_aluno'];
                   if(empty($_POST['nome_aluno'])){
                     echo "Prencha o nome do aluno.";
                   }elseif(empty($_POST['email_aluno'])){
                     echo "Prencha o e-mail do aluno.";
                   } else {
                   $con= mysqli_connect('localhost','root', '','sistema_escola');
      
                   if(!$con){
                   echo "Erro ao conectar no banco".mysqli_connect_errno();

                   }else{
                   try {
                   $nome_aluno = $_POST['nome_aluno'];
                   $email_aluno = $_POST['email_aluno'];
            
                   $query= "UPDATE aluno SET nome_aluno = '$nome_aluno', email_aluno = '$email_aluno' WHERE mat_aluno='$mat_aluno'";
                   $result_query= mysqli_query($con, $query);
                   $sucess = mysqli_affected_rows($con);

                   if ($result_query==true){
                      if ($sucess!=0){
                      echo "Aluno alterado.";
                      }else{
                      echo 'Nenhum aluno alterado, verifique a matricula inserida.';
                      }
                      } else {
                      echo "Erro ao alterar." . mysqli_connect_error();
                      }
                   } catch(mysqli_sql_exception $e){
                   echo "Erro ao alterar" . "<br>" . $e->getCode() .' # '. $e->getMessage();
                   }
        }
        mysqli_close($con);
        }
        } else {
        echo "Nao foi possivel alterar, clique em voltar para selecionar um aluno valido.";
        }
        }
