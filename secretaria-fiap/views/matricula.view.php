

<?php if (!empty($erros)): ?>
    <ul>
        <?php foreach ($erros as $erro): ?>
            <li class="bg-red-700 text-white px-4 py-2 rounded mt-4 mb-4"><?= htmlspecialchars($erro) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<h2 class="text-lg font-semibold">Turmas</h2>
<!-- Lista de turmas -->
<section class="grid gap-4 grid-cols-1 md:grid-cols-1 lg:grid-cols-2">
    <!-- turma -->
    <?php foreach ($turmas as $turma) : ?>
        <div class="p-2 rounded border-stone-800 border-2 bg-stone-900">
            <div class="flex">
                <div class="space-y-4">
                    <div class="font-semibold">Nome: <?= $turma['nome'] ?></div>
                    <div class="italic">Descrição: <?=$turma['descricao']?></div>
                    <div class="italic">Quantidade Alunos: <?=$turma['totalMatriculas']?> </div>
                    <div class="flex space-x-3">
                        <a href="/matricula/criar?id=<?= $turma['id'] ?>" class="border-stone-800 bg-stone-900 text-stone-400 px-4 py-1 rounded-md border-2 hover:bg-stone-800">
                            <input type="submit" value="Criar Matrícula">
                        </a>
                
                        <a href="/matricula/listar?id=<?= $turma['id'] ?>" class="border-stone-800 bg-stone-900 text-stone-400 px-4 py-1 rounded-md border-2 hover:bg-stone-800">
                            <input type="submit" value="Visualizar Matrículas">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>
