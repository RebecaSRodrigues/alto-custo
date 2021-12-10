<?php
    include_once ("includes/header.php");
    require 'classes/Paciente.php';
    require 'classes/Remedio.php';
    require 'classes/Pedido.php';

    function dd($param)
    {
        echo '<pre>';
        var_dump($param);
        die;
    }
    $paciente = new Paciente();
    $remedio = new Remedio();
    $pedido = new Pedido();

    $allRemedios = $remedio->selectAll();
    $allPacientes = $paciente->selectAll();
?>

<div class="container mt-5 div-form bg-light">
    <div class="col-12">
        <form action="" method="post" id="form-pesquisa" class="text-center pb-5">
            <input type="search" aria-label="Search" name="pesquisa" id="pesquisa" class="w-25">
            <input type="submit" class="btn btn-outline-primary" name="btn-pesquisa" id="btn-pesquisa" value="Pesquisar"></input>
        </form>

        <table class="table table-hover" id="tabela-paciente">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">CNS</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allPacientes as $paciente): ?>
                <tr>
                    <td><?= $paciente['nome'];?></td>
                    <td><?= $paciente['cpf'];?></td>
                    <td><?= $paciente['cns'];?></td>
                    <?php if ($paciente['statusPaciente'] == 1): ?>
                        <td>Ativo</td>
                    <?php else: ?>
                        <td>Inativo</td>
                    <?php endif; ?>  
                    <td>
                        <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#modal-paciente<?= $paciente['cpf'];?>">
                            Editar/Visualizar 
                        </button>
                        <a href="index.php?cpf=<?= $paciente['cpf']; ?>&&metodo=status&&statusPaciente=<?= $paciente['statusPaciente']; ?>">
                            <button class="btn-dark" name="status" id="statusButton">Inativo/Ativo</button>
                        </a>
                    </td>
                </tr>
                <?php  include("editarPaciente.php"); ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $( document ).ready(function() {
        if(document.getElementById("tabela-pesquisa") != null){
            document.getElementById("tabela-paciente").style.display = "none";
        }
        // if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
        //     document.getElementById("tabela-paciente").style.display = "block";
        //     document.getElementById("tabela-pesquisa").style.display = "none";
        // }
    });
</script>

<?php  
    include_once('includes/footer.php');
    $paciente = new Paciente(); 

    if (isset($_GET['cpf']) && isset($_GET['metodo'])) {
        
        $paciente->setCPF($_GET['cpf']);
        
        if ($_GET['statusPaciente'] == 1) {
            $paciente->setStatusPaciente(false);
        } else {
            $paciente->setStatusPaciente(true);
        }

        $paciente->ativoPaciente();        
    }
    
    if(isset($_POST['btn-pesquisa'])) {
        $paciente->setNome($_POST['pesquisa']);

        $pacientesPesquisa = $paciente->procuraPorNome();   
        include_once("tabelaPacientes.php");
    }

    $paciente1 = new Paciente();

    if (isset($_POST['btn-editar'])) {
        $paciente1->setNome($_POST["ipNome"]);
        $paciente1->setCpf($_POST["ipCpf"]);  
        $paciente1->setEndereco($_POST["ipEndereco"]);
        $paciente1->setBairro($_POST["ipBairro"]);
        $paciente1->setCidade($_POST["ipCidade"]);
        $paciente1->setEstado($_POST["ipEstado"]);
                
        $paciente1->updatePaciente();

    }
?>