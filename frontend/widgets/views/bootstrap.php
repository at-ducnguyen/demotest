<?php
Carousel::widget([
    'items' => [
        // the item contains only the image
        '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-01.jpg"/>',
        // equivalent to the above
        ['content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-02.jpg"/>'],
        // the item contains both the image and the caption
        [
            'content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-03.jpg"/>',
            'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
            
        ],
    ]
]);
?>