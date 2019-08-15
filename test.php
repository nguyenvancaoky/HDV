<?php
include './lib/function.php';


$file[0] = 'E:\wamp64\www/unzip/1828466027/夏活希儿.mp4';

$mp4_to_gif = exec('ffmpeg -y -ss 4 -t 3.5 -i "'.$file[0].'" -vf fps=10,scale=720:-1:flags=lanczos,palettegen "E:\wamp64\www\unzip\1828466027\palette.png"');
sleep(2);
$mp4_to_gif = exec('ffmpeg -ss 4 -t 3.5 -i "'.$file[0].'" -i "E:\wamp64\www\unzip\1828466027\palette.png" -filter_complex "fps=10,scale=720:-1:flags=lanczos[x];[x][1:v]paletteuse" "E:\wamp64\www\unzip\1828466027\out.gif"');


echo $mp4_to_gif;
?>




<center>
  <video autoplay="" loop="" muted="" playsinline="">
    <source src="https://i.imgur.com/Cne7dw2.mp4" type="video/mp4">
    </source></video>
<iframe width="640" height="340" src="https://www.youtube.com/embed/A9ESjWHIMuU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</center>

<div class="card">
  <div class="card-header" id="headingOne">
    <h5 class="mb-0">
      <a href="https://draft.blogger.com/blogger.g?blogID=7826812665494882480#">DESCRIPTION</a></h5>
  </div>
  <div class=" card-body collapse show active" id="collapseOne">

    <b>Title:</b> [1080P+♪]夏雪铃兰-希儿[崩坏3]<br /><b>Type:</b> <a href="/search/label/Video">Video</a><br /><b>Rating:</b> <a href="/search/label/Everyone">Everyone</a><br /><b>Genre:</b> <a href="/search/label/Anime">Anime</a><br /><b>Resolution:</b> <a
      href="/search/label/Tag">1920 X 1080</a><br /><b>Category:</b> <a href="/search/label/Everyone">Wallpaper</a><br /><b>File Size:</b> 222 MB

  </div>
</div>
<div class="col-sm-12">
  <hr />
  <ul class="nav nav-pills mb-3" id="pills-tab">
    <li class="nav-item">
      <button class="nav-link active" id="pills-download" onclick="dl()">Download</button>
    </li>
    <li class="nav-item">
      <button class="nav-link" id="pills-wallpaper_engine" onclick="wallpaper_engine()">How To Use This Wallpaper </button>
    </li>
    <li class="nav-item">
      <button class="nav-link" id="pills-faq" onclick="faq()">What is Wallpaper Engine?</button>
    </li>
  </ul>
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0" id="card-title">
        <a href="https://draft.blogger.com/blogger.g?blogID=7826812665494882480#">Download</a></h5>
    </div>
    <div class=" card-body collapse active" id="download-content">
      <center>
        <a href="https://draft.blogger.com/blogger.g?blogID=7826812665494882480#"><button class="glow-on-hover" type="button">Download This Wallpaper</button></a>
      </center>
    </div>
    <div class=" card-body collapse" id="we-content">
      <h5>
        <b><br />
          1. Download The Latest and Updated Version Of <a href="https://wallpaperhdvs.blogspot.com/download">Wallpaper Engine Software</a> Free<br />
          2. Download this Wallpaper Engine theme.<br />
          3. Extract &amp; copy the downloaded file to this destination:<br />
          [Wallpaper Engine] &gt; Projects &gt; Default projects.<br />
          4. Need help? Read this <a href="https://wallpaperhdvs.blogspot.com/faq">Here.</a>
        </b>
      </h5>
    </div>
    <div class=" card-body collapse" id="faq-content">
      <h5>
        <b><br />
          Wallpaper Engine Software allows you to use amazing live wallpapers on your computer desktop. You can choose from our site wallpaper engine best wallpapers that you like and easily make your desktop go live using this amazing software.
          Read: <a href="https://wallpaperhdvs.blogspot.com/download" target="_blank">What is Wallpaper Engine? The Complete Guide.</a>
        </b>
      </h5>
    </div>
  </div>
</div>
