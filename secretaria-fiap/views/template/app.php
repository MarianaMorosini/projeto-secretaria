<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretaria Fiap</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-950 text-stone-200">
    <header class="bg-stone-900">
        <nav class="mx-auto max-w-screen-lg flex justify-between py-4">
            <div class="font-bold text-xl tracking-wide">Secretaria Fiap</div>
            <ul class="flex space-x-4 font-bold">
                <li><a href="/aluno" class="hover:underline">Alunos</a></li>
                <li><a href="/turma" class="hover:underline">Turmas</a></li>
                <li><a href="/matricula" class="hover:underline">Matrículas</a></li>
            </ul>
        </nav>
    </header>
    
    <main class="mx-auto max-w-screen-lg space-y-6">
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
        
        <?php require "views/{$view}.view.php"; ?>
    </main>

    <footer></footer>
    
</body>
</html>