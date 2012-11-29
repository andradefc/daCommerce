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
?>
<?php $dc_admin->get_header(); ?>

<!-- Content Area -->
<div id="da-content-area">
    <div class="grid_4 alpha omega">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <img src="images/icons/black/16/pencil.png" alt="" />
                    Filtro
                </span>
            </div>
            <form class="da-form product-form" action="" method="post" enctype="multipart/form-data">
                <div class="da-panel-content">
                    <div class="da-form-inline">
                        <div class="da-form-row">
                            <label>Data</label>
                            <div class="da-form-item small" style="float:left; width:200px">
                                <input type="text" name="produto" value="" style="width:200px" />
                            </div>
                            <div class="da-form-item small" style="float:left; width:200px">
                                <input type="text" name="produto" value="" style="width:200px" />
                            </div>
                        </div>
                       
                        <div class="da-button-row">
                            <input name="user_submit" type="submit" value="Filtrar" class="da-button green">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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