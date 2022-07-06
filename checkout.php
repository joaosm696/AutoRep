<?php
session_start();
include('funcao.php');
include('carrinho.php');
include('utilizador.php');
$id = $_SESSION['id'];
$utilizador = buscarUtilizador($id);

$admin = $utilizador['admin'];
$username = $utilizador['username'];
$nomecompleto = $utilizador['nomeapelido'];
$email = $utilizador['email'];
$morada = $utilizador['morada'];
$codigopostal = $utilizador['codigopostal'];
$pais = "Portugal";
$cidade = $utilizador['cidade'];
$cidades = ["Coimbra", "Porto", "Lisboa", "Braga"];
if (isset($_POST['finishpay'])) {
    $sql = "INSERT INTO fatura(nomecompleto, email, morada, codigopostal, pais, cidade) VALUES ('$nomecompleto','$email','$morada','$codigopostal','$pais','$cidade')";
    $response = DBExecute($sql);
    $carrinhoAtivo = VerificarCarrinhoExisteAtivo($id);
    FinalizarCarrinho($carrinhoAtivo['id']);
}
$ItensDoCarrinho = ListarTodoCarrinho($id);
$totalprodutos = 0;
while ($item = mysqli_fetch_array($ItensDoCarrinho, MYSQLI_ASSOC)) {
    $totalprodutos =  $totalprodutos + $item['precoTotalItens'];
}
$ItensDoCarrinho = ListarTodoCarrinho($id);

?>
<!doctype html>
<html lang"PT">
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation')

            // Loop over them and prevent submission
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        }, false)
    }())
</script>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!--- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
    <!--- Google fonts-->





    <title> AutoRep - Finalizar a sua encomenda! </title>



    <!-- multistep form -->
    <link href="./login.css" rel="stylesheet">
    <link href="./login.js" rel="stylesheet">
    <?php
    require "navbar.php";
    ?>

<body class="text-center">

    <div class="container">
        <div class="py-5 text-center">
            <h2>AutoRep - A tua Loja de peças!</h2>
            <p class="lead">Apos finalizar a sua encomenda irá baixar um arquivo pdf com o seu recibo!</p>
        </div>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">O seu Carrinho</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3 sticky-top">

                    <?php
                    while ($item = mysqli_fetch_array($ItensDoCarrinho, MYSQLI_ASSOC)) {
                    ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <table class="table">
                                    <thead>
                                        <td><img width="50" src="<?= $item['urlImage']; ?>"/></td>
                                        <td>
                                            <h6 class="my-0"><?php echo $item['nomeProduto'] ?></h6>
                                        </td>
                                    </thead>
                                </table>
                            </div>
                            <span class="text-muted"><?php echo $item['precoTotalItens'] ?>€</span>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (EUROS)</span>
                        <strong><?php echo $totalprodutos ?>€</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Endereço de Envio</h4>
                <form class="needs-validation" name="pagamento" method="POST" action="">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="firstName">Nome Completo</label>
                            <input type="text" class="form-control" id="firstName" value="<?= $nomecompleto ?>" name="nomecompleto" required="">
                            <div class="invalid-feedback"> Tem que ser usado o nome completo! </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted"></span></label>
                        <input type="email" class="form-control" id="email" value="<?= $email ?>" name="email">
                        <div class="invalid-feedback"> Use um email valido! </div>
                    </div>
                    <div class="mb-3">
                        <label for="address">Morada</label>
                        <input type="text" class="form-control" id="address" value="<?= $morada ?>" required="" name="morada">
                        <div class="invalid-feedback"> Please enter your shipping address. </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="state">Cidade</label>
                            <select class="custom-select d-block w-100" id="state" required="" name="cidade">
                                <?php
                                
                                foreach ($cidades as $value) {
                                    
                                ?>
                                    <option value="<?= $value ?>"><?= $value ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback"> Please provide a valid state. </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Codigo Postal</label>
                            <input type="text" class="form-control" id="zip" value="<?= $codigopostal ?>" name="codigopostal">
                            <div class="invalid-feedback"> Zip code required. </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" name="finishpay" type="submit">Finalizar o
                        pagamento</button>
                    <p>
                    </p>
                </form>
            </div>
        </div>
        <footer>
            <?php
            require "footer.php"
            ?>
        </footer>
    </div>
</body>

</html>