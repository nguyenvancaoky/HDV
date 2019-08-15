<?php

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