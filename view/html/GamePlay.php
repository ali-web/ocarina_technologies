<!DOCTYPE html>
<html>
    
    <head>
        <title>Your Turn</title>  
        <link rel="stylesheet" type="text/css" href="gameplay.css">
        <script src="http://use.edgefonts.net/indie-flower:n4:all.js"></script>
    </head>
        <h2><?php echo $title;?></h2>
        
        <p><?php echo $body;?></p>
        
        <form>
            Enter <b>4</b> words:<br>
            <input type="text" name="words">
            <input type="submit" value="Add words"> 
        </form>
</html>