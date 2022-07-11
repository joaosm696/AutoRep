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
                <hr>
                <!-- button modal -->
<h1 class="text-center">Utilizadores</h1>
                <!-- modal bootstrap -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Adicionar Utilizadores</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <!-- FORM PRODUTO -->
                                    <div class="form-group mb-2">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" name="nomeapelido">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="exampleInputEmail1">Nome</label>
                                        <input required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nome do Utilizador" name="username">
                                    </div>
                                    <!-- valor -->
                                    <div class="form-group mb-2">
                                        <label for="exampleInputEmail1">Admin</label>
                                        <input required type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="admin">
                                    </div>
                                    <!-- input submit -->
                                    <button type="submit" class="btn btn-success w-100" name="adicionar">Adicionar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
                if (isset($_POST['adicionar'])) {
                    // variaveis
                    $nome = $_POST['nomeapelido'];
                    $username = $_POST['username'];
                    $admin = $_POST['admin'];
                }

                if (isset($_POST['delete'])) {
                    $id = $_POST['id'];

                    $sql = "DELETE FROM utilizadores WHERE id = '$id'";
                    $query = DBExecute($sql);
                    if ($query) {
                        echo "<script>alert('Utilizador deletado com sucesso!');</script>";
                        echo "<script>window.location.href = 'adminutilizadores.php';</script>";
                    } else {
                        echo "<script>alert('Erro ao deletar Utilizador!');</script>";
                    }
                }

                ?>
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>USERNAME</th>
                            <th>ADMIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $sql = "SELECT * FROM utilizadores";
                            $result = DBExecute($sql);
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo <<<LIST
                                <tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nomeapelido']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['admin']}</td>
                                <td>
                                 <button type='button' class='btn btn-primary' data-bs-target='#item-{$row['id']}' data-bs-toggle='modal'>Alterar</button>
                                </td>
                                <td>
                                <form method='post' action='adminutilizadores.php'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit' name='delete' class='btn btn-danger'>Apagar</button>
                                </form>
                                </td>

                                <div class="modal fade" id="item-{$row['id']}" data-bs-backdrop="static" aria-labelledby="item-{$row['id']}" aria-hidden="false">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{$row['id']}">Alterar Informações</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="updateAdmin.php" method="post" enctype="multipart/form-data">
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                    <!-- FORM PRODUTO -->
                                                    <div class="form-group mb-2">
                                                        <label for="exampleInputEmail1">Nome Completo</label>
                                                        <input  type="text" value="{$row['nomeapelido']}" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" placeholder="Nome Completo" name="nomeapelido">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="exampleInputEmail1">Username</label>
                                                        <input  type="text" value="{$row['username']}" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" placeholder="Username"
                                                            name="username">
                                                    </div>
                                                    <!-- valor -->
                                                    <div class="form-group mb-2">
                                                        <label for="exampleInputEmail1">admin</label>
                                                        <input 
                                                             type="text" 
                                                             value="{$row['admin']}" 
                                                             class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" placeholder="Admin? Se sim 1 se não 0" name="admin">
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