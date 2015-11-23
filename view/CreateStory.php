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


<!DOCTYPE html>
<html>
    <head> 
        <title>Create Story</title>
        <link rel="stylesheet" type="text/css" href="/static/css/common.css"></link>
        <link rel="stylesheet" type="text/css" href="/static/css/createstory.css">
        <script src="//use.edgefonts.net/indie-flower:n4:all.js"></script>
    </head>
    
    <body>
        <div id="header">
            <h1>Create a Story</h1>
            <a href="" id="notifications">Notifications</a>
        </div>           
    
        <ul id="navbar">
            <li class="page"><a href=".." class="plinks">Home</a></li>
            <li class="page"><a href="friends" class="plinks">Friends</a></li>
            <li class="page"><a href="settings" class="plinks">Settings</a></li>
            <li class="page"><a href="help" class="plinks">Help</a></li>
        </ul>
        
        <div id="gentitle">
            <h2><?php echo $title; ?></h2>
            <form>
                <input id="regen" type="button" value="Regenerate Title">
            </form>
        </div>
        
        <form id="turns" name="turns" method="post" action="gamePlay/<?php echo $uri;?>">
                <h3>Invite Friends: 
                <input id="friends_search"></h3>
                
                <h3>Turns per person:
                <input type="text" name="numturns"></h3><br><br>
                <input type="hidden" name="game_uri" value="<?php echo $uri;?>">
                <input type="hidden" name="game_title" value="<?php echo $title;?>">
                <input id="create_story" name="create_story" type="submit" value="Create Story">
        </form>
    </body>
</html>