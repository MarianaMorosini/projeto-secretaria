
<h2 class="text-lg font-semibold">Editar Aluno</h2>
<form action="/aluno/editar" method="POST" class="space-y-4">
    <input type="hidden" name="id" value="<?= $aluno['id'] ?>">

    <input type="text" name="nome" placeholder="Nome" minlength="3" maxlength="30" required class="w-full border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1" value="<?= $aluno['nome'] ?>">
    
    <input type="text" oninput="this.value = this.value.replace(/\D/g, '')" inputmode="numeric" name="cpf" placeholder="CPF" pattern="\d{11}" maxlength="11" required class="w-full border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1" value="<?= $aluno['cpf'] ?>" >
    
    <input type="date" name="data_nascimento" placeholder="Data de Nascimento" required class="w-full border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1" value="<?= $aluno['data_nascimento'] ?>">
    
    <button type="submit" class="border-stone-800 bg-stone-900 text-stone-400 px-4 py-1 rounded-md border-2 hover:bg-stone-800">Salvar</button>
</form>
