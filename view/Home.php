<div class="margin-break"></div>
<div id="csbutton">
    <a href="/Main/new_story" id="create"><b>+ Create Story</b></a>
</div>
    
<div id="YourTurnList" class="list">
    <h2>Your Turn</h2>
    <ul id="ytlist" class="storylist">
        <?php foreach($yourTurnStories as $story): ?>
            <li class="title"><a href="/Main/gamePlay/<?= $story['uri'] ?>" class="story"><?= $story['title'] ?></a></li>
            <!--<td><?= $story['started_at'] ?></td>-->
        <?php endforeach; ?>
    </ul>
</div>
    
<div id="WaitTurnList" class="list">
    <h2>Waiting Turn</h2>
    <ul id="wtlist" class="storylist">
        <?php foreach($waitingTurnStories as $story): ?>
            <li class="title"><a href="/Main/WaitTurn/<?= $story['uri'] ?>" class="story"><?= $story['title'] ?></a></li>
            <!--<td><?= $story['started_at'] ?></td>-->
        <?php endforeach; ?>
    </ul>
</div>
    
<div id="CompletedList" class="list">
    <h2>Completed Stories</h2>
    <ul id="cslist" class="storylist">
        <?php foreach($completedStories as $story): ?>
            <li class="title"><a href="/Main/CompletedStories/<?= $story['uri'] ?>" class="story"><?= $story['title'] ?></a></li>
            <!--<td><?= $story['started_at'] ?></td>-->
        <?php endforeach; ?>
    </ul>
</div>   
