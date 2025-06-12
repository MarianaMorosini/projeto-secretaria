<?php 
namespace App\Controllers;

require_once 'App/Controllers/TurmaController.php';

use Core\Database;
use App\Controllers\TurmaController;


class MatriculaController
{
    public function index()
    {
        $turma = new TurmaController();
        $turmas = $turma->getTurmas();

        return view('matricula', compact('turmas'));
    }

    public function totalMatriculasTurma($id_turma)
    {
        $db = Database::getInstance();
        
        $totalMatriculas = $db->query(
            query: "SELECT COUNT(*) as total FROM matriculas WHERE turma_id = :id",
            params: ['id' => $id_turma]
        )->fetch(\PDO::FETCH_ASSOC);

        return $totalMatriculas;
    }

    
    public function totalMatriculasAluno($id_aluno)
    {
        $db = Database::getInstance();
        
        $totalMatriculas = $db->query(
            query: "SELECT COUNT(*) as total FROM matriculas WHERE aluno_id = :id",
            params: ['id' => $id_aluno]
        )->fetch(\PDO::FETCH_ASSOC);

        return $totalMatriculas;
    }
}