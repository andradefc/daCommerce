<?php

/**
 * Configuration from Page
 */
$page_title = "Usuários";

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
      $query = $em->createQuery('SELECT u FROM Entities\User u WHERE u.id IN (?1)');
      $query->setParameter(1, $_POST['mark']);
      $users = $query->getResult();

      $affected_lines = 0;

      switch ($_GET['action']) {
          case 'active':
              foreach ($users as $user){
                  $user->setUserStatus(1);
                  $em->persist($user);
                  $affected_lines ++;
              }

              $em->flush();
              break;

          case 'remove':
              foreach ($users as $user){
                  if ($user->getUserAccess() != 0){
                      $em->remove($user);
                      $affected_lines ++;
                  }
              }

              $em->flush();
              break;

          case 'trash':
              foreach ($users as $user){
                  if ($user->getUserAccess() != 0){
                      $user->setUserStatus(0);
                      $em->persist($user);
                      $affected_lines ++;
                  }
              }

              $em->flush();
              break;
      }
  }
}

if (isset($_GET['delete'])) {
    $user = $em->find('\Entities\User', $_GET['delete']);

    if ($user){
        if ($user->getUserAccess() != 0){
            $em->remove($user);
            $em->flush();
            $affected_lines = 1;
        }
    }
}
?>

<?php $dc_admin->get_header(); ?>

<!-- Content Area -->
<div id="da-content-area">
    <div class="grid_4">
        <p style="float:left">
            <a href="dc-add-user" class="da-button green">Novo usuário</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Com marcados:&nbsp;&nbsp;
            <a href="dc-users/?action=active" class="change-action da-button green">Ativar</a>&nbsp;&nbsp;
            <a href="dc-users/?action=remove" class="change-action da-button red">Remover marcados</a>&nbsp;&nbsp;
            <a href="dc-users/?action=trash" class="change-action da-button red">Mover para lixeira</a>
        </p>
        <form class="da-form" style="float:right;width:250px;margin-top:12px">
            <input id="search-user" type="text" placeholder="Procurar Usuário..." />
        </form>
        <div class="clear" style="margin-top:20px"></div>
        <div class="da-panel collapsible">
            <div class="da-panel-header">
                <span class="da-panel-title">
                    <img src="images/icons/black/16/list.png" alt="" />
                    Usuários
                </span>
            </div>
            <div class="da-panel-content">
                <?php if (count($affected_lines)): ?>
                <div class="da-message success">
                    <?= $affected_lines ?> linhas afetadas.
                </div>
                <?php endif ?>
                <form action="dc-users/?teste=a" method="post" id="form-table">
                    <table class="da-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" /></th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Tipo</th>
                                <th>Data de cadastro</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            /**
                             * Get all users and list
                             */

                            $query = $em->createQuery('SELECT u FROM Entities\User u');
                            $users = $query->getResult();
                            if ($users) :
                                foreach ($users as $user) :
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="mark[]" value="<?php echo $user->getUserId(); ?>" /></td>
                                    <td><?php echo $user->getUserName(); ?></td>
                                    <td><?php echo $user->getUserEmail(); ?></td>
                                    <td><?php echo $user->getUserAccessRole(); ?></td>
                                    <td><?php echo $user->getUserConvertedDate('d/m/Y H:i:s'); ?></td>
                                    <td><?php echo $user->getUserStatusRole(); ?></td>
                                    <td class="da-icon-column">
                                        <a href="#"><img src="images/icons/color/magnifier.png" /></a>
                                        <a href="dc-add-user/?user=<?php echo $user->getUserId(); ?>"><img src="images/icons/color/pencil.png" /></a>
                                        <?php if ($user->getUserAccess() !== 0): ?>
                                            <a href="dc-users/?delete=<?php echo $user->getUserId(); ?>"><img src="images/icons/color/cross.png" /></a>
                                        <?php else :?>
                                            <img src="images/icons/color/cross-gray.png" />
                                        <?php endif;?>
                                    </td>
                                </tr>
                                <?php endforeach;
                            else : ?>
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