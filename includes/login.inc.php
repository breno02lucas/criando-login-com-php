<?php

    if (isset($_POST['login_submit']))
    {
        // Conectar com banco de dados
        require 'dbhost.inc.php';

        $email_username= $_POST['user_email'];
        $password= $_POST['user_pass'];

        // Verificar se os inputs foram preenchidos
        if (empty($email_username) || empty($password))
        {
            header("Location: ../index.php?error=emptyfields");
            exit();
        }

        // Se forma, vamos conectar com o banco
        else{
            $sql = "SELECT * FROM login_info WHERE user_username=? OR user_email=?;";
            $stmt = mysqli_stmt_init($conn);

            // Verificar se o statment está preparado para trabalhar com o database
            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                echo "ERRO AQUI";
                // header("Location: ../index.php?error=sqlerror");
                // exit();
            }

            // Se sim, pegaremos as informações como parametros 
            else{

                //Verificamos se existe algum usuário com o username ou email digitado
                mysqli_stmt_bind_param($stmt, "ss", $email_username, $email_username);
                mysqli_stmt_execute($stmt);

                // Pegamos o resultado da execução do parâmetro
                $result = mysqli_stmt_get_result($stmt);

                // Com o resultado, transformamos em ARRAYs
                if ($row = mysqli_fetch_assoc($result))
                {
                    $passcheck = password_verify($password, $row['user_password']);

                    if($passcheck == false)
                    {
                        header("Location: ../index.php?error=wrongpassword");
                        exit();
                    }
                    else if($passcheck == true){
                        session_start();
                        $_SESSION['user_id'] = $row ['user_id'];
                        $_SESSION['user_username'] = $row ['user_username'];
                        $_SESSION['user_email'] = $row ['user_email'];

                        header("Location: ../index.php?login=sucess");
                        exit();
                    }      
                    else{
                        header("Location: ../index.php?error=wrongpassword");
                        exit();
                    }              
                }
                else{
                    header("Location: ../index.php?error=nouser");
                    exit();
                }
            }
        }
    }

    else{
        header("Location: ../index.php");
        exit();
    }



?>