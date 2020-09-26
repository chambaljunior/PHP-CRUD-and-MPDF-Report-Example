<?php

        session_start();

        //Inicializa as variaveis
        $nomeC = "";
        $correio = "";
        $contacto = "";
        $idCli = 0;
        $status_editar = false;

        //Conexao a base de dados
        $db = mysqli_connect('localhost','root','','crud_ewadig');

        //Se o Botao Gravar for acionado
        if (isset($_POST['btnGravar'])){
            $nomeC =$_POST['nomeC'];
            $correio =$_POST['correio']; 
            $contacto =$_POST['contacto'];       
        
            $query = "INSERT INTO cliente (nomeC, correio, contacto) VALUES ('$nomeC','$correio','$contacto')";
            mysqli_query($db, $query);
            $_SESSION['msg'] = "Dados Gravados";
            header('location: index.php'); //Redireciona para a pagina inicial depois de inserir
        }
      
        //Actualizar dados
        if (isset($_POST['btnActualizar'])){
            $nomeC = $_POST['nomeC'];
            $correio = $_POST['correio'];
            $contacto = $_POST['contacto'];
            $idCli = $_POST['idCli'];

            mysqli_query($db, "UPDATE cliente SET nomeC='$nomeC', correio='$correio', contacto='$contacto' WHERE idCli=$idCli");
            $_SESSION['msg'] = "Dados Actualizados";
            header('location: index.php');
        }

        //Apagar dados
        if (isset($_GET['apagar'])) {
            $idCli =  $_GET['apagar'];
            mysqli_query($db, "DELETE FROM cliente WHERE idCli=$idCli");
            $_SESSION['msg'] = "Dados Apagados";
            header('location: index.php');
            
        }

        //Recuperar dados
        $resultados = mysqli_query($db, "SELECT * FROM cliente ORDER BY nomeC");

?>