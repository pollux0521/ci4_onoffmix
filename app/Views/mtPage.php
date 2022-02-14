<div class="meeting-info">
    <div class="mt">
        <div class="mtName"><?= $mt["mtName"]?></div>
    </div>
    <?php foreach($mtGroupList as $mtGroup): ?>
        <div class="mtGroup">
            <div class="mtGroupName"><?= $mtGroup["groupname"]?></div>
            <div class="MTTime"><?= $mtGroup["startMTTime"]?> ~ <?= $mtGroup["endMTTime"]?></div>
            <div class="approvalType"><?= $mtGroup["approvalType"] ? "선착순" : "개발자승인"?></div>
            <div class="limitHead"><?= $mtGroup["limitHead"]?></div>
            <div class="accessTime"><?= $mtGroup["startAccessTime"]?> ~ <?= $mtGroup["endAccessTime"]?></div>
        </div> 
    <?php endforeach; ?>
</div>