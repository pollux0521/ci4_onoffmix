<div class="meeting-list">
    <?php if(isset($MTList)):?>
        <?php foreach($MTList as $mt):?>
            <div class= "meeting-item">
                <a href="/mtPage/<?= $mt["mtName"]?>"><?= $mt["mtName"]?></a>
            </div>
        <?php endforeach; ?>
    <?php endif;?>
</div>