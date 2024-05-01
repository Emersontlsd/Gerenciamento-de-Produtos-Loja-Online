<?php
// index.php

// Incluir arquivo de configuração do banco de dados


// Verificar se o formulário de cadastro foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar_produto'])) {

    require_once('config.php');

    // Receber dados do formulário
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $tipo = $_POST['tipo'];
    $peso = isset($_POST['peso']) ? $_POST['peso'] : null;
    $tamanho = isset($_POST['tamanho']) ? $_POST['tamanho'] : null;
    $quantidade_disponivel = $_POST['quantidade'];

    // Remover caracteres não numéricos e substituir vírgulas por pontos
    $preco = str_replace(',', '.', preg_replace('/[^\d,]/', '', $preco));
    $peso = str_replace(',', '.', preg_replace('/[^\d,]/', '', $peso));
    // Formatar o preço com duas casas decimais e ponto como separador de milhar
    


    // executa o insert no banco de dados
    $result = mysqli_query($conn, "INSERT INTO produtos(nome, preco, tipo, peso, tamanho, quantidade_disponivel) 
    VALUES ('$nome', '$preco', '$tipo', '$peso', '$tamanho', '$quantidade_disponivel')");
    

    // verificando se o cadastro foi efetuado
    if($result){
        // sim, emite a mensagem de sucesso
        echo "<script>alert('Dados cadastrados com sucesso!'); </script>";
    }else {
        // não, emite a mensagem de erro
        echo " <script>alert ('Erro ao cadastrar os dados. " . mysqli_error($conn) . " '); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cadastrar Produto</title>
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
        <h1>Cadastrar Produto</h1>
        </div>
            <form method="post" action="?index.php">

                <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do produto" required>
                <br>
                <label for="preco" class="form-label">Preço</label>
                <input type="text" class="form-control" name="preco" id="preco" placeholder="Valor do produto(Ex: 659,99)" required>
                <br>
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo">
                    <option value="fisico">Físico</option>
                    <option value="digital">Digital</option>
                </select>
                <br><br>
                <label for="peso" class="form-label">Peso MG(Produto Físico)</label>
                <input type="number" class="form-control" name="peso" id="peso" placeholder="Peso do produto MG(físico)" required>
                <br>
                <label for="tamanho" class="form-label">Tamanho MB(Produto Digital)</label>
                <input type="number" class="form-control" name="tamanho" id="tamanho" placeholder="Tamanho do produto MB(digital)" required>
                <br>
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="number" class="form-control" name="quantidade" id="quantidade" placeholder="Quantidade" required>
                <br><br>
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success" name="cadastrar_produto">Cadastrar Produto</button>
                </div>
                </div>

            </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>