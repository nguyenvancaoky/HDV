<?php

      $zip = new ZipArchive;
      $res = $zip->open('./zip/2064213395.zip');
      echo $res;
      if ($res === TRUE) {
        $zip->extractTo('./unzip');
        $zip->close();
      } else {
        echo 'Lỗi giải nén....';
      }