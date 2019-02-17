<?php
require(__DIR__ . '/../../system/config.php');
require(__DIR__ . '/../../language/' . $config['language'] . '.php');
?>
<div class="column is-two-fifths">
    <div class="card">
        <div class="card-image">
            <figure class="image is-4by3">
                <img src="{{image}}" alt="{{title}}" onerror="this.onerror=null;this.src='https://via.placeholder.com/450x350';">
            </figure>
        </div>
    </div>
</div>
<div class="column">
    <div class="card-content">
        <div class="media">
            <div class="media-content">
                <p class="title is-4">{{title}}</p>
                <p class="subtitle is-6"><strong><?php echo $lang['safety']; ?>: </strong><span class="tag is-{{tagClass}}">{{safety}}</span> <strong><?php echo $lang['keywords']; ?>: </strong>{{keywords}}</p>
            </div>
        </div>
        <br>
        <div class="content">
            <p>
                <strong><?php echo $lang['description']; ?>: </strong>{{description}}
                <br>
                <strong><?php echo $lang['shortUrl']; ?>: </strong><a href="{{shortUrl}}" target="_blank">{{shortUrl}}</a>
                <br>
                <strong><?php echo $lang['longUrl']; ?>: </strong><a href="{{longUrl}}" target="_blank">{{longUrl}}</a>
            </p>
        </div>
    </div>
</div>