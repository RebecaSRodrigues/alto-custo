<?php if (count($pacientesPesquisa) > 0): ?>
    <div class="d-flex justify-content-center" >
        <table class="table table-hover w-50">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">CNS</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="tabela-pesquisa">
                <?php foreach ($pacientesPesquisa as $paciente): ?>
                <tr>
                    <td><?php echo $paciente['nome'];?></td>
                    <td><?php echo $paciente['cpf'];?></td>
                    <td><?php echo $paciente['cns'];?></td>
                    <?php if ($paciente['statusPaciente'] == 1): ?>
                        <td>Ativo</td>
                    <?php else: ?>
                        <td>Inativo</td>
                    <?php endif; ?>  
                    <td>
                        <button type="button" class="btn-primary" data-bs-toggle="modal" data-bs-target="#modal-paciente<?php echo $paciente['cpf'];?>">
                            Editar/Visualizar 
                        </button>
                        <a href="index.php?cpf=<?= $paciente['cpf']; ?>&metodo=status&&statusPaciente=<?= $paciente['statusPaciente']; ?>">
                            <button class="btn-dark" name="status" id="statusButton">Inativo/Ativo</button>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="text-center">A pesquisa não retornou nenhum resultado.</p>    
<?php endif; ?>  