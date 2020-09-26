<?php
require_once __DIR__ . '/vendor/autoload.php';

function selecionaTabela(){
    $con = new mysqli("localhost","root","","crud_ewadig");
    //Verificar em caso de erro

    $sql = "SELECT * FROM cliente";
    $res = $con->query($sql);
    $tabela = "";
    $tabela .= "<table border='1'>
    
                    <tr>
                        <th>Id</th>
                        <th>Nome do Cliente</th>
                        <th>Correio</th>
                        <th>Contacto</th>
                    </tr>"; 

        while($fila = $res->fetch_assoc()){
            $tabela .= "<tr>
                             <td>".$fila['idCli']."</td>
                             <td>".$fila['nomeC']."</td>
                             <td>".$fila['correio']."</td>
                            <td>".$fila['contacto']."</td>
                        </tr>";
        }
        $tabela .= "</table>";
        return $tabela;

}

$html = "<h3>LISTA DE CLIENTES</h3> <hr>";
$html .= selecionaTabela();
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file_name = 'Report.pdf';
$mpdf->Output($file_name, 'I');
exit;

?>