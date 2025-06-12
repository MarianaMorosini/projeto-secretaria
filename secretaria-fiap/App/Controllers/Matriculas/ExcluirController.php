<?php 

namespace App\Controllers\Matriculas;

use Core\Database;

class ExcluirController
{
    public function index()
    {
    }

    public function excluir()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $db = Database::getInstance();
        $id = $_GET['id'];
        
        $db->query(
            query: "DELETE FROM matriculas WHERE id = :id", 
            params: ['id' => $id]
        );

        $_SESSION['success'] = 'Matrícula excluída com sucesso!';
        header('Location: /matricula');
        exit;
    }
}