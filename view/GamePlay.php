<h2><?php echo $title; ?></h2>

<div class="story-body"><?php echo $body; ?></div>

<form id="add_words" name="add_words" method="post">
    Enter <b>4</b> words:<br>
    <input type="text" name="words">
    <input type="submit" value="Add words"> 
</form>

<div class="story-body">Turn <?= $current_turn + 1 ?> of <?= $max_turns ?></div>
<div class="story-body">Timeleft: <span id="timeleft"></span></div>

<script type="text/javascript">
    $("#timeleft").timerElement({totalTime: <?php echo $timeleft; ?>, onDone: function() {
        window.location = "/Main/WaitTurn/<?php echo $uri; ?>";
    }});
</script>

