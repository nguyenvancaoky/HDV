<?php
function write_progress( $ch, $original_size, $current_size, $os_up, $cs_up ) {
    global $download_start_time;
    //Get the current time.
    $now = microtime( true );
    //Remember the start time.
    if ( ! $download_start_time ) {
        $download_start_time = $now;
    }
    //Check if the download size is available yet.
    if ( $original_size ) {
        //Compute time spent transfering.
        $transfer_time = $now - $download_start_time;
        //Compute percent already downloaded.
        $transfer_percentage = $current_size / $original_size;
        //Compute estimated transfer time.
        if ($transfer_percentage == 0) {
          $transfer_percentage = 1;
        }
        $estimated_tranfer_time = $transfer_time / $transfer_percentage;
        //Compute estimated time remaining.
        $estimated_time_remaining = $estimated_tranfer_time - $transfer_time;
        //Output the remaining time.

        $Curl_info = array(
            'current_size' => formatSizeUnits($current_size),
            'estimated_time_remaining' => $estimated_time_remaining
        );
        echo '<script language="javascript">
        document.getElementById("progress").innerHTML="<div style=\"width:'.number_format($transfer_percentage*100,2).'%;background-color:#ddd;\">&nbsp;</div>";
        document.getElementById("size").innerHTML="'.$Curl_info['current_size'].' ";
        </script>';
        flush_all();
    }
}

