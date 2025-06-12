<?php 

namespace App\Controllers\Turmas;

use Core\Database;

class CriarController
{

    public function index()
    {
        return view('turmas/criar');
    }

    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $db = Database::getInstance();

        $nome = trim($_POST['nome'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');


        $erros = [];

        if (empty($nome) || strlen($nome) < 3) {
            $erros[] = "Nome é obrigatório, mínimo de 3 caracteres.";
        }
        if (empty($descricao)) {
            $erros[] = "Descrição é obrigatória.";
        }

        if (empty($erros)) {
            $db->query(
                query: "INSERT INTO turmas (nome, descricao) VALUES (:nome, :descricao)", 
                params: ['nome' => $nome, 'descricao' => $descricao]
            );

            $_SESSION['success'] = 'Turma cadastrada com sucesso!';
            header('Location: /turma');
            exit;
            
        } else {
            return view('turmas/criar', ['erros' => $erros]);
        }
    }
}