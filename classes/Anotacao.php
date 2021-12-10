<?php

class Anotacao {
    
    private $texto;
    private $idPaciente;

    private $conn;

    function __construct(){
        // Cria uma conexão com o banco de dados
        $this->openConexao();

        // Define o local da hora
        date_default_timezone_set('America/Sao_Paulo');        

    }

    public function getTexto() {
        return $this->texto;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function getIdPaciente() {
        return $this->idPaciente;
    }

    public function setIdPaciente($idPaciente) {
        $this->idPaciente = $idPaciente;
    }

    public function insertAnotacao(){ 

        // Prepara o comando SQL
        $sql = "INSERT INTO anotacoes (texto, id_paciente) 
        VALUES('{$this->texto}',
                '{$this->idPaciente}')";        

        // Executa o comando SQL
        if(!mysqli_query($this->conn, $sql)){
            echo "Ocorreu um erro: " . mysqli_error($this->conn) . "<br>";
        }        
    }

    public function selectByPaciente(){
        // Prepara o comando SQL
        $sql = "SELECT * FROM anotacoes Where id_paciente = $this->idPaciente";        

        // Executa a query           
        $resultado = mysqli_query($this->conn, $sql);
        
        // Armazena os dados em um array
        $remedio = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        // Libera o $resultado da memória
        mysqli_free_result($resultado);

        return $anotacoes;
    }

    public function updateRemedio(){ 
        // Prepara o comando SQL
        $sql = "UPDATE anotacoes 
                SET texto = '{$this->texto}'" ;

        // Executa o comando SQL
        if(!mysqli_query($this->conn, $sql)){
            echo "Ocorreu um erro: " . mysqli_error($this->conn) . "<br>";
        }
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