
<form class="w-full flex space-x-2 mt-6" action="aluno-pesquisar">
    <input
        type="text"
        class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1"
        placeholder="Pesquisar..."
        name="pesquisar-aluno"
         />
    <button type="submit">🔎</button>
</form>
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
                        <a href="/aluno/editar?id=<?= $aluno['id'] ?>" class="border-stone-800 bg-stone-900 text-stone-400 px-4 py-1 rounded-md border-2 hover:bg-stone-800">
                            <input type="submit" value="Editar">
                        </a>

                        <a href="/aluno/excluir?id=<?= $aluno['id'] ?>" class="border-stone-800 bg-stone-900 text-stone-400 px-4 py-1 rounded-md border-2 hover:bg-stone-800">
                            <input type="submit" value="Excluir">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<section class="mt-6">
    <a href="/aluno/criar" class="border-stone-800 bg-stone-900 text-stone-400 px-4 py-1 rounded-md border-2 hover:bg-stone-800 inline-block text-center">
        Adicionar Aluno
    </a>
</section>