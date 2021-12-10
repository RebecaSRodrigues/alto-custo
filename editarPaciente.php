
<div class="modal fade" id="modal-paciente<?php echo $paciente['cpf'];?>" tabindex="-1" aria-labelledby="modal-paciente-Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-paciente-Label">Editar Paciente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <form action="" method="post">            
                    <div class="col">
                        <div class="column">
                            <label class="form-label">Nome:</label>
                            <input class="input" type="text" name="ipNome" value="<?php echo $paciente["nome"] ?>" required/>
                        </div>
                        <div class="column">
                            <label class="form-label">CPF</label>
                            <input type="text" class="input" name="ipCpf" value="<?php echo $paciente["cpf"] ?>" required>
                        </div>

                        <div class="column">
                            <label class="form-label">CNS:</label>
                            <input class="input" name="ipCns" type="text" value="<?php echo $paciente["cns"] ?>" disabled/>
                        </div>
                        <div class="column">
                            <label class="form-label">Data de entrada:</label>
                            <input class="input" name="ipDtEntrada" type="date" value="<?php echo $paciente["dt_entrada"] ?>" disabled/>
                        </div>
                        <div class="column">
                            <label class="form-label">Data de nascimento:</label>
                            <input class="input" name="ipDtNascimento" type="date" value="<?php echo $paciente["dt_nascimento"] ?>" disabled/>
                        </div>
                        <div class="column">
                            <label class="form-label">Endereço:</label>
                            <input class="input" name="ipEndereco" type="text" value="<?php echo $paciente["endereco"] ?>"/>
                        </div>
                        <div class="column">
                            <label class="form-label">Bairro:</label>
                            <input class="input" name="ipBairro" type="text" value="<?php echo $paciente["bairro"] ?>"/>
                        </div>
                        <div class="column">
                            <label class="form-label">Cidade:</label>
                            <input class="input" name="ipCidade" type="text" value="<?php echo $paciente["cidade"] ?>"/>
                        </div>
                        <div class="column">
                            <label class="form-label">Estado:</label>
                            <input class="input" name="ipEstado" type="text" value="<?php echo $paciente["estado"] ?>"/>
                        </div>
                    </div>  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>            
                        <button type="submit" id="btn-editar" name="btn-editar" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>