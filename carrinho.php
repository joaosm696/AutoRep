<?php
function AdicionarCarrinho($id_utilizador)
{
	$hasShop = VerificarCarrinhoExisteAtivo($id_utilizador);
	if (!empty($hasShop)) return $hasShop;
	// não existe um carrinho ativo - criá-lo
	$sql = "insert into carrinho (id, estado, datahora, preco_total_carrinho, id_user) values
		(null, 0, now(), 0, (select id from utilizadores where id='$id_utilizador'))";

	$resultado = DBExecute($sql);
	//echo $sql . " " . mysqli_error($conexao); exit();

	if (!$resultado) {
		$_SESSION["erro"] = "Não foi possível alterar o carrinho de compras.1";
		Header("Location: carrinho.php");
		exit();
	}
	$resp = VerificarCarrinhoExisteAtivo($id_utilizador);
	return $resp;
}
function VerificarCarrinhoExisteAtivo($id_utilizador)
{
	$sql = "select id from carrinho where id_user = $id_utilizador && estado = 0";  // obter o id do carrinho criado
	$resp = DBExecute($sql);
	$result = mysqli_fetch_array($resp, MYSQLI_ASSOC);
	return $result;
}

// Atualiza o custo total do carrinho
function atualizar_custo_carrinho($carrinho_id)
{
	$sql = "update carrinho set preco_total_carrinho=
		(select sum(preco_total_itens) from carrinho_itens where carrinho_id=" . $carrinho_id . ")
		where id=" . $carrinho_id;
	$resultado = DBExecute($sql);
	//echo $sql . " " . mysqli_error($conexao); exit();
	if (!$resultado) {
		return false;
	} else {
		return true;
	}
}

function FinalizarCarrinho($id)
{
	$sql = "update carrinho set estado= 1, datahora=now() , preco_total_carrinho = (SELECT sum(preco_total_itens) FROM carrinho_itens WHERE carrinho_id =" . $id.") where id=" . $id;
	$resultado = DBExecute($sql);
	if (!$resultado) {
		$_SESSION["erro"] = "Não foi possível finalizar o carrinho.";
		Header("Location: carrinho.php");
		exit();
	} else {
		// estado do carrinho alterado com sucesso
		$_SESSION["mensagem"] = "Carrinho finalizado com sucesso.";
		Header("Location: index.php");
		exit();
	}
}
function RemoverCarrinho($remover_carrinho)
{
	// remover primeiro os itens do carrinho
	$sql = "delete from carrinho_itens where carrinho_id = $remover_carrinho";
	$resultado = DBExecute($sql);
	//echo $sql . " " . mysqli_error($conexao); exit();
	if (!$resultado) {
		$_SESSION["erro"] = "Não foi possível remover os itens do carrinho.";
	}

	// remover o carrinho
	$sql = "delete from carrinho where id = $remover_carrinho";
	$resultado = DBExecute($sql);
	//echo $sql . " " . mysqli_error($conexao); exit();
	if (!$resultado) {
		$_SESSION["erro"] = "Não foi possível remover o carrinho.";
	}

	Header("Location: carrinho.php");
	exit();
}
function AdicionaItemCarrinho($carrinho_id, $produto_id, $valorProduto)
{
	$sql = "INSERT INTO `carrinho_itens`(`carrinho_id`, `produto_id`, `preco_total_itens`,`quantidade`) VALUES ('$carrinho_id','$produto_id','$valorProduto',1)";
	DBExecute($sql);
}
function AtualizarItemCarrinho($carrinho_id, $produto_id)
{
	$itemCarrinho = VerificarItemDuplicadoCarrinho($carrinho_id, $produto_id);
	$valorProduto = BuscarValorProduto($produto_id);
	if (empty($itemCarrinho)) {
		AdicionaItemCarrinho($carrinho_id, $produto_id, $valorProduto["valor"]);
	} else {
		$quantidade = intval($itemCarrinho["quantidade"]) + 1;
		$valorProduto = $quantidade  * floatval($valorProduto["valor"]);
		$sql = "update carrinho_itens set quantidade = $quantidade,preco_total_itens=$valorProduto where carrinho_id = $carrinho_id and produto_id = $produto_id";
		DBExecute($sql);
	}
}
function BuscarValorProduto($produto_id)
{
	$sql = "select valor from produtos where id = $produto_id";
	$resp = DBExecute($sql);
	$result = mysqli_fetch_array($resp, MYSQLI_ASSOC);
	return $result;
}
function BuscarValorCarrinho($id)
{
	$sql = "select preco_total_itens as `valor` from carrinho_itens where id= $id";
	$resp = DBExecute($sql);
	$result = mysqli_fetch_array($resp, MYSQLI_ASSOC);
	return $result;
}
function VerificarItemDuplicadoCarrinho($carrinho_id, $produto_id)
{
	$sql = "select quantidade,preco_total_itens from carrinho_itens where carrinho_id = $carrinho_id and produto_id = $produto_id";
	$resp = DBExecute($sql);
	$result = mysqli_fetch_array($resp, MYSQLI_ASSOC);
	return $result;
}
function ListarTodoCarrinho($id_utilizador)
{
	$carrinho_id = VerificarCarrinhoExisteAtivo($id_utilizador);
	if(empty($carrinho_id["id"])) return;
	$carrinho_id = $carrinho_id["id"];
	$sql = "SELECT c.id as `itemCarrinhoId`, p.nome as `nomeProduto`,p.imagem as `urlImage`,p.descricao as `descricao`,c.quantidade as `quantidade`,c.produto_id as `idProduto` , c.preco_total_itens as `precoTotalItens` FROM carrinho_itens c inner join produtos p on p.id = c.produto_id where c.carrinho_id = $carrinho_id";
	$resp = DBExecute($sql);
	return $resp;
}

function deleteItemCarrinho($id) {
	$sql = "delete from `carrinho_itens` where id = ".$id;
	DBExecute($sql);
}

function atualizarQntItem($idItemCarrinho,$quantidade,$valor){
	$sql = "update `carrinho_itens` set quantidade = $quantidade,preco_total_itens = $valor WHERE id = $idItemCarrinho";
	DBExecute($sql);
}
function removerUmItemCarrinho($idItemCarrinho,$valor){
	$sql = "update `carrinho_itens` set quantidade = quantidade - 1,preco_total_itens = $valor WHERE id = $idItemCarrinho";
	DBExecute($sql);
}

function BuscarQtdItemCarrinho($id) {
	$sql = "select quantidade as `quantidade` from carrinho_itens where id= $id";
	$resp = DBExecute($sql);
	$result = mysqli_fetch_array($resp, MYSQLI_ASSOC);
	return $result;
}


function BuscarQtdCarrinhoFinalizado($id){
	$sql = "SELECT * FROM `carrinho` WHERE id_user = $id";
	$resp = DBExecute($sql);
	$result = mysqli_fetch_array($resp, MYSQLI_ASSOC);
	return $result;
}