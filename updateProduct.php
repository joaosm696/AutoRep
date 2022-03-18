<?php
if (isset($_POST['alterar'])){
    include('funcao.php');
                    $id = $_POST['id'];
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
                                    $sql="UPDATE `produtos` SET `nome`='$nome',`descricao`='$descricao',`valor`='$valor',`promocional`='$promocional',`imagem`='$imagem_destino' WHERE id = $id";
                                    $query = DBExecute($sql);
                                    if ($query) {
                                        echo "<script>alert('Produto adicionado com sucesso!');</script>";
                                        echo "<script>window.location.href = 'painel.php';</script>";
                                    } else {
                                        echo "<script>alert('Erro ao alterar produto!');</script>";
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
                ?>