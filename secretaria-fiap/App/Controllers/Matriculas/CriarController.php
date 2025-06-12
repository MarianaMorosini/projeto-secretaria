<?php 

namespace App\Controllers\Matriculas;

use Core\Database;
use App\Controllers\TurmaController;
use App\Controllers\AlunoController;
use App\Controllers\Matriculas\ListarController;

require_once 'App/Controllers/Matriculas/ListarController.php';

class CriarController
{

    public function index()
    {
        $alunos = (new AlunoController())->getAlunos();
        $turma_id = $_GET['id'] ?? null;
        $turma = null;

        if ($turma_id) {
            $turma = (new TurmaController())->getTurmaById($turma_id);
        }
        
        return view('matriculas/criar', [
            'alunos' => $alunos,
            'turma' => $turma,
        ]);
    }

    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $erros = [];

        // validações
        $aluno_id = $_POST['aluno_id'] ?? null;
        if (empty($aluno_id)) {
            $erros[] = 'ID do aluno é obrigatório.';
            return view('matriculas/criar', [
                'erros' => $erros,
                'alunos' => (new AlunoController())->getAlunos(),
                'turma' => (new TurmaController())->getTurmaById($_POST['turma_id'] ?? null),
            ]);
        }

        // Verifica se o aluno existe
        $aluno = (new AlunoController())->getAlunoById($aluno_id);
        if (empty($aluno)) {
            $erros[] = 'Aluno não encontrado.';
            return view('matriculas/criar', [
                'erros' => $erros,
                'alunos' => (new AlunoController())->getAlunos(),
                'turma' => (new TurmaController())->getTurmaById($_POST['turma_id'] ?? null),
            ]);
        }

        $turma_id = $_POST['turma_id'] ?? null;
        if (empty($turma_id)) {
            $erros[] = 'ID da turma é obrigatório.';
            $_SESSION['erros'] = $erros;
            header('Location: /matricula');
            exit;
        }

        // Verifica se a turma existe
        $turmas = (new TurmaController())->getTurmaById($turma_id);
        if (empty($turmas)) {
            $erros[] = 'Turma não encontrada.';
            return view('matriculas/criar', [
                'erros' => $erros,
                'alunos' => (new AlunoController())->getAlunos(),
                'turma' => (new TurmaController())->getTurmaById($_POST['turma_id'] ?? null),
            ]);
        }

        // Verifica se aluno já está matriculado na turma
        $alunosMatriculados = (new ListarController())->alunosMatriculados($turma_id);

        if (!empty($alunosMatriculados)) {
            $idsMatriculados = array_column($alunosMatriculados, 'id');
    
            if (in_array($aluno_id, $idsMatriculados)) {
                $erros[] = 'Este aluno já está matriculado nesta turma.';
                return view('matriculas/criar', [
                    'erros' => $erros,
                    'alunos' => (new AlunoController())->getAlunos(),
                    'turma' => (new TurmaController())->getTurmaById($_POST['turma_id'] ?? null),
                ]);
            }
        }

        $db = Database::getInstance();

        $db->query(
            query: "INSERT INTO matriculas (aluno_id, turma_id) VALUES (:aluno_id, :turma_id)", 
            params: ['aluno_id' => $aluno_id, 'turma_id' => $turma_id]
        );

        $_SESSION['success'] = 'Matrícula criada com sucesso!';
        header('Location: /matricula');
        exit;
        
    }
}