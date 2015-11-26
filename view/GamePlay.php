<h2><?php echo $title; ?></h2>

<div class="story-body"><?php echo $body; ?></div>

<form id="add_words" name="add_words" method="post">
    Enter <b>4</b> words:<br>
    <textarea rows="2" cols="20" name="words" onkeyup="checkWordLen(this);"></textarea>
    <input type="submit" value="Add words"> 
</form>

<div class="story-body">Turn <?= $current_turn + 1 ?> of <?= $max_turns ?></div>
<div class="story-body">Timeleft: <span id="timeleft"></span></div>

<script type="text/javascript">
    $("#timeleft").timerElement({totalTime: <?php echo $timeleft; ?>, onDone: function() {
        window.location = "/Main/WaitTurn/<?php echo $uri; ?>";
    }});
    

var wordLen = 4; // Maximum word length
function checkWordLen(obj){
    var len = obj.value.split(/[\s]+/);
    if(len.length > wordLen){
    	alert("You've exceeded the "+wordLen+" word limit for the story!");
    	$(obj).val(len.slice(0,4).join(" "));
        return false;
    }
        return true;
}
</script>

