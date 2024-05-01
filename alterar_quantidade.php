<?php
// Iniciar ou retomar a sessão
session_start();

// Verificar se o método de requisição é POST e se o ID do produto está definido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['produto_id'])) {
    $produto_id = $_POST['produto_id'];
    
    // Verificar se o carrinho e as quantidades estão definidos
    if (isset($_SESSION['carrinho']) && isset($_SESSION['quantidades'])) {
        // Verificar se o produto está no carrinho
        if (in_array($produto_id, $_SESSION['carrinho'])) {
            
            // Aumentar, diminuir ou remover a quantidade com base no botão clicado
            if (isset($_POST['aumentar_quantidade'])) {
                $_SESSION['quantidades'][$produto_id]++;
                
            } elseif (isset($_POST['diminuir_quantidade'])) {
                // Verificar se a quantidade é maior que 1 antes de diminuir
                if ($_SESSION['quantidades'][$produto_id] > 1) {
                    $_SESSION['quantidades'][$produto_id]--;
                    
                }
            } elseif (isset($_POST['remover_produto'])) {
                // Encontrar o índice do produto no carrinho
                $index = array_search($produto_id, $_SESSION['carrinho']);
                // Remover o produto do carrinho e a quantidade correspondente
                if ($index !== false) {
                    unset($_SESSION['carrinho'][$index]);
                    unset($_SESSION['quantidades'][$produto_id]);
                    
                }
            }
        }
    }

    // Redirecionar de volta para o carrinho
    header("Location: carrinho.php");
    exit();
} else {
    // Redirecionar para a loja se o ID do produto não estiver definido
    header("Location: loja.php");
    exit();
}
?>
