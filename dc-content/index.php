<?php $dc_site->get_header(); ?>				


<?php 

  //diego3g
  //diego545820
	//git push origin master
	//git pull origin master

	// $query = $em->createQuery('SELECT p FROM Entities\Product p');
	// $query->setParameter(1, '3');

	// $product = $query->getResult();

	// foreach ($product as $p) {
	// 	echo $p->getProductName();
	// }

	/*$p = $em->find('\Entities\Product', 4);

	$images = $p->getProductImages();

	foreach ($images as $image) {
		echo $image->getImageUrl();
	}*/

	// echo $p->getProductName();

 ?>


	<ul class="prd_destaque">
		<?php
		$query = $em->createQuery('SELECT p FROM Entities\Product p WHERE p.product_status = 1');
		// $query = $em->createQuery('SELECT p FROM Entities\Product p TIME_TO_SEC(TIMEDIFF(NOW(), p.product_date)) < 0');
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