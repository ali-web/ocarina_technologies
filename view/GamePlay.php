<!DOCTYPE html>
<html>
    
    <head>
        <title>Your Turn</title> 
        <link rel="stylesheet" type="text/css" href="/static/css/common.css"></link>
        <link rel="stylesheet" type="text/css" href="/static/css/gameplay.css">
        <script src="//use.edgefonts.net/indie-flower:n4:all.js"></script>
    </head>
        <h2><?php echo $title; ?></h2>
        
        <p><?php echo $body; ?></p>
        
        <form id="add_words" name="add_words" method="post">
            Enter <b>4</b> words:<br>
            <input type="text" name="words">
            <input type="submit" value="Add words"> 
        </form>
</html>