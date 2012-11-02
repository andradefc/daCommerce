<?php

/**
 * Configuration from Page
 */
$page_title = "Produtos";

if ($_SESSION['logged'] !== true)
    header('Location: dc-login');
?>

<?php
if ($_SESSION['logged'] === true){
  $user = $em->find('\Entities\User', $_SESSION['user']);
  if (!$user)
    header('Location: dc-logout');
}

if (isset($_GET['action'])){
  if (!empty($_POST['mark'])){
      $query = $em->createQuery('SELECT p FROM Entities\Product p WHERE p.id IN (?1)');
      $query->setParameter(1, $_POST['mark']);
      $products = $query->getResult();

      $affected_lines = 0;

      switch ($_GET['action']) {
          case 'active':
              foreach ($products as $product){
                  $product->setProductStatus(1);
                  $em->persist($product);
                  $affected_lines ++;
              }

              $em->flush();
              break;

          case 'remove':
              foreach ($products as $product){
                  $em->remove($product);
                  $affected_lines ++;
              }

              $em->flush();
              break;

          case 'trash':
              foreach ($products as $product){
                  $product->setProductStatus(0);
                  $em->persist($product);
                  $affected_lines ++;
              }

              $em->flush();
              break;
      }
  }
}

if (isset($_GET['delete'])) {
    $product = $em->find('\Entities\Product', $_GET['delete']);

    if ($product){
        $em->remove($product);
        $em->flush();
        $affected_lines = 1;
    }
}
?>

<?php $dc_admin->get_header(); ?>

<!-- Content Area -->
<div id="da-content-area">
    <div class="grid_4">
        <p style="float:left">
            <a href="dc-add-product" class="da-button green">Novo produto</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Com marcados:&nbsp;&nbsp;
            <a href="dc-products/?action=active" class="change-action da-button green">Ativar</a>&nbsp;&nbsp;
            <a href="dc-products/?action=remove" class="change-action da-button red">Remover marcados</a>&nbsp;&nbsp;
            <a href="dc-products/?action=trash" class="change-action da-button red">Mover para lixeira</a>
        </p>
        <form class="da-form" style="float:right;width:250px;margin-top:12px">
            <input id="search-user" type="text" placeholder="Procurar Produto..." />
        </form>
        <div class="clear" style="margin-top:20px"></div>
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <img src="images/icons/black/16/list.png" alt="" />
                    Produtos
                </span>
            </div>
            <div class="da-panel-content">
                <?php if (count($affected_lines)): ?>
                <div class="da-message success">
                    <?= $affected_lines ?> linhas afetadas.
                </div>
                <?php endif ?>
                <form action="" method="post" id="form-table">
                    <table class="da-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" /></th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Vendidos</th>
                                <th>Data de Cadastro</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            /**
                             * Get all products and list
                             */

                            $query = $em->createQuery('SELECT p FROM Entities\Product p');
                            $products = $query->getResult();
                            if ($products) :
                                foreach ($products as $product) :
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="mark[]" value="<?php echo $product->getProductId(); ?>" /></td>
                                    <td><?php echo $product->getProductName(); ?></td>
                                    <td><?php echo $product->getProductPrice(); ?></td>
                                    <td><?php echo $product->getProductCount(); ?></td>
                                    <td><?php echo $product->getProductConvertedDate('d/m/Y H:i:s'); ?></td>
                                    <td><?php echo $product->getProductStatusRole(); ?></td>
                                    <td class="da-icon-column">
                                        <a href="#"><img src="images/icons/color/magnifier.png" /></a>
                                        <a href="dc-add-product/?product=<?php echo $product->getProductId(); ?>"><img src="images/icons/color/pencil.png" /></a>
                                        <a href="#"><img src="images/icons/color/cross.png" /></a>
                                    </td>
                                </tr>
                                <?php endforeach;
                            else: ?>
                            <td colspan="7">Nenhum registro encontrado.</td>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php $dc_admin->get_footer(); ?>