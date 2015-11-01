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