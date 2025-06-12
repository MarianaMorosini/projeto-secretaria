<?php 

namespace App\Controllers\Alunos;

use DateTime;
use Core\Database;
use App\Models\Aluno;
use App\Controllers\AlunoController;

class CriarController
{

    public function index()
    {
        return view('alunos/criar');
    }

    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $db = Database::getInstance();

        $nome = trim($_POST['nome'] ?? '');
        $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
        $data_nascimento = $_POST['data_nascimento'] ?? '';

        
        $erros = [];

        $validaCpf= (new AlunoController())->validarCpf($cpf);
        if (empty($cpf) || !$validaCpf) {
            $erros[] = "CPF inválido.";
            goto erros;
        }
        $cpfExistente = (new AlunoController())->getAlunoByCpf($cpf);
        if ($cpfExistente) {
            $erros[] = "Já existe um aluno cadastrado com este CPF.";
            goto erros;
        }

        if (empty($nome) || strlen($nome) < 3) {
            $erros[] = "Nome é obrigatório, mínimo de 3 caracteres.";
            goto erros;
        }
        if (empty($data_nascimento)) {
            $erros[] = "Data de nascimento é obrigatória.";
            goto erros;
        } elseif (!\DateTime::createFromFormat('Y-m-d', $data_nascimento)) {
            $erros[] = "Data de nascimento inválida";
            goto erros;
        }

        if (empty($erros)) {
            $db->query(
                query: "INSERT INTO alunos (nome, cpf, data_nascimento) VALUES (:nome, :cpf, :data_nascimento)", 
                params: ['nome' => $nome, 'cpf' => $cpf, 'data_nascimento' => $data_nascimento]
            );

            $_SESSION['success'] = 'Aluno cadastrado com sucesso!';
            header('Location: /aluno');
            exit;
            
        } else {
            erros:
            $_SESSION['erros'] = $erros;
            header('Location: /aluno/criar');
        }
    }
}