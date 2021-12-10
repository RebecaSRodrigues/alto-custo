<?php

class Paciente {

    private $cpf;
    private $nome;
    private $cns;
    private $dt_entrada;
    private $dt_nascimento;
    private $endereco;
    private $email;
    private $telefone;
    private $bairro;
    private $cidade;
    private $estado;
    private $statusPaciente;

    private $conn;

    function __construct(){
        // Cria uma conexão com o banco de dados
        $this->openConexao();

        // Define o local da hora
        date_default_timezone_set('America/Sao_Paulo');        

    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;        
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCns() {
        return $this->cns;
    }

    public function setCns($cns) {
        $this->cns = $cns;
    }

    public function getDtEntrada() {
        return $this->dt_entrada;
    }

    public function setDtEntrada($dt_entrada) {
        $this->dt_entrada = $dt_entrada;
    }

    public function getDtNascimento() {
        return $this->dt_nascimento;
    }

    public function setDtNascimento($dt_nascimento) {
        $this->dt_nascimento = $dt_nascimento;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getStatusPaciente() {
        return $this->statusPaciente;
    }

    public function setStatusPaciente($statusPaciente) {
        $this->statusPaciente = $statusPaciente;
    }

    public function insertPaciente(){ 

        // Prepara o comando SQL
        $sql = "INSERT INTO paciente (cpf, nome, cns, dt_entrada, dt_nascimento, endereco, email, telefone, bairro, cidade, estado, statusPaciente) 
        VALUES('{$this->cpf}',
                '{$this->nome}',
                '{$this->cns}',
                '{$this->dt_entrada}',
                '{$this->dt_nascimento}',
                '{$this->endereco}',
                '{$this->email}',
                '{$this->telefone}',
                '{$this->bairro}',
                '{$this->cidade}',
                '{$this->estado}',
                '{$this->statusPaciente}')";        

        // Executa o comando SQL
        if(!mysqli_query($this->conn, $sql)){
            echo "Ocorreu um erro: " . mysqli_error($this->conn) . "<br>";
        }        
    }

    public function selectAll(){
        // Prepara o comando SQL
        $sql = "SELECT * FROM paciente";        

        // Executa a query           
        $resultado = mysqli_query($this->conn, $sql);
        
        // Armazena os dados em um array
        $pacientes = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        // Libera o $resultado da memória
        mysqli_free_result($resultado);

        return $pacientes;
    }

    public function selectByCpf(){
        // Prepara o comando SQL
        $sql = "SELECT * FROM paciente Where cpf = $this->cpf";        

        // Executa a query           
        $resultado = mysqli_query($this->conn, $sql);
        
        // Armazena os dados em um array
        $paciente = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        // Libera o $resultado da memória
        mysqli_free_result($resultado);

        return $paciente;
    }

    public function ativoPaciente(){ 
        
        // Prepara o comando SQL
        $sql = "UPDATE paciente SET statusPaciente = '{$this->statusPaciente}' WHERE cpf = $this->cpf";

        // Executa o comando SQL
        if(!mysqli_query($this->conn, $sql)){
            echo "Ocorreu um erro: " . mysqli_error($this->conn) . "<br>";
        }
                
        exit;
    }

    public function updatePaciente(){ 
        // Prepara o comando SQL
        $sql = "UPDATE paciente 
                SET nome = '{$this->nome}', 
                endereco = '{$this->endereco}',
                email = '{$this->email}',
                telefone = '{$this->telefone}',
                bairro = '{$this->bairro}',
                cidade = '{$this->cidade}',
                estado = '{$this->estado}'
                WHERE cpf = '{$this->cpf}'" ;

        // Executa o comando SQL
        if(!mysqli_query($this->conn, $sql)){
            echo "Ocorreu um erro: " . mysqli_error($this->conn) . "<br>";
        }
    }

    public function procuraPorNome() {
        $sql = "SELECT * FROM paciente WHERE nome LIKE '{$this->nome}%'";

        // Executa a query           
        $resultado = mysqli_query($this->conn, $sql);
        
        // Armazena os dados em um array
        $paciente = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        // Libera o $resultado da memória
        mysqli_free_result($resultado);

        return $paciente;
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