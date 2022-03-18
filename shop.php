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

    .product_img {
        height: 150px;
        object-fit: cover;
    }
    </style>
</head>

<body class="position-relative">
    <?php
    require "navbar.php";
    ?>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $sql = "SELECT * FROM produtos ORDER BY id DESC LIMIT 8";
                $result = DBExecute($sql);
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <?php
                            if($row['promocional'] != 0){
                            ?>
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Saldo
                        </div>
                        <?php
                            }
                            ?>
                        <!-- Product image-->
                        <img class="card-img-top product_img" src="<?= $row['imagem'] ?>" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?= $row['nome'] ?></h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                <?php
                                    if ($row['promocional'] != null) {                                    ?>
                                <span class="text-muted text-decoration-line-through"><?= $row['promocional'] ?> €
                                </span>
                                <?= $row['valor'] ?>€
                                <?php
                                    } else {
                                    ?>
                                <?= $row['valor'] ?>€
                                <?php
                                    }
                                    ?>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <?php
                                    if (isset($_SESSION['id'])) {

                                    ?>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="id_user" value="<?= $id ?>">
                                    <button type="submit" class="btn btn-outline-dark mt-auto" name="add"
                                        href="#">Adicionar ao Carrinho</button>
                                </form>
                                <?php
                                    } else {
                                    ?>
                                <a class="btn btn-outline-dark mt-auto" href="logar.php">Adicionar ao Carrinho</a>
                                <?php
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <?php

                if (isset($_POST['add'])) {
                    $uid = uniqid();
                    $id_produto = $_POST['id'];
                    $id_user = $_POST['id_user'];
                    $sql = "INSERT INTO carrinho (id,id_user) VALUES ('$uid','$id_user')";
                    echo DBExecute($sql);die;
                    echo "<script>alert('Produto adicionado ao carrinho!');</script>";
                    echo "<script>window.location.href = 'shop.php';</script>";
                }
                ?>
            </div>
        </div>
    </section>
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