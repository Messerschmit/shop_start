<?php require_once (ROOT.'/views/layouts/header.php');?>

<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4 padding-right">
            <?php if($result): ?>
                <p>Ваше письмо успешно отправлено</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?= $error;?></li>
                        <?php endforeach;?>
                    </ul>
                    <?php endif;?>
                <div class="signup-form">
                    <h2>Обратная связь</h2>
                    <h5>Есть вопрос? Напишите нам!</h5>
                    <br>
                    <form action="#" method="post">
                        <p>Ваша почта:</p>
                        <input type="email" name="userEmail" placeholder="E-mail" value="<?php echo $userEmail;?>"/>
                        <p>Сообщение:</p>
                        <input type="text" name="userText" placeholder="Сообщение" value="<?php echo $userText;?>"/>
                        <br>
                        <input type="submit" name="submit" class="btn btn-default" value="Отправить"/>    
                    </form>
                    <br>
                    <br>
                </div>
           <?php endif;?>     
        </div>
    </div>
</div>

<?php require_once (ROOT.'/views/layouts/footer.php');?>
