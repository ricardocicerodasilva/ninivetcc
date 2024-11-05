<?php
include('verifica_login.php');
$host  = "localhost:3306";
$user  = "root";
$pass  = "";
$base  = "etecguaru01";
$con   = mysqli_connect($host, $user, $pass, $base);

if (!$con) {
    die("Falha na conexão: " . mysqli_connect_error());
}




$sql = "SELECT * FROM reserva";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<center><table border='1'>
            <tr>
                <th>ID</th>
                <th>Data de Reserva</th>
                <th>Data de Devolução</th>
                <th>RM do Aluno</th>
                <th>Nome do Livro</th>
                <th>Ação</th>
            </tr>";

    // Exibindo cada linha de dados
    while ($row = $result->fetch_assoc()) {

        $num_reserva = $row["num_reserva"];
        $sql_confirma = "SELECT * FROM confirma_reserva WHERE num_reserva = '$num_reserva'";
        $result_confirma = $con->query($sql_confirma);

        $disponivel = true;

        if ($result_confirma->num_rows > 0) {
            $confirma_row = $result_confirma->fetch_assoc();

            $confirmar_reserva = $confirma_row["confirmar_reserva"];
            $confirmar_devolucao = $confirma_row["confirmar_devolucao"];

            if ($confirmar_reserva && $confirmar_devolucao) {
                $disponivel = false;
            } else {
                $disponivel = !empty($confirma_row["livro_disponivel"]) ? $confirma_row["livro_disponivel"] : false;
            }
        }

        if (!$disponivel) {
            $num_reserva = $row['num_reserva'];
            $sql_verifica_devolucao = "SELECT * FROM confirma_reserva WHERE num_reserva = '$num_reserva' AND confirmar_devolucao = FALSE";
            $result_verifica_devolucao = $con->query($sql_verifica_devolucao);

            if ($result_verifica_devolucao->num_rows > 0) {

                echo "<tr>
                <td>" . $row["num_reserva"] . "</td>
                <td>" . $row["data_reserva"] . "</td>
                <td>" . $row["data_devolucao"] . "</td>
                <td>" . $row["rm_aluno"] . "</td>
                <td>" . $row["nome_livro"] . "</td>
                <td>
                    <form method='post' action='devolucao.php'>
                        <input type='hidden' value='" . $row["num_reserva"] . "' name='num_reserva'>
                        <input type='hidden' value='" . $row["rm_aluno"] . "' name='rm_aluno'>
                        <input type='submit' value='Devolução'>
                    </form>
                </td>
            </tr>";
            } else {
                echo "<tr>
                <td>" . $row["num_reserva"] . "</td>
                <td>" . $row["data_reserva"] . "</td>
                <td>" . $row["data_devolucao"] . "</td>
                <td>" . $row["rm_aluno"] . "</td>
                <td>" . $row["nome_livro"] . "</td>
                <td>Devolução já confirmada</td>
            </tr>";
            }
        } else {
            echo "<tr>
            <td>" . $row["num_reserva"] . "</td>
            <td>" . $row["data_reserva"] . "</td>
            <td>" . $row["data_devolucao"] . "</td>
            <td>" . $row["rm_aluno"] . "</td>
            <td>" . $row["nome_livro"] . "</td>
            <td>
                <form method='post' action='confirma_reserva.php'>
                    <input type='hidden' value='" . $row["num_reserva"] . "' name='num_reserva'>
                    <input type='hidden' value='" . $row["rm_aluno"] . "' name='rm_aluno'>
                    <input type='submit' value='Confirmar'>
                </form>
            </td>
        </tr>";
        }
    }

    echo "</table></center>";
} else {
    echo "Nenhum resultado encontrado.";
}

$con->close();
?>



