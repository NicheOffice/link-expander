<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $config['title']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
</head>
<body>
<section class="hero is-primary is-medium">
    <!-- Hero head: will stick at the top -->
    <div class="hero-head">
        <nav class="navbar">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item" href="<?php echo $config['websiteUrl']; ?>">
                        <h1><?php echo $config['title']; ?></h1>
                    </a>
                </div>
                <div id="navbarMenuHeroA" class="navbar-menu">
                    <div class="navbar-end">
                        <a class="navbar-item is-active" href="<?php echo $config['websiteUrl']; ?>">
                            <?php echo $lang['home']; ?>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="hero-body">
        <div class="container has-text-centered ">
            <h1 class="title">
                <?php echo $config['title']; ?>
            </h1>
            <div class="field has-addons has-addons-centered">
                <div class="control">
                    <p class="control is-expanded">
                    <input class="input" type="url" name="url" id="url" placeholder="<?php echo $lang['placeholder']; ?>">
                    <input class="input" type="hidden" name="token" id="token" value="<?php echo $_SESSION['token']; ?>">
                    </p>
                </div>
                <div class="control">
                    <button id="send" class="button is-info">
                        <?php echo $lang['expand']; ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>