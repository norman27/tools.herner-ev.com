function Effects () {
    this.audioNode = document.getElementById('js-effect-audio-container'); // does not work with jquery
    this.visualNode = $('#js-effect-visual-container');
    this.intervalFunction = null;
    this.running = null;
    this.timestamp = 0;

    this.stop = function() {
        this.audioNode.pause();
        this.visualNode.html('');
        clearTimeout(this.intervalFunction);
        this.intervalFunction = null;
    };

    this.play = function(src) {
        this.audioNode.pause();
        this.audioNode.src = src;
        this.audioNode.play();
    };

    this.volumeup = function() {
        this.audioNode.volume = 1; //@TODO make this better
        console.log(this.audioNode.volume);
    };

    this.volumedown = function() {
        this.audioNode.volume = 0.5; //@TODO make this better
        console.log(this.audioNode.volume);
    };

    this.gummihuhn = function() {
        var img = '<img class="shake-slow shake-constant effect-gummihuhn" src="/img/gummihuhn.png">';
        this.visualNode.append(img);
    };

    this.broken = function() {
        var img = '<img src="/img/broken.png" class="effect-broken">';
        this.visualNode.append(img);
    };

    this.darken = function() {
        var div = '<div class="js-effect-darken">';
        this.visualNode.append(div);
        this.visualNode.find('.js-effect-darken').each(function() { $(this).fadeIn() });
    };

    this.penalty = function() {
        this.audioNode.pause();
        this.audioNode.src = '/sounds/penalty1.mp3';
        this.audioNode.play();

        var div = '<section class="reveal redbg js-effect-penalty">'
                  + '<h1>Strafe</h1><img src="/img/penalty_signals.png">'
                  + '</section>';
        this.visualNode.append(div);
        this.visualNode.find('.js-effect-penalty').animate({
            top: "90px"
        }, 500, "linear");
    };

    this.goal = function() {
        this.audioNode.pause();
        this.audioNode.src = '/sounds/goal1.mp3';
        this.audioNode.play();

        var div = '<section class="reveal greenbg js-effect-goal"><br><br>'
            + '<h2 class="shake-slow shake-constant">TOOOOOOR!</h2>'
            + '<h3 class="shake-chunk shake-constant">TOOOOOR!</h3>'
            + '<h3 class="shake-chunk shake-constant">TOOOOOR!</h3>'
            + '<h2 class="shake-slow shake-constant">TOOOOOOR!</h2>'
            + '</section>';
        this.visualNode.append(div);
        this.visualNode.find('.js-effect-goal').animate({
            top: "90px"
        }, 500, "linear");
    };

    this.snowflake = function() {
        for (var i=1; i<=20; i++) {
            var size = 50 + Math.floor(Math.random()*25 + 1),
                left = Math.floor(Math.random()*896 + 1) - 25,
                speed = 50 + Math.floor(Math.random()*150 + 1);
            snowflake = '<img class="js-effect-snowflake rotating" data-speed="' + speed + '"'
                        + ' src="/img/snowflake.png" width="' + size + '" height="' + size + '"'
                        + ' style="top: -' + (size+25) + 'px;left:' + left + 'px"/>';
            this.visualNode.append(snowflake);
        }

        clearTimeout(this.intervalFunction);
        this.intervalFunction = setInterval(function() {
                $('.js-effect-snowflake').each(function() {
                    $(this).animate({
                        top: '+=' + $(this).data('speed')
                    }, 1000, "linear");
                    if (parseInt($(this).css('top')) > 512) { // restart this snowflake
                        var left = Math.floor(Math.random()*896 + 1) - 25,
                            speed = 50 + Math.floor(Math.random()*150 + 1);
                        $(this).stop(true, true).css('top', '-100px');
                        $(this).css('left', left + 'px');
                        $(this).data('speed', speed);
                    }
                });
            },
            1000
        );
    };

    this.goalscorer = function(player) {
        if (player > 0) {
            var targetSlide = $('#js-goalscorer'),
                sourceSlide = $('#js-player-' + player);

            targetSlide.find('img:first').attr('src', sourceSlide.find('img:first').attr('src'));
            targetSlide.find('h1').html(sourceSlide.find('h1').html());
            targetSlide.find('h2').html(sourceSlide.find('h2').html());

            var state = Reveal.getState();
            Reveal.slide(0, 1, 0);
            window.setTimeout(function () {
                Reveal.setState(state);
            }, 5000);
        }
    }
}

