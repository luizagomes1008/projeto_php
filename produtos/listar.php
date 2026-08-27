<?php
require __DIR__ . '/verifica_login.php';
require __DIR__ . '/../cabecalho.php';
?>

<main>
    <p>Bem-vindo(a), <?php echo $_SESSION['usuario_nome']; ?>!</p>
    <!-- conteúdo da página -->
</main>

<?php
require __DIR__ . '/../rodape.php';
?>