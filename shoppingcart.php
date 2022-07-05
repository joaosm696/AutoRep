<?php
session_start();
include('funcao.php');
if (!isset($_SESSION['id'])) header("location: login.php");
$id = $_SESSION['id'];
$sql = "SELECT * FROM utilizadores WHERE id = '$id'";
$result = DBExecute($sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$admin = $row['admin'];
$username = $row['username'];

?>
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>AutoRep - A tua loja de peças!</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!--- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
    <!--- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <style>
        .slider__home {
            height: 350px;
        }

        .carousel-item img {
            object-fit: cover;
        }

        .product_img {
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>

<body class="position-relative">
    <?php
    require "navbar.php";
    include("carrinho.php");
    $carrinhos = ListarTodoCarrinho($id);
    if (isset($_POST['itemCarrinhoId'])) {
        $quantidade = $_POST["quantidade"];
        $valor_produto = BuscarValorProduto($_POST['idProduto']);
        $valor_carrinho = BuscarValorCarrinho($_POST['itemCarrinhoId']);
        $qtd_item_carrinho = BuscarQtdItemCarrinho($_POST['itemCarrinhoId']);
        if ($quantidade > 0) {
            $valor = floatval($valor_produto['valor']) * intval($quantidade);
            atualizarQntItem($_POST['itemCarrinhoId'], $quantidade, $valor);
        } else {
            deleteItemCarrinho($_POST['itemCarrinhoId']);
        }
    }
    if (isset($_GET['excluir'])) {
        deleteItemCarrinho($_GET['excluir']);
    }

    $carrinhos = ListarTodoCarrinho($id);
    $totalprodutos = 0;
    if (!empty($carrinhos)) {
        while ($carrinho = mysqli_fetch_array($carrinhos, MYSQLI_ASSOC)) {
            $totalprodutos =  $totalprodutos + $carrinho['precoTotalItens'];
        }
        $carrinhos = ListarTodoCarrinho($id);
    }
    ?>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Nome do Produto</th>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                        <th>Imagem</th>
                        <th>Valor</th>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($carrinhos)) {
                            while ($carrinho = mysqli_fetch_array($carrinhos, MYSQLI_ASSOC)) {
                        ?>
                                <tr>
                                    <td><?= $carrinho['itemCarrinhoId']; ?></td>
                                    <td><?= $carrinho['nomeProduto']; ?></td>
                                    <td><?= $carrinho['descricao']; ?></td>
                                    <td>
                                        <form method="post" id="form<?= $carrinho['itemCarrinhoId']; ?>" name="form">
                                            <input type="hidden" name="itemCarrinhoId" value="<?= $carrinho['itemCarrinhoId']; ?>" />
                                            <input type="hidden" name="idProduto" value="<?= $carrinho['idProduto']; ?>" />
                                            <input style="width: 50px;" type="number" name="quantidade" value="<?= $carrinho['quantidade']; ?>" id="<?= $carrinho['itemCarrinhoId']; ?>" onchange="handleQuantidade(<?= $carrinho['itemCarrinhoId']; ?>,<?= $carrinho['quantidade']; ?>)" />
                                        </form>
                                    </td>
                                    <td><img width="100" src="<?= $carrinho['urlImage']; ?>" /></td>
                                    <td><?= $carrinho['precoTotalItens'] . " €"; ?></td>
                                    <td><a href="?excluir=<?= $carrinho['itemCarrinhoId']; ?>">Excluir</a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                if ($totalprodutos > 0) {
                ?>
                    <div class="col-md-3 col-md-push-1 text-center">
                        <div class="total">
                            <div class="grand-total">
                                <p><strong>Total:</strong><span><?php echo  " " .  $totalprodutos; ?> €</span></p>
                            </div>
                        </div>
                        <?php
                        if ($totalprodutos == 0) {
                            echo '<p><a class="btn btn-primary"   style="opacity: 0.5;
												 filter: alpha(opacity=50)"> Continuar compra </a disabled></p>';
                        } else {
                            echo '<p><a href="shop.php" class="btn btn-primary"> Voltar para a loja </a></p>';
                            echo '<p><a href="checkout.php" class="btn btn-primary"> Checkout </a></p>';
                        }


                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
    </section>
    <script>
        function handleQuantidade(id, valor) {
            if (valor == null || valor == "") return;
            document.getElementById(`form${id}`).submit();
        }
    </script>
    <!-- Footer-->
    <footer>
        <?php
        require "footer.php"
        ?>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>