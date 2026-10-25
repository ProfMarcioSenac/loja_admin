<?php
require_once('../config/conexao.php');

class Venda extends Conexao {
    private $tabela = 'vendas';

    public function __construct() {
        parent::__construct();
    }

    public function consulta() {
        $sql = "SELECT v.id, u.usuario, p.nome AS produto, v.quantidade, v.valor_total, v.data_criado 
                FROM $this->tabela v 
                INNER JOIN usuarios u ON v.id_usuario = u.id_usuario 
                INNER JOIN produtos p ON v.id_produto = p.id 
                ORDER BY v.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
