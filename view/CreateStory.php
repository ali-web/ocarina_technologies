<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
$(function() {
    $( "#friends_search" ).autocomplete({
        source: '/AutoComplete/complete/'
    });
});
</script>


<div class="margin-break"></div>
<h1 id="StoryTitle"><?php echo $title; ?></h1>

<form>
    <center><input id="regen" type="button" value="Regenerate Title"></center>
</form>


<form id="turns" name="turns" method="post" action="gamePlay/<?php echo $uri;?>">
<div id="friends_list" class="list">
    <h2>Invite Friends:</h2>
    <input id="friends_search">
</div>
    
    <div id="Settings" class="list">
        <h2>Turns per person:</h2>
        <input type="text" name="numturns">
    </div>
    <input type="hidden" name="game_uri" value="<?php echo $uri;?>">
    <input type="hidden" name="game_title" value="<?php echo $title;?>">
    <input id="create_story" name="create_story" type="submit" value="Create Story">
</form>

<script>
    $('#regen').on('click', function() {
        $.get("/Title/regen/", {rt: "ajax"}, function(data) {
            $("#StoryTitle").text(data);
        });
    });
</script>