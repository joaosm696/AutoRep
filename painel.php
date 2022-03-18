<?php
session_start();
include('funcao.php');
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM utilizadores WHERE id = '$id'";
    $result = DBExecute($sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $admin = $row['admin'];
    $username = $row['username'];
    if ($admin == 0) {
        header("location: ./");
        exit;
    }
}
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

    .img_product {
        object-fit: cover;
    }

    td {
        text-align: center;
        vertical-align: baseline;
    }

    th {
        text-align: center;
        vertical-align: middle;
    }
    </style>
</head>

<body>

    <?php
    require "navbar.php";
    ?>
    <!-- Section-->
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Produtos</h1>
                <hr>
                <!-- button modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Adicionar Produto
                </button>
                <!-- modal bootstrap -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <!-- FORM PRODUTO -->
                                    <div class="form-group mb-2">
                                        <label for="exampleInputEmail1">Nome</label>
                                        <input required type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Nome do Produto" name="nome">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="exampleInputEmail1">Descrição</label>
                                        <input required type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Descrição do Produto"
                                            name="descricao">
                                    </div>
                                    <!-- valor -->
                                    <div class="form-group mb-2">
                                        <label for="exampleInputEmail1">Preço</label>
                                        <input required type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Preço do Produto" name="valor">
                                    </div>
                                    <!-- valor promocional -->
                                    <div class="form-group mb-2">
                                        <label for="exampleInputEmail1">Preço Promocional (Opcional)</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Preço Promocional do Produto"
                                            name="promocional">
                                    </div>
                                    <!-- imagem -->
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Imagem do produto</label>
                                        <input required class="form-control" type="file" id="imagem" name="imagem">
                                    </div>
                                    <!-- input submit -->
                                    <button type="submit" class="btn btn-success w-100"
                                        name="adicionar">Adicionar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
                if (isset($_POST['adicionar'])) {
                    // variaveis
                    $nome = $_POST['nome'];
                    $descricao = $_POST['descricao'];
                    $valor = $_POST['valor'];
                    $promocional = $_POST['promocional'];
                    $imagem = $_FILES['imagem'];
                    $imagem_nome = $imagem['name'];
                    $imagem_tmp = $imagem['tmp_name'];
                    $imagem_tipo = $imagem['type'];
                    $imagem_tamanho = $imagem['size'];
                    $imagem_erro = $imagem['error'];
                    $imagem_extensao = explode('.', $imagem_nome);
                    $imagem_extensao = strtolower(end($imagem_extensao));
                    $imagem_novo_nome = uniqid() . '.' . $imagem_extensao;
                    $imagem_destino = 'upload/' . $imagem_novo_nome;

                    // verificação de erros
                    if ($imagem_erro == 0) {
                        if ($imagem_extensao == 'jpg' || $imagem_extensao == 'jpeg' || $imagem_extensao == 'png') {
                            if ($imagem_tamanho <= 1000000) {
                                if (move_uploaded_file($imagem_tmp, $imagem_destino)) {
                                    $sql = "INSERT INTO produtos (nome, descricao, valor, promocional, imagem) VALUES ('$nome', '$descricao', '$valor', '$promocional', '$imagem_destino')";
                                    $query = DBExecute($sql);

                                    if ($query) {
                                        echo "<script>alert('Produto adicionado com sucesso!');</script>";
                                        echo "<script>window.location.href = 'painel.php';</script>";
                                    } else {
                                        echo "<script>alert('Erro ao adicionar produto!');</script>";
                                    }
                                } else {
                                    echo "<script>alert('Erro ao enviar imagem!');</script>";
                                }
                            } else {
                                echo "<script>alert('Imagem muito grande!');</script>";
                            }
                        } else {
                            echo "<script>alert('Extensão inválida!');</script>";
                        }
                    } else {
                        echo "<script>alert('Erro ao enviar imagem!');</script>";
                    }
                }
                if (isset($_POST['delete'])) {
                    $id = $_POST['id'];

                    $sql = "DELETE FROM produtos WHERE id = '$id'";
                    $query = DBExecute($sql);
                    if ($query) {
                        echo "<script>alert('Produto deletado com sucesso!');</script>";
                        echo "<script>window.location.href = 'painel.php';</script>";
                    } else {
                        echo "<script>alert('Erro ao deletar produto!');</script>";
                    }
                }

                ?>
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>DESCRIÇÃO</th>
                            <th>VALOR</th>
                            <th>PROMOCIONAL</th>
                            <th>IMAGEM</th>
                            <th>ALTERAR</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $sql = "SELECT * FROM produtos";
                            $result = DBExecute($sql);
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo <<<LIST
                                <tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nome']}</td>
                                <td>{$row['descricao']}</td>
                                <td>{$row['valor']}</td>
                                <td>{$row['promocional']}</td>
                                <td><img src='{$row['imagem']}' class='img_product' width='100' height='100'></td>
                                <td>
                                 <button type='button' class='btn btn-primary' data-bs-target='#item-{$row['id']}' data-bs-toggle='modal'>Alterar</button>
                                </td>
                                <td>
                                <form method='post' action='painel.php'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit' name='delete' class='btn btn-danger'>Apagar</button>
                                </form>
                                </td>

                                <div class="modal fade" id="item-{$row['id']}" data-bs-backdrop="static" aria-labelledby="item-{$row['id']}" aria-hidden="false">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{$row['id']}">Alterar Produto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="updateProduct.php" method="post" enctype="multipart/form-data">
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                    <!-- FORM PRODUTO -->
                                                    <div class="form-group mb-2">
                                                        <label for="exampleInputEmail1">Nome</label>
                                                        <input required type="text" value="{$row['nome']}" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" placeholder="Nome do Produto" name="nome">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="exampleInputEmail1">Descrição</label>
                                                        <input required type="text" value="{$row['descricao']}" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" placeholder="Descrição do Produto"
                                                            name="descricao">
                                                    </div>
                                                    <!-- valor -->
                                                    <div class="form-group mb-2">
                                                        <label for="exampleInputEmail1">Preço</label>
                                                        <input required
                                                             type="text" 
                                                             value="{$row['valor']}" 
                                                             class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" placeholder="Preço do Produto" name="valor">
                                                    </div>
                                                    <!-- valor promocional -->
                                                    <div class="form-group mb-2">
                                                        <label for="exampleInputEmail1">Preço Promocional (Opcional)</label>
                                                        <input type="number" valor="{$row['promocional']}" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" placeholder="Preço Promocional do Produto"
                                                            name="promocional">
                                                    </div>
                                                    <!-- imagem -->
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Imagem do produto</label>
                                                        <input class="form-control" type="file" id="imagem" name="imagem">
                                                    </div>
                                                    <!-- input submit -->
                                                    <button
                                                        type="submit" 
                                                        class="btn btn-success w-100"
                                                        name="alterar">Alterar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        LIST;
                            }


                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>