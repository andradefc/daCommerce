<?php $dc_site->get_header(); ?>
<div id="produto">
	<?php
	$product  = $em->find("\Entities\Product", $url[1]);
	$desconto = ceil($product->getProductPrice() / $product->getProductFromPrice() * 100);
	?>
	<h1><?= $product->getProductName() ?></h1>
	<!-- <div class="compartilhe">
		<small>Compartilhe esta oferta:</small>

		<div class="addthis_toolbox addthis_default_style ">
		<a class="addthis_button_preferred_1"></a>
		<a class="addthis_button_preferred_2"></a>
		<a class="addthis_button_preferred_3"></a>
		<a class="addthis_button_preferred_4"></a>
		<a class="addthis_button_compact"></a>
		<a class="addthis_counter addthis_bubble_style"></a>
		</div>
		<script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
		<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-502d04156c9ac9bd"></script>

	</div> --><!-- .compartilhe -->

	<div class="prd_imagens">
		<span class="desconto"><?= $desconto ?>%</span>
		<img src="<?= $product->getProductThumbnail()->getImageUrl() ?>" alt="" class="maior" width="460" height="345" />
		<ul>
			<?php
			$images = $product->getProductImages();
			foreach($images as $image){
			?>
			<li><a href="<?= $image->getImageUrl() ?>"><img src="<?= $image->getImageUrl() ?>" alt="" /></a></li>
			<?php
			}
			?>
		</ul>
	</div><!-- prd_imagens -->

	<p><?= $product->getProductDescription() ?></p>

	<span class="valor">R$ <?= number_format($product->getProductPrice(), 2, ',', '.') ?></span>

	<div class="info_bar">
		<form action="carrinho" method="post">
			<span>Quantidade</span>
			<input type="hidden" name="id" value="<?= $product->getProductId() ?>">
			<input type="text" name="qtd" value="1" />
			<input type="submit" value="Adicionar ao Carrinho" class="mais" name="addCarrinho" />
		</form>
	</div><!-- .infor_bar -->

</div><!-- #produto -->

<h2>Produto em Destaque</h2>
<ul class="prd_destaque">
	<?php
	$query = $em->createQuery('SELECT p FROM Entities\Product p');
	$products = $query->getResult();

	$item = 0;
	foreach($products as $product){
		$item++;
	?>
	<li class="<?=(($item == count($products)) ? 'nomargin' : ''); ?>">
		<img src="<?= $product->getProductThumbnail()->getImageUrl() ?>" alt="Oferta: <?=$product->getProductName()?> - R$<?=number_format($product->getProductPrice(), 2, ',', '.')?>" width="290" height="180" />
		<span class="empresa"><?= $product->getProductName() ?></span>
		<h3><?= $product->getProductName() ?></h3>
		<div class="info">
			<span class="de">R$<?= number_format($product->getProductFromPrice(), 2, ',', '.') ?></span>
			<span class="por"><p>R$</p><?= number_format($product->getProductPrice(), 2, ',', '.') ?></span>
			<a href="produto/<?= $product->getProductId() ?>/<?= $dc->sanitize($product->getProductName()) ?>" title="Ver Detalhes da Oferta" class="mais">Ver Detalhes</a>
		</div><!-- .info -->
	</li>
	<?php
	}	
	?>
</ul><!-- ul.prd_destaque -->
<?php $dc_site->get_footer(); ?>