<div class="margin-break"></div>
<div class="story-title"><h2><?= $story['title'] ?></h2></div>
<div class="story-body"><?= $story['body'] ?></div>
<div class="story-state">Waiting On Your Turn...</div>
<div class="story-body">Turn <?= $story['current_turn'] + 1 ?> of <?= $story['max_turns'] ?></div>
<div class="story-body">Timeleft on current turn - <span id="timeleft"></span></div>

<script type="text/javascript">
    $("#timeleft").timerElement({totalTime: <?php echo $timeleft; ?>, onDone: function() {
        checkForUpdate();
    }});
    
    var updateTime = 5000;
    var turnOrder = <?= $story['turn_order'] ?>;
    var currentTurn = <?= $story['current_turn'] ?>;
    var uri = '<?= $story['uri'] ?>';
    var userId = <?= $user['id'] ?>;
    var maxTurns = <?= $story['max_turns'] ?>;
    
    function checkForUpdate() {
        $.get('/Story/storyInfo/', {rt: 'ajax', uri: uri, userId: userId}, function(data) {
            data = JSON.parse(data);
           
            if (data.current_turn % data.num_players === turnOrder) {
                window.location = '/Main/gameplay/' + uri;
            } else if (data.current_turn >= maxTurns) {
                window.location = '/Main/CompletedStories/' + uri;
            } else if (data.current_turn != currentTurn) {
                window.location.reload();
            } else {
                setTimeout(checkForUpdate, updateTime);
            }
           
        }).fail(function(err) {
            setTimeout(checkForUpdate, updateTime * 6);
        });
    }
    
    setTimeout(checkForUpdate, updateTime);
</script>