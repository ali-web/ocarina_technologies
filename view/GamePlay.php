<!DOCTYPE html>
<html>
    
    <head>
        <title>Your Turn</title> 
        <link rel="stylesheet" type="text/css" href="/static/css/common.css"></link>
        <link rel="stylesheet" type="text/css" href="/static/css/gameplay.css">
        <script src="//use.edgefonts.net/indie-flower:n4:all.js"></script>
    </head>
    
    <body>
        <div id="header">
            <h1>StoryTime with Friends</h1>
            <a href="" id="notifications">Notifications</a>
        </div>  
        
        <ul id="navbar">
            <li class="page"><a href="../.." class="plinks">Home</a></li>
            <li class="page"><a href="../friends" class="plinks">Friends</a></li>
            <li class="page"><a href="../settings" class="plinks">Settings</a></li>
            <li class="page"><a href="../help" class="plinks">Help</a></li>
        </ul>
        
        <h2><?php echo $title; ?></h2>
        
        <p><?php echo $body; ?></p>
        
        <form>
            Enter <b>4</b> words:<br>
            <input type="text" name="words">
            <input type="submit" value="Add words"> 
        </form>
    </body>
</html>