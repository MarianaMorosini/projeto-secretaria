<?php 
namespace App\Controllers;

use Core\Database;
use App\Controllers\MatriculaController;

class TurmaController
{
    public function index()
    {
        $turmas = $this->getTurmas();
        if (empty($turmas)) {
            $turmas = [];
        }

        return view('turma', compact('turmas'));
    }

    public function pesquisarTurma() {
        $db = Database::getInstance();

        $pesquisar = $_REQUEST['pesquisar-turma'] ?? '';

        if (empty($pesquisar)) {
            $turmas = $db->query(
                "SELECT id, nome, descricao FROM turmas ORDER BY nome ASC"
            )->fetchAll();
        } else {
            $turmas = $db->query(
                query: "SELECT id, nome, descricao FROM turmas WHERE nome LIKE :filtro", 
                params: ['filtro' => "%$pesquisar%"]
            )->fetchAll();

        }
        
        $matricula = new MatriculaController();

        foreach ($turmas AS &$turma) {
            $totalMatriculados = $matricula->totalMatriculasTurma($turma['id']);
            $turma['totalMatriculas'] = $totalMatriculados['total'];
        }

        view('turma', compact('turmas'));
    }

    public function getTurmas()
    {
        $db = Database::getInstance();

        $turmas = $db->query(
            "SELECT 
                id, nome, descricao 
            FROM 
                turmas
            ORDER BY
                nome ASC"
        )
        ->fetchAll();

        $matricula = new MatriculaController();

        foreach ($turmas AS &$turma) {
            $totalMatriculados = $matricula->totalMatriculasTurma($turma['id']);
            $turma['totalMatriculas'] = $totalMatriculados['total'];
        }

        return $turmas;
    }

    public function getTurmaById($id)
    {
        $db = Database::getInstance();

        $turma = $db->query(
            query:"SELECT 
                id, nome, descricao 
            FROM 
                turmas 
            WHERE 
                id = :id",
            params: ['id' => $id]
        )
        ->fetch(\PDO::FETCH_ASSOC);

        return $turma;
    }
}