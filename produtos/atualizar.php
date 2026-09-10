<?php
require __DIR__ . '/verifica_login.php';
require __DIR__ . '/../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $sql = "UPDATE produtos SET
            nome = '$nome',
            descricao = '$descricao',
            preco = '$preco',
            quantidade = '$quantidade'
            WHERE id = '$id'";

    mysqli_query($conexao, $sql);

    header('Location: listar.php');
    exit;
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id = '$id'";
    $resultado = mysqli_query($conexao, $sql);
    $produto = mysqli_fetch_assoc($resultado); /* Isso pega o resultado da consulta e transforma em algo que o PHP consegue acessar assim: $produto['id'] $produto['nome'] $produto['descricao'] $produto['preco'] $produto['quantidade'] */

/* 
    Quando você clica em EDITAR:
listar.php
     │
     │ clique em Editar
     ↓
atualizar.php?id=5
     │
     ↓
É POST?
     │
     └── caso NÃO
          ↓
        ELSE
          ↓
    pega id = 5
          ↓
    SELECT no banco
          ↓
    encontra produto 5
          ↓
    guarda em $produto
          ↓
    mostra formulário

Depois você clica em SALVAR:
Formulário
     │
     │ POST
     ↓
atualizar.php
     │
     ↓
É POST?
     │
     └── SIM
          ↓
        IF
          ↓
    pega os dados
          ↓
    UPDATE produtos
          ↓
    salva alterações
          ↓
    listar.php */
}
?>

<?php
$sql = "SELECT * FROM produtos WHERE id = '$id'";
$resultado = mysqli_query($conexao, $sql);
$produto = mysqli_fetch_assoc($resultado); // var_dump($produto); --> mysqli_fetch_assoc($resultado) pega a única linha que o SELECT encontrou (já que id é único) e transforma em um array associativo — por isso dá para acessar $produto['nome'], $produto['preco'], e assim por diante. ✅ Teste agora: para confirmar que os dados chegaram certos, adicione temporariamente var_dump($produto); logo depois do código acima, salve e acesse a página clicando em Editar em algum produto. Você deve ver um array preenchido. Depois de conferir, apague essa linha de var_dump — ela era só para teste.
?>
<?php require __DIR__ . '/../cabecalho.php'; ?>

<main>
    <h2>Atualizar Produto</h2>
    <form action="atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">  <!-- //"Guarde o ID desse produto no formulário, mas não mostre para o usuário. Quando ele clicar em salvar, envie esse ID junto para o atualizar.php, para sabermos qual produto deve ser alterado. -->

        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $produto['nome']; ?>"><br>

        <label>Descrição:</label>
        <input type="text" name="descricao" value="<?php echo $produto['descricao']; ?>"><br>

        <label>Preço:</label>
        <input type="text" name="preco" value="<?php echo $produto['preco']; ?>"><br>

        <label>Quantidade:</label>
        <input type="text" name="quantidade" value="<?php echo $produto['quantidade']; ?>"><br>

        <button type="submit">Salvar alterações</button>
    </form>
</main>

<?php require __DIR__ . '/../rodape.php'; ?>