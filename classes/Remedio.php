<?php

class Remedio {
    
    private $codigo;
    private $nome;

    private $conn;

    function __construct(){
        // Cria uma conexão com o banco de dados
        $this->openConexao();

        // Define o local da hora
        date_default_timezone_set('America/Sao_Paulo');        

    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function insertRemedio(){ 

        // Prepara o comando SQL
        $sql = "INSERT INTO remedio (codigo, nome) 
        VALUES('{$this->codigo}',
                '{$this->nome}')";        

        // Executa o comando SQL
        if(!mysqli_query($this->conn, $sql)){
            echo "Ocorreu um erro: " . mysqli_error($this->conn) . "<br>";
        }        
    }

    public function selectAll(){
        // Prepara o comando SQL
        $sql = "SELECT * FROM remedio";        

        // Executa a query           
        $resultado = mysqli_query($this->conn, $sql);
        
        // Armazena os dados em um array
        $remedios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        // Libera o $resultado da memória
        mysqli_free_result($resultado);

        return $remedios;
    }

    public function selectByCodigo(){
        // Prepara o comando SQL
        $sql = "SELECT * FROM remedio Where codigo = $this->codigo";        

        // Executa a query           
        $resultado = mysqli_query($this->conn, $sql);
        
        // Armazena os dados em um array
        $remedio = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        // Libera o $resultado da memória
        mysqli_free_result($resultado);

        return $remedio;
    }

    public function updateRemedio(){ 
        // Prepara o comando SQL
        $sql = "UPDATE remedio 
                SET nome = '{$this->nome}'" ;

        // Executa o comando SQL
        if(!mysqli_query($this->conn, $sql)){
            echo "Ocorreu um erro: " . mysqli_error($this->conn) . "<br>";
        }
    }

    public function procuraPorNome() {
        $sql = "SELECT * FROM remedio WHERE nome LIKE '{$this->nome}%'";

        // Executa a query           
        $resultado = mysqli_query($this->conn, $sql);
        
        // Armazena os dados em um array
        $remedio = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        // Libera o $resultado da memória
        mysqli_free_result($resultado);

        return $remedio;
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