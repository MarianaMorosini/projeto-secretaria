
<h2 class="text-lg font-semibold">Turma: <?= $turma['nome'] ?> </h2>
<!-- Lista de alunos -->
<section class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
    <!-- aluno -->
    <?php foreach ($alunos as $aluno) : ?>
        <div class="p-2 rounded border-stone-800 border-2 bg-stone-900">
            <div class="flex">
                <div class="space-y-4">
                    <div class="font-semibold">Nome: <?= $aluno['nome'] ?></div>
                    <div class="italic">CPF: <?=$aluno['cpf']?></div>
                    <div class="italic">Data de nascimento: <?=$aluno['data_nascimento']?></div>
                    <div class="flex space-x-3">                        
                        <a href="/matricula/excluir?id=<?= $aluno['id'] ?>" class="border-stone-800 bg-stone-900 text-stone-400 px-4 py-1 rounded-md border-2 hover:bg-stone-800">
                            <input type="submit" value="Excluir Matricula">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<section class="mt-6">
    <a href="/matricula/criar?id=<?= $turma['id'] ?>" class="border-stone-800 bg-stone-900 text-stone-400 px-4 py-1 rounded-md border-2 hover:bg-stone-800">
        <input type="submit" value="Criar Matrícula">
    </a>
</section>