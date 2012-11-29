<?php 
	session_start();
	if(!isset($_SESSION["carrinho"])){
		header("Location: ".DC_BASE."index");
	}
?>
<?php $dc_site->get_header(); ?>
<h1>Carrinho de Compras</h1>
<table border="0" cellpadding="0" cellspaccing="0" width="100%" class="carrinho">
	<thead>
		<th></th>
		<th align="center">Imagem</th>
		<th>Produto</th>
		<th align="center">Quantidade</th>
		<th align="center">Preço</th>
		<th align="center">Subtotal</th>
	</thead>
	<tbody>
		<?php
		$query = $em->createQuery('SELECT p FROM Entities\Product p WHERE p.id IN (?1)');
		$query->setParameter(1, array_keys($_SESSION['carrinho']));

		$products = $query->getResult();
		foreach($products as $product){
			$id = $product->getProductId();
			$quantidade = (int)$_SESSION["carrinho"][$id];
			$subTotal   = $quantidade * $product->getProductPrice();
			$total += $subTotal;
		?>
		<tr>
			<td align="center"><a href="carrinho/remove/<?= $id ?>" class="remove"></a></td>
			<td align="center"><img src="<?= $product->getProductThumbnail()->getImageUrl() ?>" alt="Oferta: <?=$product->getProductName()?> - R$<?=number_format($product->getProductPrice(), 2, ',', '.')?>" width="50" height="50" /></td>
			<td><?= $product->getProductName() ?></td>
			<td align="center"><?= $quantidade ?></td>
			<td align="center">R$<?= number_format($product->getProductPrice(), 2, ',', '.') ?></td>
			<td align="center">R$<?= number_format($subTotal, 2, ',', '.') ?></td>
		</tr>
		<?php
		}
		?>
	</tbody>
	<tfoot>
		<tr>
			<th align="right" colspan="4" style="background:#FFF"></th>
			<th align="right">Total</th>
			<th align="center">R$<?= number_format($total, 2, ',', '.') ?></th>
		</tr>
		<tr>
			<td colspan="4" style="background:#FFF"></td>
			<td align="center">
				<a href="carrinho/limpar">Limpar Carrinho</a>
			</td>
			<td align="center">
				<a href="finalizar">Finalizar Pedido</a>
			</td>
		</tr>
	</tfoot>
</table>
<?php $dc_site->get_footer(); ?>