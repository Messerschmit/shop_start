<?php require_once (ROOT.'/views/layouts/header.php');?>

    <section>
        <div class="container">
            <div class="row">
                <h1>Кабинет пользователя</h1>
                <h3>Привет, <?= $user['name'];?></h3>
                <ul>
                    <li><a href="/cabinet/edit">Редактировать данные пользователя</a></li>
                    <li><a href="/user/history">История покупок</a></li>
                    <?php if ($user['role'] == 'admin'): ?>
                        <li><a href="/admin">Панель администратора</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </section>

<?php require_once (ROOT.'/views/layouts/footer.php');?>