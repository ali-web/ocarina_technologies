<html>
    <head>
        <title><?php echo $title; ?> | Story Time</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="<?= auto_version(ST_CSS_SITE_WEB_ROOT . 'base.css') ?>" />

        <script type="text/javascript" src="/js/jquery.js"></script>
        <script src="http://use.edgefonts.net/indie-flower:n4:all.js"></script>
        <script type="text/javascript" src="<?= auto_version(ST_JS_SITE_WEB_ROOT . 'main.js') ?>"></script>
    </head>
    
    <body>
        <div id="header">
            <h1><?= $title ?></h1>
            <a href="" id="notifications">Notifications</a>
        </div>

        <ul id="navbar">
            <li class="page"><a href="index.html" class="plinks">Home</a></li>
            <li class="page"><a href="Friends.html" class="plinks">Friends</a></li>
            <li class="page"><a href="Settings.html" class="plinks">Settings</a></li>
            <li class="page"><a href="Help.html" class="plinks">Help</a></li>
        </ul>

