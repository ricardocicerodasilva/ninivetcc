<?php
        $cod = $_POST['tCodigo'];
        $nomeEvento = isset($_POST['tNome'])?$_POST['tNome']:"Não informado";
        $dataEvento =isset($_POST['tData'])?$_POST['tData']:"Não informado";
        $horaInicial =isset($_POST['tHoraIni'])?$_POST['tHoraIni']:"Não informado";
        $horaFinal =isset($_POST['tHoraFim'])?$_POST['tHoraFim']:"não informado";
        $descricao =isset($_POST['tDescricao'])?$_POST['tDescricao']:"não informado";
        $local =isset($_POST['tLocal'])?$_POST['tLocal']:"não informado";
        $responsavel =isset($_POST['tResponsavel'])?$_POST['tResponsavel']:"não informado";
        $opcao = $_POST['atualizar'];
       
        $host="localhost:3306";
        $use = "root";
        $pass ="";
        $base ="agenda_compromissos";
        $con =mysqli_connect($host,$use,$pass,$base);
 
        if($opcao == 1){
            $res = mysqli_query($con,"UPDATE agenda SET   nome_compromisso = '$nomeEvento' WHERE id_compromisso = $cod;");
            echo ("Nome do evento atualizado com sucesso!");
            mysqli_close($con,);
            echo "<center><h3><a href='atualizar.php'>Voltar para a página anterior</a></h3></center>";
        }else if($opcao == 2){
            $res = mysqli_query($con,"UPDATE agenda SET data_compromisso ='$dataEvento' WHERE id_compromisso = $cod;") ;
            echo ("Data do evento atualizada com sucesso!");
            mysqli_close($con);
            echo "<center><h3><a href='atualizar.php'>Voltar para a página anterior</a></h3></center>";
        }else if($opcao == 3){
            $res = mysqli_query($con,"UPDATE agenda SET hora_inicio ='$horaInicial' WHERE id_compromisso = $cod;") ;
            echo ("Hora inicial atualizada com sucesso!");
            mysqli_close($con);
            echo "<center><h3><a href='atualizar.php'>Voltar para a página anterior</a></h3></center>";
        }else if($opcao == 4){
            $res = mysqli_query($con,"UPDATE agenda SET hora_fim = '$horaFinal' WHERE id_compromisso = $cod;") ;
            echo ("Hora do Final do Evento atualizada com sucesso!");
            mysqli_close($con);
            echo "<center><h3><a href='atualizar.php'>Voltar para a página anterior</a></h3></center>";
        }else if($opcao == 5){
            $res = mysqli_query($con,"UPDATE agenda SET descricao= '$descricao' WHERE id_compromisso = $cod;") ;
            echo ("Descrição do Evento atualizada com sucesso!");
            mysqli_close($con);
            echo "<center><h3><a href='atualizar.php'>Voltar para a página anterior</a></h3></center>";
        }else if($opcao == 6){
            $res = mysqli_query($con,"UPDATE agenda SET localizacao= '$local' WHERE id_compromisso = $cod;") ;
            echo ("Local do Evento atualizada com sucesso!");
            mysqli_close($con);
            echo "<center><h3><a href='atualizar.php'>Voltar para a página anterior</a></h3></center>";
        }else if($opcao == 7){
            $res = mysqli_query($con,"UPDATE agenda SET responsavel= '$responsavel' WHERE id_compromisso = $cod;") ;
            echo ("Responsavel do Evento atualizada com sucesso!");
            mysqli_close($con);
            echo "<center><h3><a href='atualizar.php'>Voltar para a página anterior</a></h3></center>";
        }
    ?>
