<?php

    // Pegando as informações do banco de dados
    if (isset($_POST['signup-submit']))
    {
        include 'dbhost.inc.php';
    }

    // Setando valores
    $username = $_POST['user_username'];
    $email = $_POST['user_email'];
    $password = $_POST['user_pass'];
    $re_pass = $_POST['re_pass'];

    // Checando se os inputs foram preenchidos
    if(empty($username) || empty($email) || empty($password) || empty($re_pass))
    {
        // Voltando para a página e dando o nome do erro atravez da URL com as informações do username e email
        header("Location: ../signup.php?erro=emptyfield&username=".$username."&email=".$email);
        exit();
    }

    // Checando a validade do email e do username 
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../signup.php?erro=invalidemail&username");
        exit();
    }

    // Checando se o email é válido
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("Location: ../signup.php?erro=invalidemail&username=".$username);
        exit();
    }

    // Checando a validade do username
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../signup.php?erro=invalidusername&email=".$email);
        exit();
    }

    // Checando a identidade da senha
    else if ($password !== $re_pass)
    {
        header("Location: ../signup.php?erro=passwordcheck&username=".$username."&email=".$email);
        exit();
    }

    else{

        // Colocamos = ? por seguraça, pois se colococamos oq o usuário digitou, ele poderia escrever algum código sql e destruir o nosso database
        $sql = "SELECT user_username FROM login_info WHERE user_username=?";

        // Para isso n acontecer criaremos um nova lógica, a variável irá nos retornar a outro objeto estático
        $stmt = mysqli_stmt_init($conn);

        // Verificamos se vai funcionar 
        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            echo "mysqli_stmt_error($stmt)";
            echo mysqli_error();
            header("Location: ../signup.php?erro=sqlerror");
            exit();
        }

        // Agora criaremos parâmentros para adicionar uma string ja que o username é uma string
        // Com esses parâmetros temos que executar isso no database
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            // Com isso podemos ver quantos resultados temos para checar se o username é ou n já usado
            // o stament vê com resultados em linhas ou seja, se o username tiver += a um linha já está em uso
            // Se n, pode ser usado sim!
            $resultCheck = mysqli_stmt_num_rows($stmt);

            // Então verificamos isso, se for maior que 0 n pode ser usado
            if ($resultCheck > 0)
            {
                header("Location: ../signup.php?erro=usertaken&email=".$email);
                exit();
            }

            // Se n estiver em uso pode ser usado
            else{
                $sql = "INSERT INTO login_info (user_username, user_email, user_password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ../signup.php?erro=sqlerror");
                    exit();
                }

                // Agora criaremos parâmentros para adicionar uma string ja que o username é uma string
                // Com esses parâmetros temos que executar isso no database
                else{
                    // Criaremos um passwor default que é mais segudo
                    $hashedpass = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedpass);
                    mysqli_stmt_execute($stmt);

                    header("Location: ../signup.php?signup=sucess");
                    exit();
                }
            }


        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
?>