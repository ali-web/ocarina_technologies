<a href="/Main/new_story">Create a new story!</a>

<h2>List of Ongoing stories:</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Started at</th>
    </tr>
<?php foreach($stories as $story): ?>
    <tr>
        <td><a href="/main/story/<?= $story['uri'] ?>"><?= $story['title'] ?></a></td>
        <td><?= $story['started_at'] ?></td>
    </tr>
<?php endforeach; ?>
</table>

<div id="csbutton">
    <a href="CreateStory.html" id="create"><b>+ Create Story</b></a>
</div>

<div id="YourTurnList" class="list">
    <h2>Your Turn</h2>
    <ul id="ytlist" class="storylist">
        <li class="title"><a href="GamePlay.html" class="story">Story One</a></li>
        <li class="title"><a href="GamePlay.html" class="story">Story Two</a></li>
        <li class="title"><a href="GamePlay.html" class="story">Story Three</a></li>
    </ul>
</div>

<div id="WaitTurnList" class="list">
    <h2>Waiting Turn</h2>
    <ul id="wtlist" class="storylist">
        <li class="title"><a href="WaitTurn.html" class="story">Story Four</a></li>
        <li class="title"><a href="WaitTurn.html" class="story">Story Five</a></li>
    </ul>
</div>

<div id="CompletedList" class="list">
    <h2>Completed Stories</h2>
    <ul id="cslist" class="storylist">
        <li class="title"><a href="CompletedStories.html" class="story">Story Six</a></li>
        <li class="title"><a href="CompletedStories.html" class="story">Story Seven</a></li>
        <li class="title"><a href="CompletedStories.html" class="story">Story Eight</a></li>
        <li class="title"><a href="CompletedStories.html" class="story">Story Nine</a></li>
    </ul>
</div>