function flush_all() {
    while ( ob_get_level() ) {
        ob_end_flush();
    }
    flush();
}
function formatSizeUnits($bytes) {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

function get_download($data){
        $url = 'http://steamworkshop.download/online/steamonline.php';
        $get_download = curl_init();
        curl_setopt($get_download, CURLOPT_URL, $url );
        curl_setopt($get_download, CURLOPT_TIMEOUT, 40000);
        curl_setopt($get_download, CURLOPT_HEADER, 0);
        curl_setopt($get_download, CURLOPT_VERBOSE,1);
        curl_setopt($get_download, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
        curl_setopt($get_download, CURLOPT_REFERER,'http://www.google.com');  //any fake referer
        curl_setopt($get_download, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($get_download, CURLOPT_CAINFO, '/cacert.pem');
        curl_setopt($get_download, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($get_download, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($get_download, CURLOPT_POST,1);
        curl_setopt($get_download, CURLOPT_FOLLOWLOCATION, 20);
        curl_setopt($get_download, CURLOPT_POSTFIELDS, $data);
        ob_start();
        return curl_exec ($get_download);
        ob_end_clean();
        curl_close ($get_download);
        unset($get_download);
}
function imgur($file,$title){
        $url = 'https://api.imgur.com/3/upload';
        $token = 'a77fecbd4692c8e2c59d7b19bc792554d03737dd';

        $handle = fopen($file, 'r');
        $data = fread($handle, filesize($file));
        $pvars = array(
          'image' => base64_encode($data),
          'album' => 'FnekuFz',
          'title' => $title,
          'description' => date("Y/m/d")
        );

        $get_download = curl_init();
        curl_setopt($get_download, CURLOPT_URL, $url );
        curl_setopt($get_download, CURLOPT_TIMEOUT, 40000);
        $headers = [
          "Authorization: Bearer ".$token,
          "Content-Type: multipart/form-data"
        ];
        curl_setopt($get_download, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($get_download, CURLOPT_VERBOSE,1);
        curl_setopt($get_download, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
        curl_setopt($get_download, CURLOPT_REFERER,'http://www.google.com');  //any fake referer
        curl_setopt($get_download, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($get_download, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($get_download, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($get_download, CURLOPT_POST,1);
        curl_setopt($get_download, CURLOPT_FOLLOWLOCATION, 20);
        curl_setopt($get_download, CURLOPT_POSTFIELDS, $pvars);
        ob_start();
        return curl_exec ($get_download);
        ob_end_clean();
        curl_close ($get_download);
        unset($get_download);
}

function post_blog($data){
  $token = json_encode($_SESSION['access_token']);
	$token = json_decode($token,true);
	$token = $token['access_token'];

  $url = 'https://www.googleapis.com/blogger/v3/blogs/2283371075141066583/posts';
  $get_download = curl_init();
  curl_setopt($get_download, CURLOPT_URL, $url );
  curl_setopt($get_download, CURLOPT_TIMEOUT, 40000);
  $headers = [
    "Authorization: Bearer ".$token,
    "Content-Type: application/json"
  ];
  curl_setopt($get_download, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($get_download, CURLOPT_VERBOSE,1);
  curl_setopt($get_download, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
  curl_setopt($get_download, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($get_download, CURLOPT_POST,1);
  curl_setopt($get_download, CURLOPT_FOLLOWLOCATION, 20);
  curl_setopt($get_download, CURLOPT_POSTFIELDS, $data);
  ob_start();
  return curl_exec ($get_download);
  ob_end_clean();
  curl_close ($get_download);
  unset($get_download);
}
function s_link($link,$title){
	$token = 'b8bd772eef346f9e7e898728efbaac6853e44e5c';
  $data = '{
    "long_url": "'.$link.'",
    "title": "'.$title.'"
  }';
  $url = 'https://api-ssl.bitly.com/v4/bitlinks';
  $get_download = curl_init();
  curl_setopt($get_download, CURLOPT_URL, $url );
  curl_setopt($get_download, CURLOPT_TIMEOUT, 40000);
  $headers = [
    "Authorization: Bearer ".$token,
    "Content-Type: application/json"
  ];
  curl_setopt($get_download, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($get_download, CURLOPT_VERBOSE,1);
  curl_setopt($get_download, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
  curl_setopt($get_download, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($get_download, CURLOPT_POST,1);
  curl_setopt($get_download, CURLOPT_FOLLOWLOCATION, 20);
  curl_setopt($get_download, CURLOPT_POSTFIELDS, $data);
  ob_start();
  return curl_exec ($get_download);
  ob_end_clean();
  curl_close ($get_download);
  unset($get_download);
}
function update_blog($data,$id){
  sleep(1);
  $token = json_encode($_SESSION['access_token']);
	$token = json_decode($token,true);
	$token = $token['access_token'];

  $url = 'https://www.googleapis.com/blogger/v3/blogs/2283371075141066583/posts/'.$id.'?publish=true';

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer ".$token,
      "Content-Type: application/json"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return "cURL Error #:" . $err;
  } else {
    return $response;
  }
}

function Check_post($id)
{
  $result = json_decode(search_id($id),1);
  if (isset($result['items']) && $result['items']) {
    return $result['items'][0];
  } else {
    return 0;
  }
}

function search_id($id){
    $url = 'https://www.googleapis.com/blogger/v3/blogs/2283371075141066583/posts/search?q='.$id.'&fetchBodies=true&orderBy=published';
    $token = json_encode($_SESSION['access_token']);
    $token = json_decode($token,true);
    $token = $token['access_token'];
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Accept: */*",
        "Accept-Encoding: gzip, deflate",
        "Authorization: Bearer ".$token,
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Host: www.googleapis.com",
        "User-Agent: PostmanRuntime/7.15.2",
        "cache-control: no-cache"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return "cURL Error #:" . $err;
    } else {
      return $response;
    }
}

function grab_url($site){
    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $site );
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE,1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
        curl_setopt($ch, CURLOPT_REFERER,'http://www.google.com');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 20);
    ob_start();
    return curl_exec ($ch);
    ob_end_clean();
    curl_close ($ch);
}
function get_absolute_path($path) {
    $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
    $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
    $absolutes = array();
    foreach ($parts as $part) {
        if ('.' == $part) continue;
        if ('..' == $part) {
            array_pop($absolutes);
        } else {
            $absolutes[] = $part;
        }
    }
    return implode(DIRECTORY_SEPARATOR, $absolutes);
}

function Get_info($id){

  echo '<script language="javascript">
  document.getElementById("title").innerHTML="Loading...";
  document.getElementById("type").innerHTML="Loading...";
  document.getElementById("rating").innerHTML="Loading...";
  document.getElementById("genre").innerHTML="Loading...";
  document.getElementById("resolution").innerHTML="Loading...";
  document.getElementById("category").innerHTML="Loading...";
  document.getElementById("file_size").innerHTML="Loading...";
  document.getElementById("download_link").innerHTML="Loading...";
  function ShowEnlargedImagePreview(url) {
    return "<img src='.htmlspecialchars("'").'"+ url +"'.htmlspecialchars("'").'></img>";
  }
  </script>';
  flush_all();
  sleep(2);
  $data = grab_url('https://steamcommunity.com/sharedfiles/filedetails/?id='.$id);
  $data = str_get_html($data);
  $col_right = $data->find('div.col_right',0);
  $col_right = str_get_html($col_right);
  $workshopTags = $col_right->find('div.workshopTags');
  $file_size = $col_right->find('div.detailsStatRight',0)->plaintext;
  $title = $data->find('div.workshopItemTitle',0)->plaintext;
  $image = $data->find('a[onclick*=ShowEnlargedImagePreview]',0)->onclick;
  $image_url = str_replace("ShowEnlargedImagePreview( '", '', $image) ;
  $image_url = str_replace("' );", '', $image_url) ;

  foreach($workshopTags as $element){
    if (strpos($element->plaintext, 'Type:&nbsp;') !== false) {
        $type = str_replace('Type:&nbsp; ','',$element->plaintext);
    } elseif (strpos($element->plaintext, 'Rating:&nbsp;') !== false) {
        $rating = str_replace('Rating:&nbsp; ','',$element->plaintext);
    } elseif (strpos($element->plaintext, 'Genre:&nbsp;') !== false) {
        $genre = str_replace('Genre:&nbsp; ','',$element->plaintext);
    } elseif (strpos($element->plaintext, 'Resolution:&nbsp;') !== false) {
        $resolution = str_replace('Resolution:&nbsp; ','',$element->plaintext);
    } elseif (strpos($element->plaintext, 'Category:&nbsp;') !== false) {
        $category = str_replace('Category:&nbsp; ','',$element->plaintext);
    }
  }

  echo '<script language="javascript">
  document.getElementById("title").innerHTML="'.$title.'";
  document.getElementById("type").innerHTML="'.$type.'";
  document.getElementById("rating").innerHTML="'.$rating.'";
  document.getElementById("genre").innerHTML="'.$genre.'";
  document.getElementById("resolution").innerHTML="'.$resolution.'";
  document.getElementById("category").innerHTML="'.$category.'";
  document.getElementById("file_size").innerHTML="'.$file_size.'";
  document.getElementById("download_link").innerHTML="Loading...";
  document.getElementById("img").innerHTML='.$image.'
  </script>';

  flush_all();

  $check = 0;


  if (!$check) {
    $url = null;
    $sleept = 0;
    while (!$url) {
      $send_get = grab_url('http://steamworkshop.download/download/view/'.$id);
      $get_download = get_download('item='.$id.'&app=431960');
      $html = str_get_html($get_download);
      $url = $html->find('a',0);
      $url = $url->href;
      if (!$url) {
        $sleept = $sleept+4;
        if ($sleept > 30) {
          $url = 400;
        }
        sleep(4);
      }
    }
  } else {
    $url = $check['titleLink'];
  }

if ($url != 400) {

  echo '<script language="javascript">
  document.getElementById("download_link").innerHTML="'.$url.'";
  </script>';
  flush_all();

  $title = str_replace("'","&apos;",$title);

  $info = array(
    'title' => $title,
    'image_default' => $image_url.'?imw=450&impolicy=Letterbox',
    'image_auto' => null,
    'type' => $type,
    'rating' => $rating,
    'genre' => explode(", ",$genre),
    'resolution' => $resolution,
    'category' => $category,
    'file_size' => $file_size,
    'download' => $url,
    'download_backup' => 'https://ani-vn.tech/ajax/hdv.php?item='.$id

  );




  $labels = [$info['type'],$info['rating'],$info['category']];
  foreach ($info['genre'] as $value) {
    $labels[] = $value;
  }



  if (!$check) {
    if (strpos($info['type'], 'Video') !== false) {

      if (!(file_exists('./zip/'.$id.'.zip'))) {
        $file = fopen('./zip/'.$id.'.zip', "w+");
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $info['download'] );
        curl_setopt( $ch, CURLOPT_FILE, $file );
        curl_setopt( $ch, CURLOPT_NOPROGRESS, false );
        curl_setopt( $ch, CURLOPT_PROGRESSFUNCTION, 'write_progress' );
        $data_dl = curl_exec( $ch );

        echo '<script language="javascript">
        document.getElementById("size").innerHTML="Đang giải nén....";
        </script>';
        flush_all();
      }

      $directory = str_replace('\lib','',__DIR__)."/unzip/".$id."/";

      if (!(file_exists('./unzip/'.$id.'/out.gif'))) {
      $zip = new ZipArchive;
      $res = $zip->open('./zip/'.$id.'.zip');
      if ($res === TRUE) {
        $zip->extractTo('./unzip');
        $zip->close();
      } else {
        echo 'Lỗi giải nén....';
      }
      echo '<script language="javascript">
      document.getElementById("size").innerHTML="Đang tạo file Gif....";
      </script>';
      flush_all();
      $file = glob($directory . "*.mp4");
      $mp4_to_gif = exec('ffmpeg -y -ss 2 -t 3.5 -i "'.$file[0].'" -vf fps=10,scale=640:-1:flags=lanczos,palettegen "'.realpath($directory).'\palette.png"');
      sleep(2);
      $mp4_to_gif = exec('ffmpeg -ss 2 -t 3.5 -i "'.$file[0].'" -i "'.realpath($directory).'\palette.png" -filter_complex "fps=10,scale=640:-1:flags=lanczos[x];[x][1:v]paletteuse" "'.realpath($directory).'\out.gif"');
      $text = "";
      $get_video_info = (float) shell_exec('ffprobe -i "'.$file[0].'" -show_entries format=duration -v quiet -of csv="p=0"');
      $loop_time = 350/$get_video_info;
      $video_dir_name = pathinfo($file[0], PATHINFO_DIRNAME);
      $video_extension = pathinfo($file[0], PATHINFO_EXTENSION);
      if ($loop_time > 2) {
        for ($i=0; $i < (int) $loop_time; $i++) { 
          $text .= "file 'upload.".$video_extension."'\n";
        }
        file_put_contents(realpath($directory).'\list.txt', $text);
        file_put_contents(realpath($directory).'\start.bat', 'ffmpeg -f concat -i list.txt -c copy output.mp4');
        rename($file[0], $video_dir_name.'\upload.'.$video_extension);
      }
      }

      echo '<script language="javascript">
      document.getElementById("size").innerHTML="Tải lên Imgur....";
      </script>';
      flush_all();
      $imgur = imgur($directory.'/out.gif',$info['title']);
      // echo $imgur;
      $imgur_data = json_decode($imgur,1);
      echo $imgur_data['data']['link'];
      $info['image_auto'] = $imgur_data['data']['link'];
      echo '<script language="javascript">
	  document.getElementById("img").innerHTML=ShowEnlargedImagePreview("'.$info['image_auto'].'");
	  </script>';
	  flush_all();
    }
  // $short_link = json_decode(s_link($info['download'],$info['title']),1);
  // $info['download'] = $short_link['link'].'?id='.$id;
  $info['download'] = '/p/download.html?t='.base64_encode($info['download']).'&id='.$id;

  if (strpos($info['type'], 'Video') !== false) {
  $mp4 = '<img style="max-width: 640px;" src="'.$imgur_data['data']['link'].'" />';
  } else {
  $mp4 = '<img style="max-width: 640px;" src="'.$info['image_default'].'" />';
  }



  $html_lb = '';
  foreach ($info['genre'] as $key_lb => $value_lb) {
    if ($key_lb == 0) {
      if (count($info['genre']) == 1) {
        $lb_s = '';
      } else {
        $lb_s = ',';
      }
    } else {
      $lb_s = ',';
    }
    if ($key_lb == (count($info['genre'])-1)){
      $lb_s = '';
    }
    $html_lb .=  '<a href="/search/label/'.$value_lb.'">'.$value_lb.'</a>'.$lb_s;
  }

  $content = '
  <h2 style="text-align: center;">
  <b><span style="font-size: large;">Download <i>'.$info['title'].'</i> Wallpaper Engine Free and get all of the wallpaper engine best wallpapers + the latest version of wallpaper engine software non-steam required.</span></b></h2>
  <div>
  <ul>
  <li>[col]</li>
  <ul>
  <li>[<b><span style="color: #369fcf;">'.$info['title'].'</span></b>] is one of <a href="/" target="_blank">wallpaper engine best wallpapers</a> available on <a href="/p/wallpaper-engine-workshop.html" target="_blank">steam wallpaper engine Workshop</a> to make your computer desktop go live giving you an outstanding experience while using PC.</li>
  <li>You can easily use it once you download it from our site (absolutely free), This <a href="/" target="_blank">wallpaper engine free wallpaper</a> can be the best alternative for your windows desktop images. Browse our site so you can download thousands of <b>wallpaper engine free wallpapers</b> ready to be on your desktop.</li>
  </ul>
  </ul>
  <div class="separator" style="clear: both; text-align: center;">
  '.$mp4.'
  </div>
  <br />
  <br />
  <ul>
  <li>[tab]</li>
  <ul>
  <li>FAQ</li>
  <ul>
  <li>Frequently Asked Questions</li>
  </ul>
  <li>What is Wallpaper Engine?</li>
  <ul>
  <li>Wallpaper Engine Software allows you to use amazing live wallpapers on your computer desktop. You can choose from our site wallpaper engine best wallpapers that you like and easily make your desktop go live using this amazing software. Read: <a href="/p/what-is-wallpaper-engine.html" target="_blank">What is Wallpaper Engine? The Complete Guide.</a></li>
  </ul>
  <li>What Types of Wallpapers Supported?</li>
  <ul>
  <li>Several types of wallpaper engine wallpapers are supported and ready to use, Including 3D and 2D animations, websites, videos and even some applications.</li>
  </ul>
  <li>About Performance</li>
  <ul>
  <li>Wallpaper Engine was delicately built to deliver you an entertaining experience while using the minimum system resources as possible. Multiple options available inside the software to adjust the quality and performance to make Wallpaper Engine fully compatible with your computer capacities.</li>
  </ul>
  </ul>
  </ul>
  <br />
  <br /></div>
  <div class="separator" style="clear: both; text-align: center;">
  <iframe allow="autoplay; encrypted-media" allowfullscreen="" frameborder="0" height="315" src="https://www.youtube-nocookie.com/embed/lXop63VPO3w?rel=0&amp;showinfo=0" width="560"></iframe></div>
  <div style="height: 100px;">
  [post_ads]
  </div>
  <ul>
  <li>[message]</li>
  <ul>
  <li><span style="background-color: #48a7d2; color: white;">##info##&nbsp;DESCRIPTION</span></li>
  <ul>
  <li>
  <b>- TITLE: </b>'.$info['title'].'<br />
  <b>- TYPE: </b><a href="/search/label/'.$info['type'].'">'.$info['type'].'</a><br />
  <b>- RATING: </b><a href="/search/label/'.$info['rating'].'">'.$info['rating'].'</a><br />
  <b>- GENRE: </b>'.$html_lb.'<br />
  <b>- RESOLUTION: </b><a href="/search?q='.$info['resolution'].'">'.$info['resolution'].'</a><br />
  <b>- CATEGORY: </b><a href="/search/label/'.$info['category'].'">'.$info['category'].'</a><br />
  <b>- STEAM: </b><a href="https://steamcommunity.com/sharedfiles/filedetails/?id='.$id.'" target="_blank">https://steamcommunity.com/sharedfiles/filedetails/?id='.$id.'</a><br />
  <b>- FILE SIZE: </b>'.$info['file_size'].'</li>
  </ul>
  </ul>
  </ul>
  <br />
  <ul>
  <li>[message]</li>
  <ul>
  <li><span style="background-color: #4e92df; color: white;">##toggle-on## How To Use This Wallpaper</span></li>
  <ul>
  <li>1- Download The Latest and Updated Version Of Wallpaper Engine Software Free <br />
  2- Download this Wallpaper Engine theme. <br />
  3- Extract &amp; copy the downloaded file to this destination: <b>[Wallpaper Engine] &gt; Projects &gt; Default projects. </b><br />
  4- Need help? Read this <a href="/p/how-to-use-wallpaper-engine-on-your.html">Here.</a></li>
  </ul>
  </ul>
  </ul>
  <div style="height: 100px;">
  [post_ads_2]
  </div>
  <ul>
  <li>[accordion]</li>
  <ul>
  <li>##steam-square## STEAM LINK</li>
  <ul>
  <li><a href="https://steamcommunity.com/sharedfiles/filedetails/?id='.$id.'" target="_blank">[##steam-square##&nbsp;STEAM]</a></li>
  </ul>
  <li>##download## DOWNLOAD LINK</li>
  <ul>
  <li><a href="'.$info['download'].'" target="_blank">[##download## DOWNLOAD]</a></li>
  </ul>
  </ul>
  </ul>
  ';

  if (strpos($info['type'], 'Video') !== false) {
    $data_post = array(
      'title' => $info['title'],
      'content' => $content,
      'labels' => $labels
    );
  } else {
    $data_post = array(
      'title' => $info['title'],
      'content' => $content,
      'labels' => $labels
    );
  }



  echo '<script language="javascript">
  document.getElementById("size").innerHTML="Post to blogger ....";
  </script>';
  flush_all();

// print("<pre>".print_r($data_post,true)."</pre>");

  $result_data = post_blog(json_encode($data_post));
  $result = json_decode($result_data,1);
  print("<pre>".print_r($result_data,true)."</pre>");
  echo '<script language="javascript">
  document.getElementById("blogger").innerHTML="<a href=\"'.$result['url'].'\">'.$result['url'].'</a>";
  </script>';
  flush_all();
} else {
  echo '<script language="javascript">
  document.getElementById("blogger").innerHTML="<a href=\"'.$check['url'].'\">'.$check['url'].'</a>";
  </script>';
  flush_all();
}


  if (strpos($info['type'], 'Video') !== false) {
  // echo '<script language="javascript">
  // document.getElementById("img").innerHTML=ShowEnlargedImagePreview("unzip/'.$id.'/out.gif");
  // </script>';
  flush_all();
  }
} else {
  echo "Lỗi steam";
}

  return true;
}

function scan_Dir(){
    $dir = 'D:/SteamLibrary/steamapps/workshop/content/431960/';
   @$data = array_values(array_diff(scandir($dir), array('..', '.')));
    $data_count = count($data);
    $result = array();
    for ($i=0; $i < $data_count; $i++) {
            $info = json_decode(file_get_contents($dir.$data[$i].'/project.json'),true);

            $data_preview = $info['preview'];
			$type = substr($data_preview, strpos($data_preview, ".") + 1);


            if (!file_exists('./preview/'.$data[$i].'.'.$type)){
            $file_copy = $dir.$data[$i].'/preview.'.$type;
            $file_paste = './preview/'.$data[$i].'.'.$type;
            copy($file_copy, $file_paste);
            }
            $dataArray = array(
                'dir' => $data[$i],
                'preview' => $data[$i].'.'.$type,
                'info' => $info
             );
            $result = array_merge($result, array($dataArray));
        }
    return $result;
}
