<form method="POST" action="">
<table>
    <tr>
        <td>Title:</td>
        <td><?= $title ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Story:</td>
        <td>
            <div><?= $body ?></div>
        </td>
        <td></td>
    </tr>
    <tr>
        <td>Your words:</td>
        <td><input type="text" name="phrase" /></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td><input autocomplete="off" type="submit" name="add" value="Add" /></td>
        <td></td>
    </tr>
</table>
</form>