<?php 

namespace App\Controllers\Matriculas;

use Core\Database;
use App\Controllers\TurmaController;
use App\Controllers\AlunoController;

class ListarController
{
    public function index()
    {
        $turma_id = $_GET['id'] ?? null;
        $turma = null;

        if ($turma_id) {
            $turma = (new TurmaController())->getTurmaById($turma_id);
        }

        $alunos = $this->alunosMatriculados($turma_id);

        return view('matriculas/listar', [
            'alunos' => $alunos,
            'turma' => $turma,
        ]);
    }

    public function alunosMatriculados($turma_id)
    {
        if(empty($turma_id)) {
            $turma_id = $_GET['id'] ?? null;
        }

        $db = Database::getInstance();

        $alunosMatriculados = $db->query(
            query: "SELECT 
                        alunos.id, alunos.nome, cpf, DATE_FORMAT(data_nascimento, '%d/%m/%Y') AS data_nascimento
                    FROM 
                        alunos
                    INNER JOIN 
                        matriculas
                    ON
                        matriculas.aluno_id = alunos.id AND matriculas.turma_id = :turma_id
                    ORDER BY
                        nome ASC",
            params: ['turma_id' => $turma_id]
        )
        ->fetchAll(\PDO::FETCH_ASSOC);

        return $alunosMatriculados;
            
    }
}
