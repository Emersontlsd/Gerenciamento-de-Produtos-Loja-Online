
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Carrinho</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">LOJA ON-LINE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Início  | </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="loja.php"> Loja  | </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="carrinho.php"> Carrinho  | </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="listar-produtos.php">Produtos Cadastrados  |</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true"></a>
                    </li>
                </ul>
            </div>
        </div>
</nav>


    
    <!-- Exibir itens adicionados ao carrinho -->
    <!-- Formulário para finalizar pedido -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>

<?php
// Iniciar ou retomar a sessão
session_start();

// Verificar se o carrinho está vazio
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "<p>O carrinho está vazio.</p>";
} else {
    // Incluir arquivo de configuração do banco de dados
    require_once('config.php');

 // Recuperar os produtos do carrinho
    $produtos_carrinho = $_SESSION['carrinho'];

    // Consulta SQL para selecionar os detalhes de cada produto no carrinho
    $sql = "SELECT * FROM produtos WHERE id IN (" . implode(",", $produtos_carrinho) . ")";
    $resultado = mysqli_query($conn, $sql);

// Exibir produtos no carrinho
    while ($produto = mysqli_fetch_assoc($resultado)) {
        $id_produto = $produto['id'];
        // Verificar se a quantidade está definida no carrinho
        $quantidade = isset($_SESSION['quantidades'][$id_produto]) ? $_SESSION['quantidades'][$id_produto] : 1;
    ?>
        <div class="container">
            <div class="">
                <h2><?php echo $produto['nome']; ?></h2>
                <p>Preço unitário: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                <p>Quantidade: <?php echo $quantidade; ?></p>
                <form method="post" action="alterar_quantidade.php">
                    <input type="hidden" name="produto_id" value="<?php echo $id_produto; ?>">
                    <button type="submit" name="aumentar_quantidade">Aumentar Quantidade</button>
                    <button type="submit" name="diminuir_quantidade">Diminuir Quantidade</button>
                    <button type="submit" name="remover_produto">Remover Produto</button>
                    <br><br>
                </form>
            </div>
        </div>   
    <?php
    }

    // Botão para finalizar pedido
?>
    <form method="post" action="finalizar_pedido.php">
        <button type="submit" name="finalizar_pedido">Finalizar Pedido</button>
    </form>
<?php
}
?>





