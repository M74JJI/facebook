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
        'name' => 'النشيد الوطني',
        'cover' => "http://localhost/facebook/assets/images/songs_images/madrid.png",
        'artist' => 'Hala Madrid...y nada más',
        'src' => 'http://localhost/facebook/assets/songs/song19.mp3',
        'lyrics' =>''
        
        
    ),
    array(
        'name' => 'We love you Benzema',
        'cover' => "http://localhost/facebook/assets/images/songs_images/benz.jpg",
        'artist' => 'Hala Madrid...y nada más',
        'src' => 'http://localhost/facebook/assets/songs/song20.mp3',
        'lyrics' =>''
      
    ),  array(
        'name' => "Glory Glory Man Utd",
        'cover' => "http://localhost/facebook/assets/images/songs_images/utd.jpg",
        'artist' => 'Man Utd',
        'src' => 'http://localhost/facebook/assets/songs/song35.mp3',
        'lyrics' =>''
 
    ),
      array(
        'name' => "Fuck Liverpool",
        'cover' => "http://localhost/facebook/assets/images/songs_images/fuck.jfif",
        'artist' => 'Manchester United Rule',
        'src' => 'http://localhost/facebook/assets/songs/song36.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Bohemian Rhapsody',
        'cover' => "http://localhost/facebook/assets/images/songs_images/freddie.jpg",
        'artist' => 'Freddie Mercury',
        'src' => 'http://localhost/facebook/assets/songs/song6.mp3',
        'lyrics' =>
       "
       6 | Mamaaa
       9 | Just killed a man,
       13 | Put a gun against his head, pulled my trigger
       17 | Now he's dead
      19.5 | Mamaaa, life had just begun,
     26.4 | But now I've gone and thrown it all away
     33 | Mama, oooh,
    39.5 | Didn't mean to make you cry,
   43 | If I'm not back again this time tomorrow,
  47.8 | Carry on, carry on as if nothing really matters
  64 | Too late, my time has come,
 71 | Sends shivers down my spine
 74 |  body's aching all The time
 78 |  Goodbye, everybody
 81 |  I've got to go
 84.7 |  Gotta leave you all behind and face the truth
 91.7 |  Mama, oooh
 98 | I don't want to die
 101 | I sometimes wish I'd never been born at all
 
       "
        
    ),
    array(
        'name' => 'The Phantom Of The Opera ',
        'cover' => "http://localhost/facebook/assets/images/songs_images/nightwish.jpg",
        'artist' => 'Nightwish',
        'src' => 'http://localhost/facebook/assets/songs/song7.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'To the Helfire',
        'cover' => "http://localhost/facebook/assets/images/songs_images/lorna.jpg",
        'artist' => 'Lorna Shore',
        'src' => 'http://localhost/facebook/assets/songs/song21.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Waaaaaaaaaaaaaaa Hmed',
        'cover' => "http://localhost/facebook/assets/images/songs_images/chaabi.jpg",
        'artist' => 'Chaabi mix',
        'src' => 'http://localhost/facebook/assets/songs/song22.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Wa 7a7a',
        'cover' => "http://localhost/facebook/assets/images/songs_images/chaabi1.webp",
        'artist' => 'Chaabi mix',
        'src' => 'http://localhost/facebook/assets/songs/song23.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Hangar 18',
        'cover' => "http://localhost/facebook/assets/images/songs_images/megadeth.jpg",
        'artist' => 'Megadeth',
        'src' => 'http://localhost/facebook/assets/songs/song8.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Wasted Years',
        'cover' => "http://localhost/facebook/assets/images/songs_images/maiden.jpg",
        'artist' => 'Iron Maiden',
        'src' => 'http://localhost/facebook/assets/songs/song9.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'NVINCIBLE',
        'cover' => "http://localhost/facebook/assets/images/songs_images/popsmoke.jpg",
        'artist' => 'Pop smoke',
        'src' => 'http://localhost/facebook/assets/songs/song24.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Cross my heart and hope to die',
        'cover' => "http://localhost/facebook/assets/images/songs_images/sentenced.jpg",
        'artist' => 'Sentenced',
        'src' => 'http://localhost/facebook/assets/songs/song25.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Oudenophobia ',
        'cover' => "http://localhost/facebook/assets/images/songs_images/intent.jpg",
        'artist' => 'Shadow of intent',
        'src' => 'http://localhost/facebook/assets/songs/song26.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Kill The pain',
        'cover' => "http://localhost/facebook/assets/images/songs_images/accept.jpg",
        'artist' => 'Accept',
        'src' => 'http://localhost/facebook/assets/songs/song27.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "I'm Not A Vampire",
        'cover' => "http://localhost/facebook/assets/images/songs_images/reverse.jpg",
        'artist' => 'Falling In Reverse',
        'src' => 'http://localhost/facebook/assets/songs/song28.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "The Drug In Me Is Reimagined",
        'cover' => "http://localhost/facebook/assets/images/songs_images/reverse1.png",
        'artist' => 'Falling In Reverse',
        'src' => 'http://localhost/facebook/assets/songs/song29.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "The Forgotten(Part 2)",
        'cover' => "http://localhost/facebook/assets/images/songs_images/joe.jpg",
        'artist' => 'Joe Satriani',
        'src' => 'http://localhost/facebook/assets/songs/song30.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "Losing My Religion",
        'cover' => "http://localhost/facebook/assets/images/songs_images/rem.jpg",
        'artist' => 'R.E.M',
        'src' => 'http://localhost/facebook/assets/songs/song31.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "Praise God",
        'cover' => "http://localhost/facebook/assets/images/songs_images/kanye.jpg",
        'artist' => 'Kanye West',
        'src' => 'http://localhost/facebook/assets/songs/song32.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "Another love",
        'cover' => "http://localhost/facebook/assets/images/songs_images/tom.jpg",
        'artist' => 'Tom Odell',
        'src' => 'http://localhost/facebook/assets/songs/song33.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "Where is My Mind",
        'cover' => "http://localhost/facebook/assets/images/songs_images/pixies.jpg",
        'artist' => 'Pixies',
        'src' => 'http://localhost/facebook/assets/songs/song37.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "512",
        'cover' => "http://localhost/facebook/assets/images/songs_images/lambofgod.jpg",
        'artist' => 'Lamb of God',
        'src' => 'http://localhost/facebook/assets/songs/song38.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "You're Nobody",
        'cover' => "http://localhost/facebook/assets/images/songs_images/biggieSmalls.jpg",
        'artist' => 'Biggie Smalls',
        'src' => 'http://localhost/facebook/assets/songs/song39.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "Psychopath Killer",
        'cover' => "http://localhost/facebook/assets/images/songs_images/killer.jpg",
        'artist' => 'Eminem ft Slaughterhouse & Yelawolf',
        'src' => 'http://localhost/facebook/assets/songs/song40.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "False Advertisement",
        'cover' => "http://localhost/facebook/assets/images/songs_images/hopsin.jpg",
        'artist' => 'Hopsin',
        'src' => 'http://localhost/facebook/assets/songs/song41.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "Ill Mind of Hopsin 7",
        'cover' => "http://localhost/facebook/assets/images/songs_images/hopsin1.jpg",
        'artist' => 'Hopsin',
        'src' => 'http://localhost/facebook/assets/songs/song42.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => "Lowkey",
        'cover' => "http://localhost/facebook/assets/images/songs_images/hopsin2.jpg",
        'artist' => 'Hopsin',
        'src' => 'http://localhost/facebook/assets/songs/song43.mp3',
        'lyrics' =>''
    ),
  
    array(
        'name' => 'Earth Song',
        'cover' => "http://localhost/facebook/assets/images/songs_images/michaekjackson.jpg",
        'artist' => 'Michael Jackson',
        'src' => 'http://localhost/facebook/assets/songs/song10.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Hellhounds',
        'cover' => "http://localhost/facebook/assets/images/songs_images/king810.jpg",
        'artist' => 'King 810',
        'src' => 'http://localhost/facebook/assets/songs/song11.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => ' Love, Hate, Love',
        'cover' => "http://localhost/facebook/assets/images/songs_images/alice.jpg",
        'artist' => 'Alice in chains',
        'src' => 'http://localhost/facebook/assets/songs/song12.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Blind',
        'cover' => "http://localhost/facebook/assets/images/songs_images/korn.jpg",
        'artist' => 'Korn',
        'src' => 'http://localhost/facebook/assets/songs/song13.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Falling Away from Me ',
        'cover' => "http://localhost/facebook/assets/images/songs_images/korn1.jpg",
        'artist' => 'Korn',
        'src' => 'http://localhost/facebook/assets/songs/song14.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Return Of The Tres',
        'cover' => "http://localhost/facebook/assets/images/songs_images/djog.jpg",
        'artist' => 'Delinquent Habits',
        'src' => 'http://localhost/facebook/assets/songs/song15.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Somewhere Only We Know',
        'cover' => "http://localhost/facebook/assets/images/songs_images/keane.jpg",
        'artist' => 'Keane',
        'src' => 'http://localhost/facebook/assets/songs/song18.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Music Sounds Better With You',
        'cover' => "http://localhost/facebook/assets/images/songs_images/stardust.jpg",
        'artist' => 'Stardust ',
        'src' => 'http://localhost/facebook/assets/songs/song16.mp3',
        'lyrics' =>''
    ),
    array(
        'name' => 'Habatl El Sagayer',
        'cover' => "http://localhost/facebook/assets/images/songs_images/shaaban.jpg",
        'artist' => 'Shaban Abd El Rehim ',
        'src' => 'http://localhost/facebook/assets/songs/song17.mp3',
        'lyrics' =>''
    ),
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
    array(
        'name' => 'bamboleo x narcos - (Nalo remix)',
        'cover' => "http://localhost/facebook/assets/images/songs_images/narcos.jpg",
        'artist' => 'bamboleo x narcos ',
        'src' => 'http://localhost/facebook/assets/songs/song4.mp3',
        'lyrics' =>""
     
    ),
    array(
        'name' => 'Moonlight Sonata',
        'cover' => "http://localhost/facebook/assets/images/songs_images/bethoven.jpg",
        'artist' => 'Ludwig van Beethoven',
        'src' => 'http://localhost/facebook/assets/songs/song5.mp3',
        'lyrics' =>""
     
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
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="icon" href="https://static.xx.fbcdn.net/rsrc.php/yD/r/d4ZIVX-5C-b.ico">


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
                <div class="pick_font">
                    <div class="pick_font_btnn">
                        <i class="chose_fnt_icc"></i>
                        <span class="font_name">Clean</span>
                        <i class="open_726782GHG"></i>
                    </div>
                    <div class="font_list">
                        <a id="clean_font">Clean</a>
                        <a id="bold_font">Bold</a>
                        <a id="neon_font">Neon</a>
                        <a id="italic_font">Italic</a>
                    </div>
                </div>
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



                <div class="music_menu">
                    <div class="search_in_music">
                        <svg viewBox="0 0 16 16" width="1em" height="1em" fill="#65676b">
                            <g fill-rule="evenodd" transform="translate(-448 -544)">
                                <g fill-rule="nonzero">
                                    <path
                                        d="M10.743 2.257a6 6 0 1 1-8.485 8.486 6 6 0 0 1 8.485-8.486zm-1.06 1.06a4.5 4.5 0 1 0-6.365 6.364 4.5 4.5 0 0 0 6.364-6.363z"
                                        transform="translate(448 544)"></path>
                                    <path
                                        d="M10.39 8.75a2.94 2.94 0 0 0-.199.432c-.155.417-.23.849-.172 1.284.055.415.232.794.54 1.103a.75.75 0 0 0 1.112-1.004l-.051-.057a.39.39 0 0 1-.114-.24c-.021-.155.014-.356.09-.563.031-.081.06-.145.08-.182l.012-.022a.75.75 0 1 0-1.299-.752z"
                                        transform="translate(448 544)"></path>
                                    <path
                                        d="M9.557 11.659c.038-.018.09-.04.15-.064.207-.077.408-.112.562-.092.08.01.143.034.198.077l.041.036a.75.75 0 0 0 1.06-1.06 1.881 1.881 0 0 0-1.103-.54c-.435-.058-.867.018-1.284.175-.189.07-.336.143-.433.2a.75.75 0 0 0 .624 1.356l.066-.027.12-.061z"
                                        transform="translate(448 544)"></path>
                                    <path
                                        d="m13.463 15.142-.04-.044-3.574-4.192c-.599-.703.355-1.656 1.058-1.057l4.191 3.574.044.04c.058.059.122.137.182.24.249.425.249.96-.154 1.41l-.057.057c-.45.403-.986.403-1.411.154a1.182 1.182 0 0 1-.24-.182zm.617-.616.444-.444a.31.31 0 0 0-.063-.052c-.093-.055-.263-.055-.35.024l.208.232.207-.206.006.007-.22.257-.026-.024.033-.034.025.027-.257.22-.007-.007zm-.027-.415c-.078.088-.078.257-.023.35a.31.31 0 0 0 .051.063l.205-.204-.233-.209z"
                                        transform="translate(448 544)"></path>
                                </g>
                            </g>
                        </svg>
                        <input type="text" placeholder="Search music or artists" id="music_search">
                    </div>
                    <div class="songs_list">
                        <?php
                    foreach ($songs as $song){
                        ?>
                        <div class="song_item" data-src="<?php echo $song['src'] ?>"
                            data-lyrics="<?php echo $song['lyrics'] ?>" data-cover="<?php echo $song['cover'] ?>"
                            data-name="<?php echo $song['name'] ?>" data-artist="<?php echo $song['artist'] ?>">
                            <img src="<?php echo $song['cover']?>" alt="">
                            <div class="music_col">
                                <span> <?php echo substr($song['name'],0,30) ?></span>
                                <span><?php echo $song['artist'] ?></span>
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
        <audio class="player" id="audio_player" controls loop></audio>

        <div class="create_stories_right2">
            <input type="file" style="display: none" id="story_img">
            <div class="story_preview_editor">
                <span>Preview</span>
                <div class="bg_black_rad">
                    <div class="story_img_preview" id="story_img_preview">

                        <div class="song_player_cover">
                            <div class="lyrics_add_header">
                                <button class="lyrics_add_cancel" id="cancel_changes">Cancel</button>
                                <div class="palet_colors_changer">
                                    <img class="img_zkhzhduzi" src="../../assets/images/palet.png"
                                        class="lyrics_add_colors">
                                </div>
                                <button class="lyrics_add_done" id="save_changes">Done</button>
                            </div>
                            <div class="lyrics" id="lyrics" style=" display: none">

                            </div>
                            <div class="song_cover_type2">
                                <img src="" alt="">
                                <div class="song_covert2_col">
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                            <div class="song_lyrics_infos_wrap">
                                <div class="lyrics_type_picker">
                                    <div class="round_ik21 selected_l_type" id="change_to_text">
                                        <i class="khnjadf5af4afaf" style="-webkit-filter:invert(100%)"></i>
                                    </div>
                                    <div class="round_ik21 selected_l_type" id="change_to_cover">
                                        <img src="https://image.flaticon.com/icons/png/512/26/26789.png" alt=""
                                            class="dzzdz7777">
                                    </div>
                                </div>
                                <canvas id="analyser"></canvas>




                                <script>
                                var canvas, ctx, source, context, analyser, fbc_array, bars, bar_x, bar_width,
                                    bar_height;
                                var audio = document.getElementById('audio_player');


                                context = new AudioContext();
                                analyser = context.createAnalyser();
                                canvas = document.getElementById("analyser");
                                /*canvas.style.height = "100px";*/
                                ctx = canvas.getContext('2d');
                                source = context.createMediaElementSource(audio);
                                source.connect(analyser);
                                analyser.connect(context.destination);
                                frameLooper();

                                function frameLooper() {
                                    window.webkitRequestAnimationFrame(frameLooper);
                                    fbc_array = new Uint8Array(analyser.frequencyBinCount);
                                    analyser.getByteFrequencyData(fbc_array);
                                    ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
                                    ctx.fillStyle = '#1b74e4'; // Color of the bars
                                    bars = 100;
                                    for (var i = 0; i < bars; i++) {
                                        bar_x = i * 3;
                                        bar_width = 2;
                                        bar_height = -(fbc_array[i] / 2);
                                        //  fillRect( x, y, width, height ) // Explanation of the parameters below
                                        ctx.fillRect(bar_x, canvas.height, bar_width, bar_height);
                                    }
                                }
                                </script>

                                <div class="music_equalizer">
                                    <div class="white_shadow">
                                        <div class="white_shadow_player"></div>
                                        <canvas id='progress-bar' width="250" height="50"
                                            style="border:1px solid green;z-index:999999999999999999">
                                        </canvas>
                                    </div>
                                    <img src="../../assets/images/equalizer.png" alt="">
                                </div>


                                <div class="song_lyrics_infos">
                                    <img class="img_726HJHDFHD" src="" alt="">
                                    <div class="lyr_inf_col">
                                        <span></span>
                                        <span></span>
                                    </div>

                                    <img src="../../assets/images/pause.png" alt="" class="pause_icon">

                                    <div class="play_song_lyrics"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/jquery.fillcolor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript">
    </script>

    <script>
    var picked_time = 0;
    var mediaPlayer = document.getElementById('audio_player');

    var canvass = document.getElementById('progress-bar');

    canvass.addEventListener("click", function(e) {
        clearTimeout(playTimeout)

        var canvass = document.getElementById('progress-bar');

        if (!e) {
            e = window.event;
        } //get the latest windows event if it isn't set
        try {
            //calculate the current time based on position of mouse cursor in canvas box
            mediaPlayer.currentTime = mediaPlayer.duration * (e.offsetX / canvass.clientWidth);
            picked_time = mediaPlayer.currentTime = mediaPlayer.duration * (e.offsetX / canvass.clientWidth);
            console.log(picked_time)
        } catch (err) {
            // Fail silently but show in F12 developer tools console
            if (window.console && console.error("Error:" + err));
        }
    }, true);








    var x = 10;

    var song = "";
    var song_cover = "";
    var song_name = "";
    var song_artist = "";
    var song_lyrics = "";
    var lyrics_type = 1;
    var lyrics_position = "";
    var lyrics_color = "";
    var cover_color = "";
    var first_time = false;
    var first_choice = false;
    var font = "clean";
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
        var song_infos = '{"name":"' + song_name + '","cover":"' + song_cover + '","artist":"' + song_artist +
            '"}';
        var formData = new FormData();
        formData.append('file', image);


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
                    lyrics: song_lyrics,
                    lyrics_type: lyrics_type,
                    song_infos: song_infos,
                    picked_time: picked_time

                }, function(data) {})
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
            text: text,
            font: font

        }, function(data) {

            window.location.href = 'http://localhost/facebook/';

        })
    })
    $(document).on('click', '.play_song_wrap', function() {
        $('#audio_player')[0].play();
    })
    /*
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
    */


    var playTimeout;
    /*
    $("#audio_player").on("play", function(e) {
        var audiooo = document.getElementsByTagName('audio')[0];
        clearTimeout(playTimeout)
        playTimeout = setTimeout(function() {
            audiooo.pause();
            audiooo.currentTime = picked_time;
            audiooo.play()

        }, 15000); // 30 seconds in ms
    });
    */


    $("#audio_player").on("pause", function(e) {
        clearTimeout(playTimeout);
    });


    var audio = document.getElementsByTagName('audio')[0];


    var bar_size = 250;
    var updateTrack = setInterval(function() {
        var size = parseInt(audio.currentTime * bar_size / audio.duration);

        $('.white_shadow_player').css('width', '' + size + 'px');
    }, 500);

    $(document).on("click", '.song_item', function() {
        var src = $(this).data('src');
        var cover = $(this).data('cover');
        var artist = $(this).data('artist');
        var name = $(this).data('name');

        $('.play_icon').attr('src', '../../assets/images/pause.png');
        $('.play_icon').removeClass().addClass('pause_icon')
        $('.lyrics_add_header').css('display', 'flex');
        $('.song_lyrics_infos_wrap').show();

        $('.song_cover_type2 img').attr('src', cover);
        $('.img_726HJHDFHD').attr('src', cover);
        $('.lyr_inf_col span:first-of-type').html(name);
        $('.lyr_inf_col span:last-of-type').html(artist);
        $('.song_covert2_col span:first-of-type').html(name);
        $('.song_covert2_col span:last-of-type').html(artist);
        $('.player').attr('src', src);


        $('#audio_player')[0].play();
        var lyricss = $(this).data('lyrics');

        if (lyricss == "") {
            lyrics_type = 1;
            $('.lyrics').hide();
            $('.song_cover_type2 img').attr('src', cover);
            $('.song_covert2_col span:first-of-type').html(name);
            $('.song_covert2_col span:last-of-type').html(artist);
            $('.song_cover_type2').css("display", 'flex');
            $('.song_cover_type2').show();
            $('#change_to_text').hide();
            $('.song_cover_type2').css('display', 'flex');

        } else {
            song_lyrics = lyricss;
            lyrics_type = 0;
            $('#change_to_text').show();
            $('.song_cover_type2').hide();
            $('.lyrics').html(lyricss)
            const player = document.querySelector('.player')
            const lyrics = document.querySelector('.lyrics')
            const lines = lyrics.textContent.trim().split('\n')

            lyrics.style.display = 'block';
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
        }











    })
    $(document).on('click', '#change_to_cover', function() {
        $('.lyrics').hide();
        var cover = $('.img_726HJHDFHD').attr('src');
        var name = $('.lyr_inf_col span:first-of-type').text();
        var artist = $('.lyr_inf_col span:last-of-type').text();
        console.log(name)
        $('.song_cover_type2 img').attr('src', cover);
        $('.song_covert2_col span:first-of-type').html(name);
        $('.song_covert2_col span:last-of-type').html(artist);
        $('.song_cover_type2').css("display", 'flex');
        lyrics_type = 1;
        console.log(lyrics_type)
    })
    $(document).on('click', '#change_to_text', function() {
        $('.lyrics').show();
        $('.song_cover_type2').hide();
        lyrics_type = 0;
        console.log(lyrics_type)
    })
    $(document).on('click', '#clean_font', function() {
        $('.start_typing').css('font-family', 'Kanit');
        font = "Clean";
        $('.font_name').html(font);
        $('.font_list').hide();

    })
    $(document).on('click', '#bold_font', function() {
        $('.start_typing').css('font-family', 'Bebas Neue');
        font = "Bold"
        $('.font_name').html(font);
        $('.font_list').hide();

    })
    $(document).on('click', '#neon_font', function() {
        $('.start_typing').css('font-family', 'Indie Flower');
        font = "Neon"
        $('.font_name').html(font);
        $('.font_list').hide();

    })
    $(document).on('click', '#italic_font', function() {
        $('.start_typing').css('font-family', 'Roboto');
        font = "Italic"
        $('.font_name').html(font);
        $('.font_list').hide();
    })
    $(document).on('click', '.pick_font_btnn', function() {
        $('.font_list').toggle();

    })
    $(document).on('keyup', '#music_search', function() {

        var searchTerm = $(this).val();

        $.post('http://localhost/facebook/core/ajax/story.php', {
            music_search: searchTerm
        }, function(data) {
            $('.songs_list').html(data);
        })
    })
    $(document).on('click', '.pause_icon', function() {
        var audiooo = document.getElementsByTagName('audio')[0];
        $(this).attr('src', '../../assets/images/play.png');
        $(this).removeClass().addClass('play_icon')
        audiooo.pause();
    })
    $(document).on('click', '.play_icon', function() {
        var audiooo = document.getElementsByTagName('audio')[0];
        $(this).attr('src', '../../assets/images/pause.png');
        $(this).removeClass().addClass('pause_icon')

        audiooo.play();
    })
    $(document).on('click', '#cancel_changes', function() {

        if (first_time == false) {
            $('.lyrics_add_header').hide();
            $('.song_lyrics_infos_wrap').hide();
            $('.song_cover_type2').hide();
            $('.lyrics').html('').hide();
            document.getElementsByTagName('audio')[0].pause();
            song = "";
            song_cover = "";
            song_name = "";
            song_artist = "";
            song_lyrics = "";
            lyrics_type = 1;
            lyrics_position = "";
            lyrics_color = "";


        } else {

            $('.song_cover_type2 img').attr('src', song_cover);
            $('.song_covert2_col span:first-of-type').html(song_name);
            $('.song_covert2_col span:last-of-type').html(song_artist);
            $('.player').attr('src', song);
            if (first_choice == true) {
                $('#audio_player')[0].currentTime = picked_time;
            }
            document.getElementsByTagName('audio')[0].play();
            $('.lyrics_add_header').hide();
            $('.song_lyrics_infos_wrap').hide();
            /*
            $('.lyrics_add_header').hide();
            $('.song_lyrics_infos_wrap').hide();
            $('.song_cover_type2').hide();
            $('.lyrics').html('').hide();
            document.getElementsByTagName('audio')[0].pause();
            */
        }


    })
    $(document).on('click', '#save_changes', function() {
        song = $('.player').attr('src');
        document.getElementsByTagName('audio')[0].play();
        song_cover = $('.img_726HJHDFHD').attr('src');
        song_name = $('.lyr_inf_col span:first-of-type').text();
        song_artist = $('.lyr_inf_col span:last-of-type').text();
        $('.lyrics_add_header').hide();
        $('.song_lyrics_infos_wrap').hide();
        first_time = true;
        first_choice = true;
    })
    var color_order = 0;
    $(document).on('click', '.song_cover_type2', function() {
        if (color_order == 0) {
            $(this).css('background-color', '#111');
            $('.song_covert2_col').css('color', '#fff');
            $('.lyrics').css('color', '#111');
            cover_color = "#111,#fff";
            color_order++;
        } else if (color_order == 1) {
            $(this).css('background-color', '#86cdfd');
            $('.song_covert2_col').css('color', '#fff');
            $('.lyrics').css('color', '#86cdfd');

            cover_color = "#86cdfd,#fff";
            color_order++;

        } else if (color_order == 2) {
            $(this).css('background-color', '#90EE90');
            $('.song_covert2_col').css('color', '#fff');
            $('.lyrics').css('color', '#90EE90');

            cover_color = "#90EE90,#fff";
            color_order++;
        } else if (color_order == 3) {
            $(this).css('background-color', '#F0E68C');
            $('.song_covert2_col').css('color', '#fff');
            $('.lyrics').css('color', '#F0E68C');

            cover_color = "#F0E68C,#fff";
            color_order++;

        } else if (color_order == 4) {
            $(this).css('background-color', '#FFA07A');
            $('.song_covert2_col').css('color', '#fff');
            $('.lyrics').css('color', '#FFA07A');

            cover_color = "#FFA07A,#fff";
            color_order++;
        } else if (color_order == 5) {
            $(this).css('background-color', '#FF69B4');
            $('.song_covert2_col').css('color', '#fff');
            $('.lyrics').css('color', '#FF69B4');

            cover_color = "#FF69B4,#fff";
            color_order++;
        } else if (color_order == 6) {
            $(this).css('background-color', '#C71585');
            $('.song_covert2_col').css('color', '#fff');
            $('.lyrics').css('color', '#C71585');

            cover_color = "#C71585,#fff";
            color_order++;
        } else if (color_order == 7) {
            $(this).css('background-color', '#663399');
            $('.song_covert2_col').css('color', '#fff');
            $('.lyrics').css('color', '#663399');

            cover_color = "#663399,#fff";
            color_order++;
        } else if (color_order == 8) {
            $(this).css('background-color', '#FFFAFA');
            $('.song_covert2_col').css('color', '#111');
            $('.lyrics').css('color', '#FFFAFA');

            cover_color = "#FFFAFA,#111";
            color_order++;

        } else if (color_order == 9) {
            $(this).css('background-color', '#708090');
            $('.song_covert2_col').css('color', '#fff');
            $('.lyrics').css('color', '#708090');

            cover_color = "#708090,#fff";
            color_order = 0;
        }

    })

    $(document).on('click', '.lyrics', function() {
        if (color_order == 0) {
            $(this).css('color', '#111');
            $('.song_cover_type2').css('background-color', '#111');
            $('.song_covert2_col').css('color', '#fff');
            cover_color = "#111";
            color_order++;
        } else if (color_order == 1) {
            $(this).css('color', '#86cdfd');
            $('.song_cover_type2').css('background-color', '#86cdfd');
            $('.song_covert2_col').css('color', '#fff');

            cover_color = "#86cdfd";
            color_order++;

        } else if (color_order == 2) {
            $(this).css('color', '#90EE90');
            $('.song_cover_type2').css('background-color', '#90EE90');
            $('.song_covert2_col').css('color', '#fff');

            cover_color = "#90EE90";
            color_order++;
        } else if (color_order == 3) {
            $(this).css('color', '#F0E68C');
            $('.song_cover_type2').css('background-color', '#F0E68C');
            $('.song_covert2_col').css('color', '#fff');

            cover_color = "#F0E68C";
            color_order++;

        } else if (color_order == 4) {
            $(this).css('color', '#FFA07A');
            $('.song_cover_type2').css('background-color', '#FFA07A');
            $('.song_covert2_col').css('color', '#fff');


            cover_color = "#FFA07A";
            color_order++;
        } else if (color_order == 5) {
            $(this).css('color', '#FF69B4');
            $('.song_cover_type2').css('background-color', '#FF69B4');
            $('.song_covert2_col').css('color', '#fff');

            cover_color = "#FF69B4";
            color_order++;
        } else if (color_order == 6) {
            $(this).css('color', '#C71585');
            $('.song_cover_type2').css('background-color', '#C71585');
            $('.song_covert2_col').css('color', '#fff');

            cover_color = "#C71585,#fff";
            color_order++;
        } else if (color_order == 7) {
            $(this).css('color', '#663399');
            $('.song_cover_type2').css('background-color', '#663399');

            $('.song_covert2_col').css('color', '#fff');
            cover_color = "#663399";
            color_order++;
        } else if (color_order == 8) {
            $(this).css('color', '#FFFAFA');
            $('.song_cover_type2').css('background-color', '#FFFAFA');
            $('.song_covert2_col').css('color', '#111');

            cover_color = "#FFFAFA";
            color_order++;

        } else if (color_order == 9) {
            $(this).css('color', '#708090');
            $('.song_cover_type2').css('background-color', '#708090');
            $('.song_covert2_col').css('color', '#fff');

            cover_color = "#708090";
            color_order = 0;
        }

    })

    $("#lyrics").draggable({
        containment: [500, 500, 500, 500]
    });
    var fifteen = setInterval(function() {
        var player = document.getElementById('audio_player');

        if (picked_time == 0) {
            if (player.currentTime > 15) {
                player.pause();
                player.currentTime = 0;
                player.play();
            }
        } else {
            if (player.currentTime > picked_time + 15) {
                player.pause();
                player.currentTime = picked_time;
                player.play();
            }
        }
    }, 200)
    </script>
</body>

</html>