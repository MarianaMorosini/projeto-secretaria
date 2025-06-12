<?php 

namespace App\Controllers\Alunos;

use DateTime;
use Core\Database;
use App\Controllers\AlunoController;

class EditarController
{

    public function index()
    {
        $db = Database::getInstance();

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: /aluno');
            exit;
        }

        $aluno = $db->query(
            query: "SELECT id, nome, cpf, DATE_FORMAT(data_nascimento, '%Y-%m-%d') AS data_nascimento FROM alunos WHERE id = :id",
            params: ['id' => $id]
        )->fetch();

        if (!$aluno) {
            header('Location: /aluno');
            exit;
        }

        return view('alunos/editar', compact('aluno'));
    }

    public function edit()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $db = Database::getInstance();

        $id = $_POST['id'] ?? null;
        $nome = trim($_POST['nome'] ?? '');
        $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
        $data_nascimento = $_POST['data_nascimento'] ?? '';

        $erros = [];
        
        $validaCpf= (new AlunoController())->validarCpf($cpf);
        if (empty($cpf) || !$validaCpf) {
            $erros[] = "CPF inválido.";
            goto erros;
        }
        $cpfExistente = (new AlunoController())->getAlunoByCpf($cpf, $id);
        if ($cpfExistente) {
            $erros[] = "Já existe um aluno cadastrado com este CPF.";
            goto erros;
        }

        if (!$id) {
            $erros[] = "ID do aluno não informado.";
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
                query: "UPDATE alunos SET nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento WHERE id = :id",
                params: [
                    'id' => $id,
                    'nome' => $nome,
                    'cpf' => $cpf,
                    'data_nascimento' => $data_nascimento
                ]
            );
            $_SESSION['success'] = 'Aluno atualizado com sucesso!';
            header('Location: /aluno');
            exit;
        } else {
            erros:
            $aluno = [
                'id' => $id,
                'nome' => $nome,
                'cpf' => $cpf,
                'data_nascimento' => $data_nascimento
            ];
            return view('alunos/editar', ['aluno' => $aluno, 'erros' => $erros]);
        }
    }
}