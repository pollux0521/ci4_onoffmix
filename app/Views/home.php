<div class="meeting-list">
    <?php if(isset($MTList)):?>
        <?php foreach($MTList as $mt):?>
            <div class= "meeting-item">
                <a href="/MTPage/mtOf/<?= $mt["mtName"]?>"><?= $mt["mtName"]?></a>
            </div>
        <?php endforeach; ?>
    <?php endif;?>
</div>