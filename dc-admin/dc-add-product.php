<?php

/**
 * Configuration from Page
 */
$page_title = "Atualizar Produto";

if ($_SESSION['logged'] !== true)
    header('Location: dc-login');
?>

<?php
if ($_SESSION['logged'] === true){
    $user = $em->find('\Entities\User', $_SESSION['user']);
    if (!$user)
        header('Location: dc-logout');
}

if (isset($_POST['user_submit'])) {
    if ($_POST['user_cod'] == 0){

        $targetDir = CONTENTPATH . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Ymd');

        if ($_POST['uploader_count'])
            for ($i = 0; $i < $_POST['uploader_count']; $i++) {
                rename($targetDir . DIRECTORY_SEPARATOR . $_POST['uploader_'.$i.'_tmpname'], $targetDir . DIRECTORY_SEPARATOR . $_POST['uploader_'.$i.'_name']);
                $images[$i] = new \Entities\Image(DC_CONTENT . 'uploads/' . date('Ymd') . '/' . $_POST['uploader_'.$i.'_name']);
                $em->persist($images[$i]);
            }

        if ($images)
            $thumb = $images[0];
        else
            $thumb = new \Entities\Image(DC_CONTENT . 'images/no-image.jpg');

        $product = new \Entities\Product($_POST['product_name'], $_POST['product_description'], $_POST['product_price'], $_POST['product_fromprice'], $thumb, $user);
        $product->setProductStatus(0);

        if ($images)
            foreach ($images as $image) {
                $product->addProductImage($image);
            }

        $em->persist($product);
        $em->flush();

    }else{
        $eduser = $em->find('\Entities\Product', $_POST['user_cod']);

        $eduser->setProductName($_POST['product_name']);
        $eduser->setProductDescription($_POST['product_description']);
        $eduser->setProductPrice($_POST['product_price']);
        $eduser->setProductFromPrice($_POST['product_fromprice']);

        $em->persist($eduser);
        $em->flush();

        $success_message = 'Produto atualizado com sucesso!';
    }
}

if (isset($_GET['product'])) {
    $eduser = $em->find('\Entities\Product', $_GET['product']);

    $product_name = $eduser->getProductName();
    $product_description = $eduser->getProductDescription();
    $product_price = $eduser->getProductPrice();
    $product_fromprice = $eduser->getProductFromPrice();

}

?>

<?php $dc_admin->get_header(); ?>

<!-- Content Area -->
<div id="da-content-area">
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <img src="images/icons/black/16/pencil.png" alt="" />
                    Produto
                </span>
            </div>
            <form class="da-form product-form" action="" method="post" enctype="multipart/form-data">
                <div class="da-panel-content">
                    <input type="hidden" name="user_cod" value="<?=(isset($eduser)) ? $eduser->getProductId() : 0?>" />
                    <?php if (isset($success_message)): ?>
                        <div id="da-ex-val2-error" class="da-message" style="background-color: #E1F1C0;background-image: url(images/message-success.png);border-color: #B5D56D;color: #62A426;"><?php echo $success_message; ?></div>
                    <?php endif ?>
                    <div class="da-form-inline">
                        <div class="da-form-row">
                            <label>Nome <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <!-- <span class="formNote">This is a large form element</span> -->
                                <input type="text" name="product_name" value="<?=(isset($product_name)) ? $product_name : '' ?>" />
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label>Descrição <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <!-- <span class="formNote">This is a large form element</span> -->
                                <textarea name="product_description" rows="auto" cols="auto"><?=(isset($product_description)) ? $product_description : '' ?></textarea>
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label>Preço (R$) <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <span class="formNote">Caso seja promoção, preencha o campo "de:".</span>
                                <input type="text" name="product_price" value="<?=(isset($product_price)) ? $product_price : '' ?>" />
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label>De (R$) <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <!-- <span class="formNote">Caso seja promoção, preencha o campo "de:".</span> -->
                                <input type="text" name="product_fromprice" value="<?=(isset($product_fromprice)) ? $product_fromprice : '' ?>" />
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label>Imagens</label>
                            <div class="da-form-item large">
                                <div class="da-panel-content" style="border-top:1px solid #CCC">
                                    <div id="uploader" style="position: relative; "></div>
                                </div>
                            </div>
                        </div>
                        <div class="da-button-row">
                            <input name="user_submit" type="submit" value="Salvar" class="da-button green">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<?php $dc_admin->get_footer(); ?>