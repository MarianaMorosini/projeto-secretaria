

<h2 class="text-lg font-semibold">Matricular na turma: <?= $turma['nome'] ?></h2>
<form action="/matricula/criar" method="POST" class="space-y-4">
    <input type="hidden" name="turma_id" id="turma_id" value="<?= $turma['id'] ?>">

    <label for="aluno_id" class="block">Selecione o aluno:</label>
    <select name="aluno_id" id="aluno_id" required class="w-full border-stone-800 border-2 rounded-md bg-stone-900 text-sm px-2 py-1">
        <option value="">Selecione...</option>
        <?php foreach ($alunos as $aluno): ?>
            <option value="<?= $aluno['id'] ?>">
                <?= htmlspecialchars($aluno['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    
    <button type="submit" class="border-stone-800 bg-stone-900 text-stone-400 px-4 py-1 rounded-md border-2 hover:bg-stone-800">Salvar</button>
</form>
