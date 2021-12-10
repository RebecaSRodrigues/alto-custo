<!-- <a href="?cpf="<?= $paciente['cpf']; ?>"> -->

<form name="form" action="" method="get">
    <input type="text" name="subject" id="subject" value="<?php echo $paciente['cpf']; ?>" hidden>
    <!-- <a data-bs-toggle="modal" id="" data-userid="<?php echo $paciente['cpf']; ?>" href="cadastroPaciente.php#modal-paciente" class="btn btn-primary">Visualizar/Editar</a> -->
    <input type="submit" value="Visualizar/Editar">
</form>

<a href="cadastroPaciente.php?cpf=<?= $paciente['cpf']; ?>&metodo=status&statusPaciente=<?= $paciente['statusPaciente']; ?>">
    <button class="btn-dark" name="status" id="statusButton">Inativo/Ativo</button>
</a>


<!-- Search bar from navbar bootstrap -->
<form class="d-flex">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>
<!-- Search bar from navbar bootstrap -->

    $('#modal-paciente').on('show.bs.modal', function(e) {
        var userid = $(e.relatedTarget).data('userid');
        console.log($(e.currentTarget));
        $(e.currentTarget).find('input[name="user_id"]').val(userid);
    });  




if(document.getElementById("tabela-pesquisa") != null){
    document.getElementById("tabela-paciente").style.display = "none";
}



<div id="div-form">
    <form id="form-usuario" action="" method="post">
        <div class="row">
            <div class="col-4">
                <div class="column">
                    <label class="form-label">Nome:</label>
                    <input class="input" type="text" name="ipNome" required/>
                </div>
                <div class="column">
                    <label class="form-label">CPF:</label>
                    <input class="input" type="text" id="RegraValida" value="" maxlength="14" name="RegraValida" onkeydown="javascript: fMasc( this, mCPF );" required>
                </div>
                <div class="column">
                    <label class="form-label">CNS:</label>
                    <input class="input" name="ipCns" type="text" required/>
                </div>
                <div class="column">
                    <label class="form-label">Data de entrada:</label>
                    <input class="input" name="ipDtEntrada" type="date"/>
                </div>
                <div class="column">
                    <label class="form-label">Data de nascimento:</label>
                    <input class="input" name="ipDtNascimento" type="date"/>
                </div>
                <div class="column">
                    <label class="form-label">Endereço:</label>
                    <input class="input" name="ipEndereco" type="text"/>
                </div>
                <div class="column">
                    <label class="form-label">Bairro:</label>
                    <input class="input" name="ipBairro" type="text"/>
                </div>
                <div class="column">
                    <label class="form-label">Cidade:</label>
                    <input class="input" name="ipCidade" type="text"/>
                </div>
                <div class="column">
                    <label class="form-label">Estado:</label>
                    <input class="input" name="ipEstado" type="text"/>
                </div>
                <div class="column">
                    <button type="submit" class="btn" name="btn-cadastrar" id="btn-cadastrar">Cadastrar</button>
                </div>
            </div>    
        </div>
    </form>
</div>





























<?php
    include_once ("includes/header.php");
    require 'classes/Paciente.php';
?>

<header class="header-cadastro">
    <h1>CADASTRO ALTO CUSTO - USUÁRIO</h1>
</header>

<div id="div-form">
    <form id="form-usuario" action="" method="post">
        <div class="row">
            <div class="col-4">
                <div class="column">
                    <label class="form-label">Nome:</label>
                    <input class="input" type="text" name="ipNome" required/>
                </div>
                <div class="column">
                    <label class="form-label">CPF:</label>
                    <input class="input" type="text" id="RegraValida" value="" maxlength="14" name="RegraValida" onkeydown="javascript: fMasc( this, mCPF );" required>
                </div>
                <div class="column">
                    <label class="form-label">CNS:</label>
                    <input class="input" name="ipCns" type="text" required/>
                </div>
                <div class="column">
                    <label class="form-label">Data de entrada:</label>
                    <input class="input" name="ipDtEntrada" type="date"/>
                </div>
                <div class="column">
                    <label class="form-label">Data de nascimento:</label>
                    <input class="input" name="ipDtNascimento" type="date"/>
                </div>
                <div class="column">
                    <label class="form-label">Endereço:</label>
                    <input class="input" name="ipEndereco" type="text"/>
                </div>
                <div class="column">
                    <label class="form-label">Bairro:</label>
                    <input class="input" name="ipBairro" type="text"/>
                </div>
                <div class="column">
                    <label class="form-label">Cidade:</label>
                    <input class="input" name="ipCidade" type="text"/>
                </div>
                <div class="column">
                    <label class="form-label">Estado:</label>
                    <input class="input" name="ipEstado" type="text"/>
                </div>
                <div class="column">
                    <button type="submit" class="btn" id="btn-cadastrar">Cadastrar</button>
                </div>
            </div>    
        </div>
    </form>
</div>

<?php 
    include_once('includes/footer.php');

    $paciente = new Paciente();     

 
    // dd($_POST);

    if (isset($_POST['btn-cadastrar'])) {
        dd("omg omg omg");
        $paciente->setNome($_POST["ipNome"]);
        $paciente->setCpf($_POST["RegraValida"]);
        $paciente->setCns($_POST["ipCns"]);
        $paciente->setDtEntrada($_POST["ipDtEntrada"]);
        $paciente->setDtNascimento($_POST["ipDtNascimento"]);
        $paciente->setEndereco($_POST["ipEndereco"]);
        $paciente->setBairro($_POST["ipBairro"]);
        $paciente->setCidade($_POST["ipCidade"]);
        $paciente->setEstado($_POST["ipEstado"]);

        $paciente->insertPaciente();
    }
?>