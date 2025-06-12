<?php 

require_once 'Core/Routes.php';
require_once 'Core/functions.php';
require_once 'Core/Database.php';
require_once 'App/Controllers/IndexController.php';

require_once 'App/Controllers/AlunoController.php';
require_once 'App/Controllers/Alunos/CriarController.php';
require_once 'App/Controllers/Alunos/EditarController.php';
require_once 'App/Controllers/Alunos/ExcluirController.php';

require_once 'App/Controllers/TurmaController.php';
require_once 'App/Controllers/Turmas/CriarController.php';
require_once 'App/Controllers/Turmas/EditarController.php';
require_once 'App/Controllers/Turmas/ExcluirController.php';

require_once 'App/Controllers/MatriculaController.php';
require_once 'App/Controllers/Matriculas/CriarController.php';
require_once 'App/Controllers/Matriculas/ListarController.php';
require_once 'App/Controllers/Matriculas/ExcluirController.php';

use Core\Routes;
use Core\Database;

use App\Controllers\IndexController;

use App\Controllers\AlunoController;
use App\Controllers\Alunos\CriarController as CriarAlunoController;
use App\Controllers\Alunos\EditarController as EditarAlunoController;
use App\Controllers\Alunos\ExcluirController as ExcluirAlunoController;

use App\Controllers\TurmaController;
use App\Controllers\Turmas\CriarController as CriarTurmaController;
use App\Controllers\Turmas\EditarController as EditarTurmaController;
use App\Controllers\Turmas\ExcluirController as ExcluirTurmaController;

use App\Controllers\MatriculaController;
use App\Controllers\Matriculas\CriarController as CriarMatriculaController;
use App\Controllers\Matriculas\ListarController as ListarMatriculaController;
use App\Controllers\Matriculas\ExcluirController as ExcluirMatriculaController;

\Core\Database::getInstance($config['database']);

(new Routes())
    ->get('/', IndexController::class)

    // Aluno
    ->get('/aluno', [AlunoController::class, 'index'])
    ->get('/aluno-pesquisar', [AlunoController::class, 'pesquisarAluno'])

    ->get('/aluno/criar', [CriarAlunoController::class, 'index'])
    ->post('/aluno/criar', [CriarAlunoController::class, 'add'])

    ->get('/aluno/editar', [EditarAlunoController::class, 'index'])
    ->post('/aluno/editar', [EditarAlunoController::class, 'edit'])

    ->get('/aluno/excluir', [ExcluirAlunoController::class, 'excluir'])

    //  Turma
    ->get('/turma', [TurmaController::class, 'index'])
    ->get('/turma-pesquisar', [TurmaController::class, 'pesquisarTurma'])

    ->get('/turma/criar', [CriarTurmaController::class, 'index'])
    ->post('/turma/criar', [CriarTurmaController::class, 'add'])

    ->get('/turma/editar', [EditarTurmaController::class, 'index'])
    ->post('/turma/editar', [EditarTurmaController::class, 'edit'])

    ->get('/turma/excluir', [ExcluirTurmaController::class, 'excluir'])

    // Matricula
    ->get('/matricula', [MatriculaController::class, 'index'])

    ->get('/matricula/criar', [CriarMatriculaController::class, 'index'])
    ->post('/matricula/criar', [CriarMatriculaController::class, 'add'])

    ->get('/matricula/listar', [ListarMatriculaController::class, 'index'])

    ->get('/matricula/excluir', [ExcluirMatriculaController::class, 'excluir'])

    ->run();  
