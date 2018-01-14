<?php include_once (ROOT.'/views/layouts/admin_header.php');?>
<section>
    <div class="container">
        <div class="row">
            <br>

            <div class="breadcrumbs">
                <ol class="breadcrumbs">
                    <li><a href="/admin">Панель администратора</a></li>
                    <li class="active">Управление товарами</li>
                </ol>
            </div>

            <a href="/admin/product/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить товар</a>

            <h4>Список товаров</h4>

            <br>

            <table class="table-bordered table-striped table">
                <tr>
                    <td>Id товара</td>
                    <td>Название</td>
                    <td>Код товара</td>
                    <td>Цена</td>
                    <td>Количество товара</td>
                </tr>
                <?php foreach ($productList as $product): ?>
                    <tr>
                        <td><?= $product['id']; ?></td>
                        <td><?= $product['name']; ?></td>
                        <td><?= $product['code']; ?></td>
                        <td><?= $product['price']; ?></td>
                        <td><?= $product['availability']; ?></td>
                        <td><a href="/admin/product/update/<?= $product['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square"></i></a></td>
                        <td><a href="/admin/product/delete/<?= $product['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>      
        </div>
    </div>
</section>
<?php include_once (ROOT.'/views/layouts/admin_footer.php');?>



