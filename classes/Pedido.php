<?php

class Pedido {
    
    private $idPaciente;
    private $idRemedio;
    private $tipo;
    private $status;
    private $qtdeMensal;

    private $conn;

    function __construct(){
        // Cria uma conexão com o banco de dados
        $this->openConexao();

        // Define o local da hora
        date_default_timezone_set('America/Sao_Paulo');        

    }

    public function getIdPaciente() {
        return $this->idPaciente;
    }

    public function setIdPaciente($idPaciente) {
        $this->idPaciente = $idPaciente;
    }

    public function getIdRemedio() {
        return $this->idRemedio;
    }

    public function setIdRemedio($idRemedio) {
        $this->idRemedio = $idRemedio;
    }
    
    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getQtdeMensal() {
        return $this->qtdeMensal;
    }

    public function setQtdeMensal($qtdeMensal) {
        $this->qtdeMensal = $qtdeMensal;
    }


    public function insertPedido(){ 

        // Prepara o comando SQL
        $sql = "INSERT INTO pedido (id_paciente, id_remedio, tipo, status, qtde_mensal) 
        VALUES('{$this->idPaciente}',
               '{$this->idRemedio}',
               '{$this->tipo}',
               '{$this->status}',
               '{$this->qtdeMensal}')";        

        // Executa o comando SQL
        if(!mysqli_query($this->conn, $sql)){
            echo "Ocorreu um erro: " . mysqli_error($this->conn) . "<br>";
        }        
    }

    public function selectByPaciente($cpf){
        // Prepara o comando SQL
        $sql = "SELECT * FROM pedido Where id_paciente = $cpf";        

        // Executa a query           
        $resultado = mysqli_query($this->conn, $sql);
        
        // Armazena os dados em um array
        $pedido = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        // Libera o $resultado da memória
        mysqli_free_result($resultado);

        return $pedido;
    }
    
    private function openConexao(){
        $host = "localhost";
        $database = "alto_custo";
        $user = "admin";
        $password = "admin";
        
        $this->conn = mysqli_connect($host, $password, $user, $database);
        $this->conn->set_charset("utf8");
    
        if(mysqli_connect_errno()){
            echo "Erro na conexao com o banco de dados";
        }
    }

    function __destruct(){
        mysqli_close($this->conn);   
    }
}