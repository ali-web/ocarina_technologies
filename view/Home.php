<div class="margin-break"></div>
<div id="csbutton">
    <a href="/Main/new_story" id="create"><b>+ Create Story</b></a>
</div>
    
<div id="YourTurnList" class="list">
    <h2>Your Turn</h2>
    <ul id="ytlist" class="storylist">
        <?php 
        foreach($stories as $story): ?>
            <li class="title"><a href="/Main/gamePlay/<?= $story['uri'] ?>" class="story"><?= $story['title'] ?></a></li>
            <!--<td><?= $story['started_at'] ?></td>-->
        <?php endforeach; ?>
    </ul>
</div>
    
<div id="WaitTurnList" class="list">
    <h2>Waiting Turn</h2>
    <ul id="wtlist" class="storylist">
        <li class="title"><a href="Main/waitTurn" class="story">Story Four</a></li>
        <li class="title"><a href="Main/waitTurn" class="story">Story Five</a></li>
    </ul>
</div>
    
<div id="CompletedList" class="list">
    <h2>Completed Stories</h2>
    <ul id="cslist" class="storylist">
        <li class="title"><a href="Main/completedStories" class="story">Story Six</a></li>
        <li class="title"><a href="Main/completedStories" class="story">Story Seven</a></li>
    </ul>
</div>   
