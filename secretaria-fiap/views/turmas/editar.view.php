<?php if (!empty($erros)): ?>
    <ul>
        <?php foreach ($erros as $erro): ?>
            <li class="bg-red-700 text-white px-4 py-2 rounded mt-4 mb-4"><?= htmlspecialchars($erro) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php if (!empty($_SESSION['success'])): ?>
    <div class="bg-green-700 text-white px-4 py-2 rounded mt-4 mb-4">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['erros'])): ?>
    <ul>
        <?php foreach ($_SESSION['erros'] as $erro): ?>
            <li class="bg-red-700 text-white px-4 py-2 rounded mt-4 mb-4"><?= htmlspecialchars($erro) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php unset($_SESSION['erros']); ?>
<?php endif; ?>

<h2 class="text-lg font-semibold">Editar Turma</h2>
<form action="/turma/editar" method="POST" class="space-y-4">
    <input type="hidden" name="id" value="<?= $turma['id'] ?>">

    <input type="text" name="nome" placeholder="Nome" minlength="3" maxlength="30" required class="w-full border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1" value="<?= $turma['nome'] ?>">
    
    <input type="text" name="descricao" placeholder="Descrição" maxlength="30" required class="w-full border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1" value="<?= $turma['descricao'] ?>">
    
    <button type="submit" class="border-stone-800 bg-stone-900 text-stone-400 px-4 py-1 rounded-md border-2 hover:bg-stone-800">Salvar</button>
</form>
