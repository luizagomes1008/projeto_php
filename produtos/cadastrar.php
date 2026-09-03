<?php
require __DIR__ . '/verifica_login.php';
require __DIR__ . '/../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //pega a tabela do banco d dados para cadastrar novo produto
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    if ($nome == "" || $preco == "" || $quantidade == "") { //Nome está vazio OU preço está vazio OU quantidade está vazia? Se qualquer um estiver vazio, entra no if.
        $mensagem = "Preencha todos os campos obrigatórios.";
    } else {
        $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade)
                VALUES ('$nome', '$descricao', '$preco', '$quantidade')";

        if (mysqli_query($conexao, $sql)) { //"verifica conexão do sql, caso de certo, entra no if, else, erro de conexão "
            header('Location: listar.php'); //caso conexao fucione e os produtos sejam cadastrados, redireciona para a pagina onde esta a tabela (listar.php) com dados já atualizados
            exit;//"Redirecione o usuário e pare de executar este arquivo."
        } else {
            $mensagem = "Erro ao cadastrar produto: " . mysqli_error($conexao);
        }
    }
}
?>

<?php require __DIR__ . '/../cabecalho.php'; ?>

<main>
    <h2>Cadastrar Produto</h2>

    <?php if (isset($mensagem)) { ?> <!--  isset() Verifica se uma variável existe e não é null. caso a variavel mensgame exista, ele printa -->
        <p><?php echo $mensagem; ?></p>
    <?php } ?>

    <form action="cadastrar.php" method="POST"> <!-- Quando o usuário enviar esse formulário, mande os dados para cadastrar.php usando POST. -->
        <label>Nome:</label>
        <input type="text" name="nome"><br>

        <label>Descrição:</label>
        <input type="text" name="descricao"><br>

        <label>Preço:</label>
        <input type="text" name="preco"><br>

        <label>Quantidade:</label>
        <input type="text" name="quantidade"><br>

        <button type="submit">Salvar</button>
    </form>
</main>

<?php require __DIR__ . '/../rodape.php'; ?>

<!-- 1. Formulário HTML
        ↓
2. method="POST"
        ↓
3. $_POST recebe os dados
        ↓
4. PHP cria o SQL
        ↓
5. mysqli_query($conexao, $sql)
        ↓
6. MySQL executa o INSERT
        ↓
7. Se funcionar → listar.php
        ↓
8. Se der erro → mysqli_error() -->