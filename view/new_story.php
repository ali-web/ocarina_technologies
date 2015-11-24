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

<input id="timer" type="text" value="<?= ST_TURN_TIME_LIMIT ?>" />

<script type="application/javascript">
    function minusTimer(){
        var time = document.getElementById('timer').value;
        time --;
        document.getElementById('timer').value =  time;
    }

    var timer = new Timer({
        tick : 1,
        ontick : function (sec) {
            console.log('interval', sec);
        },
        onstart : function() {
            console.log('timer started');
        }
    });

    timer.start(<?= ST_TURN_TIME_LIMIT ?>);
    // defining options using on
    timer.on('tick', function () {
        minusTimer();
    });


    timer.on('end', function () {
        minusTimer();
        alert('your time limit finished');
    });

    //start timer for 10 seconds
</script>
