<?php
include('../UIComponents/header.php"');
if(!isset($_SESSION['user'])) {
    toMainPage();
} else {
    $requests = getRequestByUserId($_SESSION['user']['id']);
}
?>

<div class="container-xxl">
    <div class="headlines">
        <h2>Здравствуйте,
            <?= $_SESSION['user']['fcs'] ?>
        </h2>
        <?php
        if(!$requests):
            ?>
            <h3>У вас нет написанных заявлений</h3>
        <?php else: ?>
            <h3>Ваши заявления</h3>
            <div class="card list-group">
                <?php while($row = $requests->fetch()): ?>
                    <li class="list-group-item p-3 w-100">
                        <div class="row row-cols-3">
                            <div class="col text-start"><b>Номер машины:</b>
                                <?= $row['number'] ?>
                            </div>
                            <div class="col text-start"><b>Описание нарушения:</b>
                                <?= $row['description'] ?>
                            </div>
                            <div class="col text-start text-<?=$row['type']?>"><b>Статус:</b>
                                <?= $row['name'] ?>
                            </div>
                        </div>
                    </li>
                <?php endwhile; ?>

            </div>
        <?php endif ?>
    </div>
</div>