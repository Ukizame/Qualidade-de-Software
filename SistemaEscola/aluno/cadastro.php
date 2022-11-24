<html>
    <head>
      <title>Cadastro de Aluno</title>
    </head>

    <body>
            <h2>Cadastro de Aluno</h2>
            <form  method="post">
            <table class="table">
                <tr>
                    <td>Matricula do Aluno: </td>
                    <td><input class="form-control" type="text" name="mat_aluno"></td>
                </tr>
                <tr>
                    <td>Nome: </td>
                    <td><input class="form-control" type="text" name="nome_aluno"></td>
                </tr>
                <tr>
                    <td>E-mail: </td>
                    <td><input class="form-control" type="text" name="email_aluno"></td>
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
    
    if(isset($_POST['voltar'])){
      header('Location:../index.php');
    }
    
    if(isset($_POST['cadastrar'])){
        if(empty($_POST['mat_aluno'])){
        echo "Prencha a matricula do aluno.";
        }elseif(empty($_POST['nome_aluno'])){
        echo "Prencha o nome do aluno.";
        }elseif(empty($_POST['email_aluno'])){
        echo "Prencha o E-mail do aluno.";
        } else {
        $con= mysqli_connect('localhost','root', '','sistema_escola');
      
        if(!$con){
        echo "Erro ao conectar no banco".mysqli_connect_errno();

        }else{
            try {
            $mat_aluno = $_POST['mat_aluno'];
            $nome_aluno = $_POST['nome_aluno'];
            $email_aluno = $_POST['email_aluno'];
            
            $query= "INSERT INTO aluno (mat_aluno, nome_aluno, email_aluno) VALUES ('$mat_aluno', '$nome_aluno', '$email_aluno')";
            $result_query= mysqli_query($con, $query);
            
            if ($result_query==true){
            echo "Aluno cadastrado.";
            } else {
            echo "Erro ao cadastrar, confira a matricula inserida e tente novamente." . mysqli_connect_error();
            }
            mysqli_close($con);
            } catch(mysqli_sql_exception $e){
            echo "Erro ao cadastrar" . "<br>" . $e->getCode() .' # '. $e->getMessage();
            }
        }
        }
        }
