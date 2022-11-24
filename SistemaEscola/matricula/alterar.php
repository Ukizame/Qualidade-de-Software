
<html>
    <head>
      <title>Alterar Matricula</title>
    </head>

    <body>
            <h2>Alterar Matricula</h2>
            <?php session_start();
            if(isset($_SESSION['cod_matricula'])){
            echo "<b>". "Codigo de Matricula selecionado: " . "<u>" . $_SESSION['cod_matricula']. "</u>" . "</b>" . "<br>" . "<br>";
            }else{
            echo "<b>Nenhuma matricula selecionada. <br> Clique em voltar para selecionar uma matricula. </b> ". "<br>" . "<br>" ;
            }?>
            <form  method="post">
            <table class="table">
               <tr>
                    <td>Selecione a materia:
                    <select name=select_materia>
                    <option value="">Selecione</option>
                    <?php
                         $con= mysqli_connect('localhost','root', '','sistema_escola');

                         if(!$con){
                         echo "Erro ao conectar no banco".mysqli_connect_errno();
                         } else{
                         $query_materia = "SELECT nome_materia FROM materia";
                         $result_query_materia = mysqli_query($con, $query_materia);
                         while($row_materia = mysqli_fetch_assoc($result_query_materia)){?>
                           <option value="<?php echo $row_materia['nome_materia'];?>"><?php echo $row_materia['nome_materia'];?></option>
                         <?php
                         }
                         }
                         ?>
                         </select></td>
                </tr>
                <tr>
                    <td>Selecione o aluno:
                    <select name=select_aluno>
                    <option value="">Selecione</option>
                    <?php
                         $con= mysqli_connect('localhost','root', '','sistema_escola');

                         if(!$con){
                         echo "Erro ao conectar no banco".mysqli_connect_errno();
                         } else{
                         $query_aluno = "SELECT nome_aluno FROM aluno";
                         $result_query_aluno = mysqli_query($con, $query_aluno);
                         while($row_aluno = mysqli_fetch_assoc($result_query_aluno)){?>
                           <option value="<?php echo $row_aluno['nome_aluno'];?>"><?php echo $row_aluno['nome_aluno'];?></option>
                         <?php
                         }
                         }
                         ?>
                         </select></td>
                </tr>
                <tr>
                    <td>Selecione o professor:
                    <select name=select_professor>
                    <option value="">Selecione</option>
                    <?php
                         $con= mysqli_connect('localhost','root', '','sistema_escola');

                         if(!$con){
                         echo "Erro ao conectar no banco".mysqli_connect_errno();
                         } else{
                         $query_prof = "SELECT nome_prof FROM professor";
                         $result_query_prof = mysqli_query($con, $query_prof);
                         while($row_prof = mysqli_fetch_assoc($result_query_prof)){?>
                           <option value="<?php echo $row_prof['nome_prof'];?>"><?php echo $row_prof['nome_prof'];?></option>
                         <?php
                         }
                         }
                         ?>
                         </select></td>
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
      if(isset($_SESSION['cod_matricula'])){
        unset($_SESSION['cod_matricula']);
        header('Location:relatorio.php');
        } else {
        header('Location:relatorio.php');
        }
    }

    if(isset($_POST['alterar'])){
        if(isset($_SESSION['cod_matricula'])){
        $cod_matricula = $_SESSION['cod_matricula'];
                   if(empty($_POST['select_materia'])){
                   echo "Selecione a materia.";
                   }elseif(empty($_POST['select_aluno'])){
                   echo "Selecione o aluno.";
                   }elseif(empty($_POST['select_professor'])){
                   echo "Selecione o professor.";
                   } else {
                   $con= mysqli_connect('localhost','root', '','sistema_escola');
      
                   if(!$con){
                   echo "Erro ao conectar no banco".mysqli_connect_errno();

                   }else{
                   try {
                   $matri_materia = $_POST['select_materia'];
                   $matri_aluno = $_POST['select_aluno'];
                   $matri_prof = $_POST['select_professor'];
            
                   $query= "UPDATE matricula SET matri_materia = '$matri_materia', matri_aluno = '$matri_aluno', matri_prof = '$matri_prof' WHERE cod_matricula = '$cod_matricula'";
                   $result_query= mysqli_query($con, $query);
                   $sucess = mysqli_affected_rows($con);

                   if ($result_query==true){
                      if ($sucess!=0){
                      echo "Matricula alterada.";
                      }else{
                      echo 'Nenhuma matricula alterada, verifique os dados e tente novamente.';
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
        echo "Nao foi possivel alterar, clique em voltar para selecionar uma matricula valida.";
        }
        }
