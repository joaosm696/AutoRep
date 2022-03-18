<?php
session_start();
include('funcao.php');
include('mail_fatura.php');
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM utilizadores WHERE id = '$id'";
    $result = DBExecute($sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $admin = $row['admin'];
    $username = $row['username'];
    
}
if (isset($_POST['finishpay'])){
    $nomecompleto=$_POST['nomecompleto'];
    $email=$_POST['email'];
    $morada=$_POST['morada'];
    $codigopostal=$_POST['codigopostal'];
    $pais=$_POST['pais'];
    $cidade=$_POST['cidade'];
    $sql="INSERT INTO fatura(nomecompleto, email, morada, codigopostal, pais, cidade) VALUES ('$nomecompleto','$email','$morada','$codigopostal','$pais','$cidade')";
    $response = DBExecute($sql);
    sendEmail($nomecompleto,$email,$morada,$codigopostal,$pais,$cidade);
    echo $response;die;
}

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

                    <?php foreach($_SESSION['produtos_carrinho'] as $elemento) : ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?php echo $elemento['nome'] ?></h6>
                            <small class="text-muted"><?php echo $elemento['descricao'] ?></small>
                        </div>
                        <span class="text-muted"><?php echo $elemento['valor'] ?>€</span>
                    </li>
                    <?php endforeach;?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (EUROS)</span>
                        <strong><?php echo $_SESSION['valortotal'] ?>€</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Endereço de Envio</h4>
                <form class="needs-validation" name="pagamento" method="POST" action="">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="firstName">Nome Completo</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Insira o seu nome"
                                name="nomecompleto" required="">
                            <div class="invalid-feedback"> Tem que ser usado o nome completo! </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted"></span></label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com" name="email">
                        <div class="invalid-feedback"> Use um email valido! </div>
                    </div>
                    <div class="mb-3">
                        <label for="address">Morada</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required=""
                            name="morada">
                        <div class="invalid-feedback"> Please enter your shipping address. </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Pais</label>
                            <select class="custom-select d-block w-100" id="country" required="" name="pais">
                                <option value="">Escolha...</option>
                                <option>Portugal</option>
                            </select>
                            <div class="invalid-feedback"> Please select a valid country. </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">Cidade</label>
                            <select class="custom-select d-block w-100" id="state" required="" name="cidade">
                                <option value="">Escolha...</option>
                                <option>Coimbra</option>
                                <option>Porto</option>
                                <option>Lisboa</option>
                                <option>Braga</option>
                            </select>
                            <div class="invalid-feedback"> Please provide a valid state. </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Codigo Postal</label>
                            <input type="text" class="form-control" id="zip" placeholder="" required=""
                                name="codigopostal">
                            <div class="invalid-feedback"> Zip code required. </div>
                        </div>
                    </div>
                    <!--
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <label class="custom-control-label" for="same-address">Shipping address is the same as my
                            billing address</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info">
                        <label class="custom-control-label" for="save-info">Save this information for next time</label>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Payment</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked=""
                                required="">
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input"
                                required="">
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input"
                                required="">
                            <label class="custom-control-label" for="paypal">PayPal</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback"> Name on card is required </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                            <div class="invalid-feedback"> Credit card number is required </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                            <div class="invalid-feedback"> Expiration date required </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                            <div class="invalid-feedback"> Security code required </div>
                        </div>
                    </div>
                    -->
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