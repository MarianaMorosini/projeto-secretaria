<?php 

namespace App\Controllers;

use Core\Database;
use App\Models\Aluno;

class AlunoController
{

    public function index()
    { 
        $alunos = $this->getAlunos();
        if (empty($alunos)) {
            $alunos = [];
        }

        return view('aluno', compact('alunos'));
    }

    public function pesquisarAluno() {
        $db = Database::getInstance();

        $pesquisar = $_REQUEST['pesquisar-aluno'] ?? '';

        if (empty($pesquisar)) {
            // Se o campo estiver vazio, retorna todos os alunos
            $alunos = $db->query(
                "SELECT id, nome, cpf, DATE_FORMAT(data_nascimento, '%d/%m/%Y') AS data_nascimento FROM alunos ORDER BY nome ASC"
            )->fetchAll();
        } else {
            $alunos = $db->query(
                query: "SELECT id, nome, cpf, DATE_FORMAT(data_nascimento, '%d/%m/%Y') AS data_nascimento FROM alunos WHERE nome LIKE :filtro", 
                params: ['filtro' => "%$pesquisar%"]
            )->fetchAll();
        }

        view('aluno', compact('alunos'));
    }
    
    public function getAlunos()
    {
        $db = Database::getInstance();

        $alunos = $db->query(
                "SELECT 
                    id, nome, cpf, DATE_FORMAT(data_nascimento, '%d/%m/%Y') AS data_nascimento 
                FROM 
                    alunos
                ORDER BY
                    nome ASC"
            )
            ->fetchAll();
            
        return $alunos;
    }

    public function getAlunoById($id)
    {
        $db = Database::getInstance();

        $aluno = $db->query(
            query: "SELECT 
                        id, nome, cpf, data_nascimento 
                    FROM 
                        alunos 
                    WHERE 
                        id = :id",
            params: ['id' => $id]
        )
        ->fetch(\PDO::FETCH_ASSOC);

        return $aluno;
    }

    public function getAlunoByCpf($cpf, $ignoreId = null)
    {
        $db = Database::getInstance();

        $query = "SELECT id, nome, cpf, data_nascimento FROM alunos WHERE cpf = :cpf";
        $params = ['cpf' => $cpf];

        if ($ignoreId !== null) {
            $query .= " AND id != :ignoreId";
            $params['ignoreId'] = $ignoreId;
        }

        $aluno = $db->query(
            query: $query,
            params: $params
        )->fetch(\PDO::FETCH_ASSOC);

        return $aluno;
    }

    public function validarCpf($cpf)
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se tem 11 dígitos e se todos são iguais
        if (preg_match('/(\d)\1{10}/', $cpf) || strlen($cpf) != 11) {
            return false;
        }

        // Validação dos dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += (int)$cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ((int)$cpf[$c] !== $d) {
                return false;
            }
        }

        return true;
    }

    
}