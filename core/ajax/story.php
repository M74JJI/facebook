<?php
include '../load.php';
include '../../connect/login.php';
require_once '../../assets/addons/lineBreaker.php';

$userid = login::isLoggedIn();
function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
if(isset($_POST['add_story'])){
    $userid = $_POST['add_story'];
    $background = $_POST['background'];
    $font_name = $_POST['font'];
    $text = wordwrap($_POST['text'],26, "\n",true);
    $countLines=strlen($text)/26;
    $img = imagecreatefromjpeg('http://localhost/facebook/'.$background.'');

    $color=imagecolorallocate($img,255,255,255);
     if($font_name =="Bold"){
      $font=$_SERVER['DOCUMENT_ROOT']."/facebook/assets/fonts/bold.ttf";
     }else  if($font_name =="Italic"){
      $font=$_SERVER['DOCUMENT_ROOT']."/facebook/assets/fonts/italic.ttf";
     }else  if($font_name =="Neon"){
      $font=$_SERVER['DOCUMENT_ROOT']."/facebook/assets/fonts/neon.ttf";
     }else{ 
       $font=$_SERVER['DOCUMENT_ROOT']."/facebook/assets/fonts/clean.ttf";
     }
    $angle = 0;
    $font_size=18;
  
    $width = imagesx($img);
    $height = imagesy($img);
  // Get center coordinates of image
    $centerX = $width / 2;
    $centerY = $height / 2;
  // Get size of text
    list($left, $bottom, $right, , , $top) = imageftbbox($font_size, $angle, $font, $text);
  // Determine offset of text
    $left_offset = ($right - $left) / 2;
    $top_offset = ($bottom - $top) / 2;
  // Generate coordinates
    $x = $centerX - $left_offset;
    $y = $centerY + $top_offset;
    $yy = $y-($countLines * 50);
  // Add text to image

    imagettftext($img, $font_size, $angle, $x, $yy, $color, $font, $text);

    $path_directory =$_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid."/stories/";
    if(!file_exists($path_directory) && !is_dir($path_directory)){
    mkdir($path_directory,0777,true);
    }
  

    $path =$_SERVER['DOCUMENT_ROOT']."/facebook/user/".$userid."/stories/";
    $nm =generateRandomString().".jpg";
    imagejpeg($img,$path.$nm,100);
    $img_path="user/".$userid."/stories/".$nm;
 
    $loadUser->create('stories',array('story_bg'=>$img_path,'story_user'=>$userid,'createdAt'=>date('Y-m-d H:i:s')));
}
if(isset($_POST['get_all_stories'])){
    $userid = $_POST['get_all_stories'];
    $stories= $loadUser->getAllStories($userid);
    echo json_encode($stories);
}
if(isset($_POST['music_search'])){
  $songs = array(
    array(
        'name' => 'النشيد الوطني',
        'cover' => "http://localhost/facebook/assets/images/songs_images/madrid.png",
        'artist' => 'Hala Madrid...y nada más',
        'src' => 'http://localhost/facebook/assets/songs/song19.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'We love you Benzema',
        'cover' => "http://localhost/facebook/assets/images/songs_images/benz.jpg",
        'artist' => 'Hala Madrid...y nada más',
        'src' => 'http://localhost/facebook/assets/songs/song20.mp3',
        'lyrics' =>
        "
        "
    ),  array(
        'name' => "Glory Glory Man Utd",
        'cover' => "http://localhost/facebook/assets/images/songs_images/utd.jpg",
        'artist' => 'Man Utd',
        'src' => 'http://localhost/facebook/assets/songs/song35.mp3',
        'lyrics' =>
        "
        "
    ),
      array(
        'name' => "Fuck Liverpool",
        'cover' => "http://localhost/facebook/assets/images/songs_images/fuck.jfif",
        'artist' => 'Manchester United Rule',
        'src' => 'http://localhost/facebook/assets/songs/song36.mp3',
        'lyrics' =>
        "
        "
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
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'To the Helfire',
        'cover' => "http://localhost/facebook/assets/images/songs_images/lorna.jpg",
        'artist' => 'Lorna Shore',
        'src' => 'http://localhost/facebook/assets/songs/song21.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Waaaaaaaaaaaaaaa Hmed',
        'cover' => "http://localhost/facebook/assets/images/songs_images/chaabi.jpg",
        'artist' => 'Chaabi mix',
        'src' => 'http://localhost/facebook/assets/songs/song22.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Wa 7a7a',
        'cover' => "http://localhost/facebook/assets/images/songs_images/chaabi1.webp",
        'artist' => 'Chaabi mix',
        'src' => 'http://localhost/facebook/assets/songs/song23.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Hangar 18',
        'cover' => "http://localhost/facebook/assets/images/songs_images/megadeth.jpg",
        'artist' => 'Megadeth',
        'src' => 'http://localhost/facebook/assets/songs/song8.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Wasted Years',
        'cover' => "http://localhost/facebook/assets/images/songs_images/maiden.jpg",
        'artist' => 'Iron Maiden',
        'src' => 'http://localhost/facebook/assets/songs/song9.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'NVINCIBLE',
        'cover' => "http://localhost/facebook/assets/images/songs_images/popsmoke.jpg",
        'artist' => 'Pop smoke',
        'src' => 'http://localhost/facebook/assets/songs/song24.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Cross my heart and hope to die',
        'cover' => "http://localhost/facebook/assets/images/songs_images/sentenced.jpg",
        'artist' => 'Sentenced',
        'src' => 'http://localhost/facebook/assets/songs/song25.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Oudenophobia ',
        'cover' => "http://localhost/facebook/assets/images/songs_images/intent.jpg",
        'artist' => 'Shadow of intent',
        'src' => 'http://localhost/facebook/assets/songs/song26.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Kill The pain',
        'cover' => "http://localhost/facebook/assets/images/songs_images/accept.jpg",
        'artist' => 'Accept',
        'src' => 'http://localhost/facebook/assets/songs/song27.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "I'm Not A Vampire",
        'cover' => "http://localhost/facebook/assets/images/songs_images/reverse.jpg",
        'artist' => 'Falling In Reverse',
        'src' => 'http://localhost/facebook/assets/songs/song28.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "The Drug In Me Is Reimagined",
        'cover' => "http://localhost/facebook/assets/images/songs_images/reverse1.png",
        'artist' => 'Falling In Reverse',
        'src' => 'http://localhost/facebook/assets/songs/song29.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "The Forgotten(Part 2)",
        'cover' => "http://localhost/facebook/assets/images/songs_images/joe.jpg",
        'artist' => 'Joe Satriani',
        'src' => 'http://localhost/facebook/assets/songs/song30.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "Losing My Religion",
        'cover' => "http://localhost/facebook/assets/images/songs_images/rem.jpg",
        'artist' => 'R.E.M',
        'src' => 'http://localhost/facebook/assets/songs/song31.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "Praise God",
        'cover' => "http://localhost/facebook/assets/images/songs_images/kanye.jpg",
        'artist' => 'Kanye West',
        'src' => 'http://localhost/facebook/assets/songs/song32.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "Another love",
        'cover' => "http://localhost/facebook/assets/images/songs_images/tom.jpg",
        'artist' => 'Tom Odell',
        'src' => 'http://localhost/facebook/assets/songs/song33.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "Where is My Mind",
        'cover' => "http://localhost/facebook/assets/images/songs_images/pixies.jpg",
        'artist' => 'Pixies',
        'src' => 'http://localhost/facebook/assets/songs/song37.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "512",
        'cover' => "http://localhost/facebook/assets/images/songs_images/lambofgod.jpg",
        'artist' => 'Lamb of God',
        'src' => 'http://localhost/facebook/assets/songs/song38.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "You're Nobody",
        'cover' => "http://localhost/facebook/assets/images/songs_images/biggieSmalls.jpg",
        'artist' => 'Biggie Smalls',
        'src' => 'http://localhost/facebook/assets/songs/song39.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "Psychopath Killer",
        'cover' => "http://localhost/facebook/assets/images/songs_images/killer.jpg",
        'artist' => 'Eminem ft Slaughterhouse & Yelawolf',
        'src' => 'http://localhost/facebook/assets/songs/song40.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "False Advertisement",
        'cover' => "http://localhost/facebook/assets/images/songs_images/hopsin.jpg",
        'artist' => 'Hopsin',
        'src' => 'http://localhost/facebook/assets/songs/song41.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "Ill Mind of Hopsin 7",
        'cover' => "http://localhost/facebook/assets/images/songs_images/hopsin1.jpg",
        'artist' => 'Hopsin',
        'src' => 'http://localhost/facebook/assets/songs/song42.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => "Lowkey",
        'cover' => "http://localhost/facebook/assets/images/songs_images/hopsin2.jpg",
        'artist' => 'Hopsin',
        'src' => 'http://localhost/facebook/assets/songs/song43.mp3',
        'lyrics' =>
        "
        "
    ),
  
    array(
        'name' => 'Earth Song',
        'cover' => "http://localhost/facebook/assets/images/songs_images/michaekjackson.jpg",
        'artist' => 'Michael Jackson',
        'src' => 'http://localhost/facebook/assets/songs/song10.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Hellhounds',
        'cover' => "http://localhost/facebook/assets/images/songs_images/king810.jpg",
        'artist' => 'King 810',
        'src' => 'http://localhost/facebook/assets/songs/song11.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => ' Love, Hate, Love',
        'cover' => "http://localhost/facebook/assets/images/songs_images/alice.jpg",
        'artist' => 'Alice in chains',
        'src' => 'http://localhost/facebook/assets/songs/song12.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Blind',
        'cover' => "http://localhost/facebook/assets/images/songs_images/korn.jpg",
        'artist' => 'Korn',
        'src' => 'http://localhost/facebook/assets/songs/song13.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Falling Away from Me ',
        'cover' => "http://localhost/facebook/assets/images/songs_images/korn1.jpg",
        'artist' => 'Korn',
        'src' => 'http://localhost/facebook/assets/songs/song14.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Return Of The Tres',
        'cover' => "http://localhost/facebook/assets/images/songs_images/djog.jpg",
        'artist' => 'Delinquent Habits',
        'src' => 'http://localhost/facebook/assets/songs/song15.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Somewhere Only We Know',
        'cover' => "http://localhost/facebook/assets/images/songs_images/keane.jpg",
        'artist' => 'Keane',
        'src' => 'http://localhost/facebook/assets/songs/song18.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Music Sounds Better With You',
        'cover' => "http://localhost/facebook/assets/images/songs_images/stardust.jpg",
        'artist' => 'Stardust ',
        'src' => 'http://localhost/facebook/assets/songs/song16.mp3',
        'lyrics' =>
        "
        "
    ),
    array(
        'name' => 'Habatl El Sagayer',
        'cover' => "http://localhost/facebook/assets/images/songs_images/shaaban.jpg",
        'artist' => 'Shaban Abd El Rehim ',
        'src' => 'http://localhost/facebook/assets/songs/song17.mp3',
        'lyrics' =>
        "
        "
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
$results=[];
  $searchTerm = strtolower($_POST['music_search']);
  foreach ($songs as $song){
    if(strpos(strtolower($song['name']),$searchTerm)!== false || strpos(strtolower($song['artist']),$searchTerm)!== false){
      array_push($results,$song);
    }
  }
  foreach ($results as $song){
    ?>
<div class="song_item" data-src="<?php echo $song['src'] ?>" data-lyrics="<?php echo $song['lyrics'] ?>"
    data-cover="<?php echo $song['cover'] ?>" data-name="<?php echo $song['name'] ?>"
    data-artist="<?php echo $song['artist'] ?>">
    <img src="<?php echo $song['cover']?>" alt="">
    <div class="music_col">
        <span> <?php echo substr($song['name'],0,30) ?></span>
        <span><?php echo $song['artist'] ?></span>
    </div>

</div>
<?php
}
 
}