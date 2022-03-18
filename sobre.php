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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>AutoRep - Sobré nós!</title>
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
        <div
            class="wpb_text_column wpb_content_element wpb_animate_when_almost_visible wpb_lightSpeedIn lightSpeedIn wpb_start_animation animated">
            <div class="wpb_wrapper">
                <div class="sobre">
                    <img src="imagens/autorepsobre.jpg" class="img-fluid" alt="Sobre">
                </div>
                < <div class=" imagemap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1076.60920642507!2d-8.321156959046396!3d40.251071449505304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22fb59c99f4085%3A0x1c1ea1b45305f63c!2sS%C3%A3o%20Mamede%2C%20Penacova!5e0!3m2!1spt-PT!2spt!4v1646669737378!5m2!1spt-PT!2spt"
                        width="300" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div>A AutoRep têm como missão proporcionar um serviço de excelência e personalizado aos nossos
                clientes
                através da nossa loja online.</div>
            <div></div>
            <div>Contamos com uma algumas peças para motociclos e automoveis disponiveis para venda</div>
            <div>-Temos qualidades como atendimento rapido, sistema de ticket para o cliente,</div>
            <div>-Peças originais Yamaha, Honda, Suzuki, Kawasaki, entre outras.<br>
                -Venda de artigos para motociclos<br>
                -Faturamento em PDF<br>
                -Serviços de estufador, bancos novos e personalização.<br>
            </div>
            </p>
            <div class="_2cuy _3dgx _2vxa"></div>
        </div>
    </div>
    <div class="porto-separator  ">
        <hr class="separator-line  align_center solid" style="background-color:#dbdbdb;">
    </div>
    </div>
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