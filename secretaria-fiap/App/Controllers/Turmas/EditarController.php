<?php 

namespace App\Controllers\Turmas;

use Core\Database;

class EditarController
{
    public function index()
    {
        $db = Database::getInstance();

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: /turma');
            exit;
        }

        $turma = $db->query(
            query: "SELECT id, nome, descricao FROM turmas WHERE id = :id",
            params: ['id' => $id]
        )->fetch();

        if (!$turma) {
            header('Location: /turma');
            exit;
        }

        return view('turmas/editar', compact('turma'));
    }

    public function edit()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $db = Database::getInstance();

        $id = $_POST['id'] ?? null;
        $nome = trim($_POST['nome'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');

        $erros = [];

        if (!$id) {
            $erros[] = "ID da turma não informado.";
        }
        if (empty($nome) || strlen($nome) < 3){
            $erros[] = "Nome é obrigatório, mínimo de 3 caracteres.";
        }
        if (empty($descricao)) {
            $erros[] = "Descrição é obrigatório.";
        }

        if (empty($erros)) {
            $db->query(
                query: "UPDATE turmas SET nome = :nome, descricao = :descricao WHERE id = :id",
                params: [
                    'id' => $id,
                    'nome' => $nome,
                    'descricao' => $descricao
                ]
            );

            $_SESSION['success'] = 'Turma atualizada com sucesso!';
            header('Location: /turma');
            exit;

        } else {
            
            $turma = [
                'id' => $id,
                'nome' => $nome,
                'descricao' => $descricao
            ];
            
            return view('turmas/editar', ['turma' => $turma, 'erros' => $erros]);
        }
    }
}