<?php
include '../../connect/login.php';
include '../../core/load.php';

if(login::isLoggedIn()){
   $userid = login::isLoggedIn();
   $userInfo= $loadUser->getUserInfo($userid);
}else{
    header('Location:login.php');
}
$songs = array(
    array(
        'name' => 'Suicidal toughts',
        'cover' => "http://localhost/facebook/assets/images/songs_images/You're Nobody (Til Somebody Kills You).jpg",
        'artist' => 'Biggie Smalls',
        'src' => 'http://localhost/facebook/assets/songs/song1.mp3',
        'lyrics' =>
        "
        0 | When I die, fuck it, I wanna go to hell
        2 | 'Cause I'm a piece of shit, it ain't hard to fuckin' tell
      5.5 | It don't make sense, goin' to heaven with the goodie-goodies
        8 | Dressed in white, I like black Timbs and black hoodies
       11 | God'll prob'ly have me on some real strict shit
        14 | No sleepin' all day, no gettin' my dick licked

        "
    ),
    array(
        'name' => 'Nymphetamine Fix',
        'cover' => "http://localhost/facebook/assets/images/songs_images/cradle.jpg",
        'artist' => 'Cradle Of Filth ',
        'src' => 'http://localhost/facebook/assets/songs/song2.mp3',
        'lyrics' =>
        "
        0 | Six feet deep is the incision
        3.7 | In my heart, that barless prison
        6.1 | Discolors all with tunnel vision
        9.9  | (Sunsetter) Nymphetamine
        12.2  | Sick and weak from my condition
        "
    ),
    array(
        'name' => 'bamboleo x narcos - (Nalo remix)',
        'cover' => "http://localhost/facebook/assets/images/songs_images/narcos.jpg",
        'artist' => 'bamboleo x narcos ',
        'src' => 'http://localhost/facebook/assets/songs/song3.mp3',
        'lyrics' =>
        "
        0 | Bem bem bem, bem bem bem be bem
        5 | Trappin like the Narco (Narco) 
        6.4 | Got dope like Pablo (Pablo) 
        9 | Cut throat like Pablo (Cut Throat)
        11 | Chop trees with the Draco (Draco)
        13 | On the nawf, got Diego (Diego) (Bamboleo, Bambolea)



        "
    ),
 
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Stories | Facebook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/css/stories.css">
</head>

<body>
    <div class="create_stories">
        <div class="create_stories_left">
            <div class="c_s_l_h">
                <div class="c_s_l_h_t">Your story</div>
                <div class="c_s_l_h_icon"><i class="c_s_l_h_icon_icon"></i> </div>
            </div>
            <div class="c_s_l_h_you">
                <img src="<?php echo BASE_URL.$userInfo->profile_picture ?>" alt="">
                <span><?php echo $userInfo->first_name.' '.$userInfo->last_name ?></span>
            </div>
            <div class="h_c_l_line"></div>
            <div class="story_options">
                <textarea id="story_text" placeholder="Start typing"></textarea>
                <div class="story_backgrounds">
                    <span>Backgrounds</span>
                    <div class="stoy_bg_wrapper">
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/1.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/2.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/3.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/4.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/5.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/6.jpg" alt="">
                        </div>

                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/8.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/9.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/10.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/11.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/12.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/13.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/14.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/15.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/16.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/17.jpg" alt="">
                        </div>
                    </div>
                    <div class="stoy_bg_wrapper1">

                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/18.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/19.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/20.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/21.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/22.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/23.jpg" alt="">
                        </div>

                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/25.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/26.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/27.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/28.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/29.jpg" alt="">
                        </div>
                        <div class="bg_story_select">
                            <img src="../../assets/images/stories/30.jpg" alt="">
                        </div>

                    </div>
                    <div class="show_more_bgs" id="show_more_bgs"><i class="motala_k7al"></i></div>
                </div>
                <div class="submit_story_menu">
                    <button class="discard_story">Discard</button>
                    <button class="share_story_text">Share to Story</button>
                </div>

            </div>
            <div class="story_options_img">
                <audio class="player" id="audio_player" controls loop></audio>

                <div class="music_menu">
                    <div class="search_in_music">
                        <input type="text" placeholder="Search music or artists">
                    </div>
                    <div class="songs_list">
                        <?php
                    foreach ($songs as $song){
                        ?>
                        <div class="song_item" data-src="<?php echo $song['src'] ?>"
                            data-lyrics="<?php echo $song['lyrics'] ?>">
                            <img src="<?php echo $song['cover']?>" alt="">
                            <div class="music_col">
                                <span> <?php echo substr($song['name'],0,30).'...' ?></span>
                                <span><?php echo $song['artist'] ?></span>
                            </div>
                            <div class="play_song_wrap">
                                <i class="fas fa-play-circle"></i>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    </div>
                </div>
                <div class="submit_story_menu">
                    <button class="discard_story">Discard</button>
                    <button class="share_story_img">Share to Story</button>
                </div>
            </div>
        </div>
        <div class="create_stories_right">
            <div class="story_img_create">
                <div class="c_s_l_h_icon_holdat">
                    <i class="lmkpfjniokaznhioafhn"></i>
                </div>
                Create a photo story
            </div>
            <div class="story_text_create">
                <div class="c_s_l_h_icon_holdat">
                    <i class="khnjadf5af4afaf"></i>

                </div>
                Create a text story
            </div>
        </div>
        <div class="create_stories_right1">
            <div class="story_preview_editor">
                <span>Preview</span>
                <div class="bg_black_rad">
                    <div class="story_bg" data-bg="assets/images/stories/1.jpg">
                        <div class="start_typing">Start typing</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="create_stories_right2">
            <input type="file" style="display: none" id="story_img">
            <div class="story_preview_editor">
                <span>Preview</span>
                <div class="bg_black_rad">
                    <div class="story_img_preview">
                        <div class="lyrics" style="display: none">

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/jquery.fillcolor.js"></script>
    <script>
    var song = "";
    var bg = "../../assets/images/stories/1.jpg";
    $(document).on('click', '#show_more_bgs', () => {
        $('.stoy_bg_wrapper1').css('display', 'flex');
        $('.motala_k7al').css('transform', 'rotate(180deg)');
        $('.show_more_bgs').attr('id', 'show_less_bgs');
    })
    $(document).on('click', '#show_less_bgs', () => {
        $('.stoy_bg_wrapper1').hide()
        $('.motala_k7al').css('transform', 'rotate(0deg)');
        $('.show_more_bgs').attr('id', 'show_more_bgs');
    })
    $(document).on('click', '.story_text_create', () => {
        $('.create_stories_right').hide()
        $('.create_stories_right1').css('display', 'flex');
        $('.story_options').show()

    })
    $(document).on('click', '.story_img_create', function() {
        $('#story_img').click();
    })
    var img;
    $(document).on('change', '#story_img', function(e) {
        img = e.target.files[0];
        $(this).removeData();

        var reader = new FileReader();
        reader.readAsDataURL(img);

        reader.onload = function(e) {
            var name = document.getElementById("story_img").files[0].name;
            var template = ' <img class="story_img_preview_img" id = "' + name +
                '" src="' + e.target.result + '" / >';
            $('.story_img_preview').append(template);
            $('.story_img_preview').fillColor();
        }
        $('.create_stories_right').hide()
        $('.story_options_img').show()
        $('.create_stories_right2').css('display', 'flex');
    })
    $(document).on('click', '.share_story_img', function() {
        var image = img;
        var formData = new FormData();
        formData.append('file', image)

        $.ajax({
            url: 'http://localhost/facebook/core/ajax/storyImage.php',
            cache: false,
            method: "post",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                $.post('http://localhost/facebook/core/ajax/storyImage.php', {
                    song: song,
                    image: data,
                }, function(data) {
                    console.log(data)
                })
                /*
                window.location.href = 'http://localhost/facebook/';
                */
            }

        })
    })
    $(document).on('keyup', '#story_text', () => {
        var text = $('#story_text').val();
        $('.start_typing').html(text);
        if (text == '') {
            $('.start_typing').html('Start typing');
        }
    })
    $(document).on('click', '.bg_story_select', function() {
        var bgg = $(this).find('img').attr('src');
        bg = bgg;
        $('.story_bg').css('background-image', 'url(' + bgg + ')');
        $('.story_bg').attr('data-bg', bgg);
    })
    $(document).on('click', '.share_story_text', function() {
        var background = bg.substring(6, bg.length);
        var text = $('#story_text').val();

        $.post('http://localhost/facebook/core/ajax/story.php', {
            add_story: "<?php echo $userid ?>",
            background: background,
            text: text
        }, function(data) {
            console.log(data)
            /*
            window.location.href = 'http://localhost/facebook/';
            */
        })
    })
    $(document).on('click', '.play_song_wrap', function() {
        $('#audio_player')[0].play();
    })
    $(document).ready(function() {
        var $dragging = null;

        $(document.body).on("mousemove", function(e) {
            if ($dragging) {
                $dragging.offset({
                    top: e.pageY,
                    left: e.pageX
                });
            }
        });


        $(document.body).on("mousedown", ".lyrics", function(e) {
            $dragging = $(e.target);
        });

        $(document.body).on("mouseup", function(e) {
            $dragging = null;
        });
    });
    $(document).on("click", '.song_item', function() {
        var src = $(this).data('src');
        var lyricss = $(this).data('lyrics');

        song = src;
        $('.lyrics').html(lyricss)
        $('.player').show()
        $('.player').attr('src', src)

        const player = document.querySelector('.player')
        const lyrics = document.querySelector('.lyrics')
        const lines = lyrics.textContent.trim().split('\n')

        lyrics.removeAttribute('style')
        lyrics.innerText = ''

        let syncData = []

        lines.map((line, index) => {
            const [time, text] = line.trim().split('|')
            syncData.push({
                'start': time.trim(),
                'text': text.trim()
            })
        })

        player.addEventListener('timeupdate', () => {
            syncData.forEach((item) => {

                if (player.currentTime >= item.start) lyrics.innerText = item.text
            })
        })
        $('#audio_player')[0].play();
    })
    </script>
</body>

</html>