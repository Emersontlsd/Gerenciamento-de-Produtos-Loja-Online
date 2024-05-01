
<?php
session_start();
// Incluir arquivo de configuração do banco de dados
require_once('config.php');

// Consulta SQL para selecionar todos os produtos
$sql = "SELECT * FROM produtos";
$resultado = mysqli_query($conn, $sql);

// Iniciar ou retomar a sessão

// Verificar se há produtos no carrinho
if(isset($_SESSION['carrinho'])) {
    $quantidade_carrinho = count($_SESSION['carrinho']);
} else {
    $quantidade_carrinho = 0;
}

// Adicionar produto ao carrinho
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adicionar_carrinho'])) {
    if (isset($_SESSION['carrinho'])) {
        // Adicionar o ID do produto ao carrinho
        $_SESSION['carrinho'][] = $_POST['produto_id'];
    } else {
        // Se o carrinho ainda não existir, criá-lo e adicionar o produto
        $_SESSION['carrinho'] = array($_POST['produto_id']);
    }
    // Redirecionar de volta para a loja após adicionar ao carrinho
    header("Location: loja.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Loja</title>
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



<div class="container">

    <div class="d-flex justify-content-center">
        <h1>LOJA</h1>
    </div>
    
    <?php while ($produto = mysqli_fetch_assoc($resultado)): ?>
        <div >
            <h2><?php echo $produto['nome']; ?></h2>
            <p>Preço: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
            <?php if ($produto['tipo'] == 'fisico'): ?>
                <p>Peso: <?php echo $produto['peso']; ?> kg</p>
            <?php elseif ($produto['tipo'] == 'digital'): ?>
                <p>Tamanho: <?php echo $produto['tamanho']; ?> MB</p>
                <p>Tipo: <?php echo $produto['tipo']; ?></p>
                <p>Quantidade: <?php echo $produto['quantidade_disponivel']; ?>und</p>
            <?php endif; ?>
            <form method="post" action="loja.php">
                <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                <button type="submit" name="adicionar_carrinho">Adicionar ao Carrinho</button>
                
            </form>
            
            <br>
        </div>
        
    <?php endwhile; ?>
    

    <a href="carrinho.php">carrinho</a>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>
