<?php
abstract class Conexao {
    private $servidor = 'localhost';
    private $porta = '3307';
    private $user = 'root';
    private $pass = '';
    private $banco = 'loja_online';
    protected $conn;

    public function __construct() {
        $this->conexao();
    }

    private function conexao() {
        $this->conn = new PDO("mysql:host=$this->servidor;port=$this->porta;dbname=$this->banco", $this->user, $this->pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
?>
