<html>
    <head>
        <title><?php echo $title; ?> | Story Time</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="<?= auto_version(ST_CSS_SITE_WEB_ROOT . 'base.css') ?>" />

        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="<?= auto_version(ST_JS_SITE_WEB_ROOT . 'main.js') ?>"></script>
    </head>
    
    <body>
        <section id="wrapper">
            <header>
                <section id="header_main">
                    <nav>
                        <ul id="nav-main">
                            <li><a href="/">Home</a></li> |
                        </ul>
                    </nav>
                </section>    
            </header>
            
            <section id="main">
                <h1 id="page_title"><?php echo $title; ?></h1>
            