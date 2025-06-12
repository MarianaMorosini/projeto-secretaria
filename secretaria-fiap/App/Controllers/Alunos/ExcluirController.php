<?php 

namespace App\Controllers\Alunos;

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

        $totalMatricula = (new MatriculaController())->totalMatriculasAluno($id);

        if ($totalMatricula['total'] > 0) {
            $_SESSION['erros'] = ['Não é possível excluir: o aluno possui matrícula(s) ativa(s).'];
            header('Location: /aluno');
            exit;
        }
        
        $db->query(
            query: "DELETE FROM alunos WHERE id = :id", 
            params: ['id' => $id]
        );

        $_SESSION['success'] = 'Aluno excluído com sucesso!';
        header('Location: /aluno');
        exit;
    }
}