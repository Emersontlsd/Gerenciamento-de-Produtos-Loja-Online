<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['finalizar_pedido'])) {
    // Incluir arquivo de configuração do banco de dados
    require_once('config.php');

    // Verificar se o carrinho e as quantidades estão definidos
    if (isset($_SESSION['carrinho']) && isset($_SESSION['quantidades'])) {
        // Iterar sobre os produtos no carrinho
        foreach ($_SESSION['carrinho'] as $produto_id) {
            // Obter a quantidade comprada deste produto
            $quantidade_comprada = $_SESSION['quantidades'][$produto_id];

            // Atualizar a quantidade disponível no banco de dados
            $sql_update = "UPDATE produtos SET quantidade_disponivel = quantidade_disponivel - $quantidade_comprada WHERE id = $produto_id";
            $resultado_update = mysqli_query($conn, $sql_update);

            // Verificar se a atualização foi bem-sucedida
            if (!$resultado_update) {
                // Se ocorrer um erro, você pode lidar com isso de acordo com suas necessidades,
                // como registrar o erro em um arquivo de log ou exibir uma mensagem de erro ao usuário.
                echo "Erro ao atualizar a quantidade do produto com ID $produto_id.";
            }
        }

        // Limpar o carrinho de compras (removendo os itens da sessão)
        unset($_SESSION['carrinho']);
        unset($_SESSION['quantidades']);

        // Exibir mensagem de sucesso ao usuário
        echo "<p>Pedido finalizado com sucesso!</p>";
    } else {
        // Exibir uma mensagem de erro caso o carrinho esteja vazio
        echo "<p>O carrinho está vazio. Não é possível finalizar o pedido.</p>";
    }
}
?>