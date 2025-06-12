<?php 

namespace App\Controllers\Turmas;

use Core\Database;
use App\Controllers\MatriculaController;

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
        
        // Verifica se existem alunos matriculados na turma
        $totalMatricula = (new MatriculaController())->totalMatriculasTurma($id);

        if ($totalMatricula['total'] > 0) {
            $_SESSION['erros'] = ['Não é possível excluir a turma: existem alunos matriculados.'];
            header('Location: /turma');
            exit;
        }

        $db->query(
            query: "DELETE FROM turmas WHERE id = :id", 
            params: ['id' => $id]
        );

        $_SESSION['success'] = 'Turma excluída com sucesso!';
        header('Location: /turma');
        exit;
    }
}