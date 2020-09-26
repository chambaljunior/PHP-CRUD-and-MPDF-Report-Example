<?php include('servidor.php');

    //Pega os dados a serem actualizados
    if(isset($_GET['actualiza'])){
        $idCli = $_GET['actualiza'];
        $status_editar = true;
        $busca = mysqli_query($db, "SELECT * FROM cliente WHERE idCli=$idCli");
        $regista = mysqli_fetch_array($busca);
        $nomeC = $regista['nomeC'];
        $correio = $regista['correio'];
        $contacto = $regista['contacto'];
        $idCli = $regista['idCli'];

    }
?>
<html>
<head>
    <title>CRUD</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
<?php if(isset($_SESSION['msg'])): ?>

        <div class="msg">
            <?php  
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            ?>
        </div>

<?php endif ?>

<table border="1">
    <thead>
   
        <tr>
            <th>Nome Completo</th>
            <th>Correio</th>
            <th>Contacto</th>
            <th colspan="2">Operacoes</th>
        </tr>
    </thead>
    <tbody>
<?php while ($row = mysqli_fetch_array($resultados)){?>

        <tr>
            <td><?php echo $row['nomeC']; ?></td>
            <td><?php echo $row['correio']; ?></td>
            <td><?php echo $row['contacto']; ?></td>
            <td><a href="index.php?actualiza=<?php echo $row['idCli'] ?>"><b>Editar</b></a></td>
            <td><a href="servidor.php?apagar=<?php echo $row['idCli'] ?> "><b>Apagar</b></a></td>
        </tr>
<?php } ?>
    </tbody>
</table>

<hr>
<center><a href="reports.php" target="_blank">GERAR RELATORIO</a></center>
<hr>

<form action="servidor.php" method="post">
<input type="hidden" name="idCli" value="<?php echo $idCli; ?> ">
    <div>
        <label for="nomeC">Nome Completo</label>
        <input type="text" name="nomeC" id="nomeC" value="<?php echo $nomeC; ?>" required>
    </div>
    <div>
        <label for="correio">Correio</label>
        <input type="text" name="correio" id="correio" value="<?php echo $correio; ?>" required>
    </div>
    <div>
        <label for="contacto">Contacto</label>
        <input type="text" name="contacto" id="contacto" value="<?php echo $contacto; ?>" required>
    </div>
    <div>
<?php if ($status_editar == false): ?>
        <button type="submit" name="btnGravar">Gravar</button>
<?php else: ?>
    <button type="submit" name="btnActualizar">Actualizar</button>
<?php endif ?>
    </div>
</form>

</body>
</html>
