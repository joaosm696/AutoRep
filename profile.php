<?php
session_start();
include('funcao.php');
include('utilizador.php');
$id = $_SESSION['id'];
$utilizador = buscarUtilizador($id);
$admin = $utilizador['admin'];
$username = $utilizador['username'];
$nomecompleto = $utilizador['nomeapelido'];
$email = $utilizador['email'];
$nif = $utilizador['nif'];
$morada = $utilizador['morada'];
$codigopostal = $utilizador['codigopostal'];
$instagram = $utilizador['instagram'];
$pais = "Portugal";
$cidade = $utilizador['cidade'];
$cidades = ["Coimbra", "Porto", "Lisboa", "Braga"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>AutoRep - O seu perfil</title>
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
    </style>
</head>

<body>
    <header>
        <?php
        require "navbar.php";
        ?>
    </header>
    <!-- Header-->
    <div class="wpb_wrapper vc_column-inner">
        <h4 class="vc_custom_heading align-left heading-primary" id="title">AutoRep</h4>
        <div class="container">
            <div class="main-body">

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="main-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                    </ol>
                </nav>
                <!-- /Breadcrumb -->

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4>
                                            <div>
                                                <input type="text" class="form-control" id="firstName" value="<?= $username ?>" name="username" required disabled>
                                            </div>
                                        </h4>
                                        <button class="btn btn-danger"><a href="historicocompras.php?id=<?=$id?>">Historico de Compras</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                        </svg>Instagram:</h6>
                                    <span class="text-secondary"><?= $instagram ?></span>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <form method="post" action="perfilupdate.php">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nome Completo</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" id="input" value="<?= $nomecompleto ?>" name="nomecompleto" disabled required="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" id="input" value="<?= $email ?>" name="email" required disabled>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">NIF</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" id="input" value="<?= $nif ?>" name="nif" required disabled>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Codigo Postal</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" id="input" value="<?= $codigopostal ?>" disabled name="codigopostal" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Morada</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" id="input" value="<?= $morada ?>" name="morada" required disabled>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12 barra-botoes">
                                            <button class="btn btn-info" type="button" id="btn-editar" onclick="changeStatusButton(false)">Editar</button>
                                            <button class="btn btn-info" type="button" id="btn-cancelar" onclick="changeStatusButton(true)">Cancelar</button>
                                            <button class="btn btn-info" type="submit" id="btn-salvar" name="btnGuardar" >Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const btnEditar = document.getElementById("btn-editar");
        const btnCancelar = document.getElementById("btn-cancelar");
        btnCancelar.style.display = 'none'
        const btnSalvar = document.getElementById("btn-salvar");
        btnSalvar.style.display = 'none'

        function changeStatusButton(status) {
            const inputs = document.querySelectorAll("#input");
            inputs.forEach((input) => {
                input.disabled = status;
            })
            if (status) {
                btnCancelar.style.display = 'none'
                btnEditar.style.display = 'block'
                btnSalvar.style.display = 'none'
            } else {
                btnCancelar.style.display = 'block'
                btnEditar.style.display = 'none'
                btnSalvar.style.display = 'block'
            }
        }
    </script>
    <style>
        .barra-botoes {
            display: flex;
            justify-content: space-between;
        }
    </style>
    <!-- Footer -->
    <footer>
        <?php
        require "footer.php"
        ?>
    </footer>
    <!-- Footer -->
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>