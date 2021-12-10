<?php
    include_once ("includes/header.php");
    require 'classes/Remedio.php';
?>

<div class="d-flex justify-content-center mt-5">
    <h1 class="header-cadastro">CADASTRO ALTO CUSTO - REMÉDIO</h1>
</div>    


<div class="container p-0 mt-5 div-form bg-verde">
    <form id="form-usuario" class="row g-3" action="" method="post">            
        <div class="col-6">
            <div class="column">
                <label class="form-label">Código:</label>
                <input class="input" type="text" name="ipCodigo" required>
            </div>
            <div class="column">
                <label class="form-label">Nome:</label>
                <input class="input" type="text" name="ipNome" required/>
            </div>
            <div class="column d-flex justify-content-end">
                <button type="submit" class="btn" name="btn-adicionar" id="btn-adicionar">Adicionar</button>
            </div>
        </div>    
    </form>
</div>

<?php  
    include_once('includes/footer.php');
    $remedio = new Remedio(); 

    if (isset($_POST['btn-adicionar'])) {
        
        $remedio->setCodigo($_POST["ipCodigo"]);
        $remedio->setNome($_POST["ipNome"]);

        //$remedio->setStatusremedio(true);

        $remedio->insertRemedio();
    }
?>