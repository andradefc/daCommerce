<?php

/**
 * Configuration from Page
 */
$page_title = "Atualizar Usuário";

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
        $users = $em->getRepository('\Entities\User')->findOneBy(array('user_email' => $_POST['user_email']));
        if ($users){
            $error_message = 'Já existe um usuário cadastrado com esse e-mail';
            $user_name   = $_POST['user_name'];
            $user_pass   = $_POST['user_pass'];
            $user_access = $_POST['user_access'];
            $user_company = $_POST['user_company'];
        }else{
            $adduser = new \Entities\User($_POST['user_name'], $_POST['user_email'], md5($_POST['user_pass']), $_POST['user_access'], $_POST['user_company']);
            $em->persist($adduser);
            $em->flush();

            header('Location: dc-users');
        }
    }else{
        $eduser = $em->find('\Entities\User', $_POST['user_cod']);

        $eduser->setUserName($_POST['user_name']);
        $eduser->setUserEmail($_POST['user_email']);
        if ($_POST['user_pass'] != $eduser->getUserPass()) {
            $eduser->setUserPass(md5($_POST['user_pass']));
        }
        $eduser->setUserCompany($_POST['user_company']);
        $eduser->setUserAccess($_POST['user_access']);

        $em->persist($eduser);
        $em->flush();

        $success_message = 'Usuário atualizado com sucesso!';
    }
}

if (isset($_GET['user'])) {
    $eduser = $em->find('\Entities\User', $_GET['user']);

    $user_name = $eduser->getUserName();
    $user_email = $eduser->getUserEmail();
    $user_pass = $eduser->getUserPass();
    $user_access = $eduser->getUserAccess();
    $user_company = $eduser->getUserCompany();
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
                    Usuário
                </span>
            </div>
            <div class="da-panel-content">
                <form class="da-form user-form" action="" method="post">
                    <input type="hidden" name="user_cod" value="<?=(isset($eduser)) ? $eduser->getUserId() : 0?>" />
                    <?php if (isset($error_message)): ?>
                    <div id="da-ex-val2-error" class="da-message" style="background-color: #FFCBCA;background-image: url(images/message-error.png);border-color: #EB979B;color: #9B4449;"><?php echo $error_message; ?></div>
                    <script type="text/javascript">
                      $(function() {
                        $('input[name=user_email]').focus();
                      });
                    </script>
                    <?php endif ?>
                    <?php if (isset($success_message)): ?>
                        <div id="da-ex-val2-error" class="da-message" style="background-color: #E1F1C0;background-image: url(images/message-success.png);border-color: #B5D56D;color: #62A426;"><?php echo $success_message; ?></div>
                    <?php endif ?>
                    <div class="da-form-inline">
                        <div class="da-form-row">
                            <label>Nome completo <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <!-- <span class="formNote">This is a large form element</span> -->
                                <input type="text" name="user_name" value="<?=(isset($user_name)) ? $user_name : '' ?>" />
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label>E-mail <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <span class="formNote">O e-mail será utilizado para login</span>
                                <input type="text" name="user_email" value="<?=(isset($user_email)) ? $user_email : '' ?>" />
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label>Senha <span class="required">*</span></label>
                            <div class="da-form-item small">
                                <span class="formNote">Senha para acesso ao painel e ao site</span>
                                <input type="password" name="user_pass" value="<?=(isset($user_pass)) ? $user_pass : '' ?>" />
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label>Empresa <span class="required">*</span></label>
                            <div class="da-form-item small">
                                <input type="text" name="user_company" value="<?=(isset($user_company)) ? $user_company : '' ?>" />
                            </div>
                        </div>
                        <div class="da-form-row">
                            <label>Acesso <span class="required">*</span></label>
                            <div class="da-form-item large">
                                <span class="formNote">Apenas administradores e assinantes possuem acesso ao painel.</span>
                                <select name="user_access">
                                    <option value="0" <?=(isset($user_access) && $user_access == '0') ? 'selected="selected"' : '' ?>>Administrador</option>
                                    <option value="1" <?=(isset($user_access) && $user_access == '1') ? 'selected="selected"' : '' ?>>Assinante</option>
                                    <option value="2" <?=(isset($user_access) && $user_access == '2') ? 'selected="selected"' : '' ?>>Comprador</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="da-button-row">
                        <input name="user_submit" type="submit" value="Salvar" class="da-button green">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php $dc_admin->get_footer(); ?>