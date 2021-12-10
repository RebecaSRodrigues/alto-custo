<?php
    include_once ("includes/header.php");
    require 'classes/Paciente.php';
    require 'classes/Anotacao.php';
    require 'classes/Remedio.php';
    require 'classes/Pedido.php';

    function dd($param)
    {
        echo '<pre>';
        var_dump($param);
        die;
    }

    $remedio = new Remedio();

    $allRemedios = $remedio->selectAll();
?>

<div class="d-flex justify-content-center mt-5">
    <h1 class="header-cadastro">CADASTRO ALTO CUSTO - PACIENTE</h1>
</div>    


<div class="m-5 p-0 mt-5 div-form bg-verde">
    <form id="form-usuario" class="row g-3" action="" method="post">            
        <div class="col-4">
            <div class="column">
                <label class="form-label" for="ipNome">Nome:</label>
                <input class="input" id="ipNome" type="text" name="ipNome" required/>
            </div>
            <div class="column">
                <label class="form-label" for="RegraValida">CPF:</label>
                <input class="input" type="text" id="RegraValida" value="" maxlength="14" name="RegraValida" onkeydown="javascript: fMasc( this, mCPF );" required>
            </div>
            <div class="column">
                <label class="form-label" for="ipCns">CNS:</label>
                <input class="input" id="ipCns" name="ipCns" type="text" required/>
            </div>
            <div class="column">
                <label class="form-label" for="ipDtEntradaipDtEntrada">Data de entrada:</label>
                <input class="input" id="ipDtEntrada" name="ipDtEntrada" type="date"/>
            </div>
            <div class="column">
                <label class="form-label" for="ipDtNascimento">Data de nascimento:</label>
                <input class="input" id="ipDtNascimento" name="ipDtNascimento" type="date"/>
            </div>
            <div class="column">
                <label class="form-label" for="ipEndereco">Endereço:</label>
                <input class="input" id="ipEndereco" name="ipEndereco" type="text"/>
            </div>
            <div class="column">
                <label class="form-label" for="ipBairro">Bairro:</label>
                <input class="input" id="ipBairro" name="ipBairro" type="text"/>
            </div>
            <div class="column">
                <label class="form-label" for="ipCidade">Cidade:</label>
                <input class="input" id="ipCidade" name="ipCidade" type="text"/>
            </div>
            <div class="column">
                <label class="form-label" for="ipEstado">Estado:</label>
                <input class="input" id="ipEstado" name="ipEstado" type="text"/>
            </div>
            <div class="column">
                <label class="form-label" for="ipEmail">Email:</label>
                <input class="input" id="ipEmail" name="ipEmail" type="text"/>
            </div>
            <div class="column">
                <label class="form-label" for="ipTelefone">Telefone:</label>
                <input class="input" id="ipTelefone" name="ipTelefone" type="text"/>
            </div>
        </div>  
        <div class="col-8 div-remedio">
            <div class="d-flex justify-content-center align-items-center">
                <h4>Adicionar ou remover linhas remédios:</h4>
                <span id="btn-adicionarCampo" class="m-1">+</span>
                <span id="btn-removerCampo">-</span>
            </div>
            <div class="linha-remedio">                
                <select class="form-select column" name="select-remedio">        
                    <?php foreach ($allRemedios as $remedio): ?>                
                        <option value="<?= $remedio['codigo'];?>"><?= $remedio['nome'];?></option>
                    <?php endforeach; ?>
                </select>
                <select class="form-select column" name="select-tipo">
                    <option value="Frasco">Frasco</option>
                    <option value="Comprimido">Comprimido</option>
                    <option value="Ampola">Ampola</option>
                    <option value="Caneta">Caneta</option>
                    <option value="Unidade">Unidade</option>
                    <option value="Caixa">Caixa</option>
                    <option value="Adesivo">Adesivo</option>
                </select>
                <select class="form-select column" name="select-status">
                    <option value="Chegou">Chegou</option>
                    <option value="Em falta">Em falta</option>
                    <option value="Precisa renovar">Precisa renovar</option>
                    <option value="Precisa de receita">Precisa de receita</option>
                    <option value="Inativo">Inativo</option>
                    <option value="Aguardando documentação">Aguardando documentação</option>
                    <option value="NOVO">NOVO</option>
                </select>
                <input class="form-control" name="ipQdtMensal" type="text" placeholder="Quantidade Mensal"/>
            </div>    
        </div>  
        <div class="col">
            <label class="form-label" for="anotacao">Anotação</label>
            <textarea name="anotacao" id="anotacao" cols="50" rows="10"></textarea>
        </div>  
        <div class="column d-flex justify-content-end">
            <button type="submit" class="btn" name="btn-cadastrar" id="btn-cadastrar">Cadastrar</button>
        </div>
    </form>
</div>

<?php  
    include_once('includes/footer.php');
    $paciente = new Paciente(); 
    $anotacao = new Anotacao();
    $pedido = new Pedido();

    if (isset($_POST['btn-cadastrar'])) {
        
        $paciente->setNome($_POST["ipNome"]);
        $paciente->setCpf(str_replace([".","-"], "", $_POST["RegraValida"]));  
        $paciente->setCns($_POST["ipCns"]);
        $paciente->setDtEntrada($_POST["ipDtEntrada"]);
        $paciente->setDtNascimento($_POST["ipDtNascimento"]);
        $paciente->setEndereco($_POST["ipEndereco"]);
        $paciente->setEmail($_POST["ipEmail"]);
        $paciente->setTelefone($_POST["ipTelefone"]);
        $paciente->setBairro($_POST["ipBairro"]);
        $paciente->setCidade($_POST["ipCidade"]);
        $paciente->setEstado($_POST["ipEstado"]);
        $paciente->setStatusPaciente(true);

        $paciente->insertPaciente();

        if($_POST["anotacao"] != '') {
            $anotacao->setTexto($_POST["anotacao"]);
            $anotacao->setIdPaciente(str_replace([".","-"], "", $_POST["RegraValida"]));

            $anotacao->insertAnotacao();
        }

        $pedido->setIdPaciente(str_replace([".","-"], "", $_POST["RegraValida"]));
        $pedido->setIdRemedio($_POST["select-remedio"]);
        $pedido->setTipo($_POST["select-tipo"]);
        $pedido->setStatus($_POST["select-status"]);
        $pedido->setQtdeMensal($_POST["ipQdtMensal"]);

        $pedido->insertPedido();
    }

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
?>