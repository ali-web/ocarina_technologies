<!DOCTYPE html>
<html>
    
    <head>
        <title>Your Turn</title> 
        <?php echo $uri?>
        <link rel="stylesheet" type="text/css" href="/static/css/gameplay.css">
        <script src="http://use.edgefonts.net/indie-flower:n4:all.js"></script>
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
        
        <h2>Randomly Generated Title</h2>
        
        <p>This is where the story will be written... </p>
        
        <form>
            Enter <b>4</b> words:<br>
            <input type="text" name="words">
            <input type="submit" value="Add words"> 
        </form>
    </body>
</html>