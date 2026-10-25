<?php
require_once('../model/Venda.php');

class vendaController {
    public function consultar() {
        $vendaModel = new Venda();
        return $vendaModel->consulta();
    }

    public function handleRequest() {
    }
}
$VendaController = new vendaController();
$VendaController->handleRequest();
?>
