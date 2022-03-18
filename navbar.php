     <?php
     if(isset($_SESSION['id'])){
        $sql2 = "SELECT * FROM carrinho WHERE id_user = '$id'";
        $result2 = DBExecute($sql2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $produtos_carinhos = mysqli_num_rows($result2);
     }

        ?>

     <style>
.cart {
    position: fixed;
    top: 0;
    right: 0;
    width: 25%;
    text-align: center;
    padding: 20px;
    background: #fff;
    height: 100%;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    display: none;
}

.cart__img img {
    object-fit: cover;
}

#close {
    background: transparent;
    border: none;
}

.show {
    display: block;
}

.product__tile {
    font-size: 18px;
}

.card-body {
    padding: 10px;
}

#remove__cart {
    background: transparent;
    border: none;
}
     </style>
     <!-- Navigation-->
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="container-fluid px-4 px-lg-5">
             <div class="Logotipo">
                 <img src="assets/favicon.png">
             </div>
             <a class="navbar-brand" href="./">AutoRep</a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                 data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                 aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                     <li class="nav-item"><a class="nav-link active" aria-current="page" href="./">Home</a></li>
                     <li class="nav-item"><a class="nav-link active" aria-current="page" href="sobre.php">Sobre</a></li>
                     <li class="nav-item"><a class="nav-link active" aria-current="page" href="ticket.php">Ticket</a>
                     </li>
                     <li class="nav-item"><a class="nav-link active" aria-current="page" href="shop.php">Loja</a></li>
                 </ul>
                 <form class="d-flex m-0 d-flex  justify-content-center align-content-center align-items-center ">
                     <?php
                        if (isset($_SESSION['id'])) {
                        ?>
                     <a href="#" class="btn btn-outline-dark btn-sm" id="btncart">
                         <i class="bi-cart-fill me-1"></i>
                         Carrinho
                         <span class="badge bg-dark text-white ms-1 rounded-pill">
                             <?php
                                if(!empty($_produtos_carinhos)) {
                                    if (isset($_SESSION['id']) && isset($produtos_carinhos)) {
                                        echo $produtos_carinhos;
                                    } else {
                                        echo "0";
                                    }
                                }
                                    ?>
                         </span>
                     </a>
                     <?php
                        } else {
                        ?>
                     <a href="logar.php" class="btn btn-outline-dark btn-sm">
                         <i class="bi-cart-fill me-1"></i>
                         Carrinho
                         <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                     </a>
                     <?php
                        }
                        if (isset($admin) && $admin == 1) {
                            echo '<a href="painel.php" class="btn btn-primary btn-sm ms-3">
                            <i class="bi bi-cup"></i> Painel </a>';
                        }
                        if (isset($_SESSION['id'])) {
                            echo '<a href="logout.php" class="btn btn-danger ms-3 btn-sm">
                            <i class="bi bi-door-open"></i> Sair
                            </a>';
                        } else {
                            echo '<a href="registar.php" class="btn btn-success btn-sm ms-3">Registo</a>';
                            echo '<a href="logar.php" class="btn btn-primary btn-sm ms-3">Login</a>';
                        }
                        ?>
                 </form>
             </div>
         </div>
     </nav>