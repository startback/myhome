<?php
/*****************    公用函数    *****************/


/*
 * 保存文件(图片，音频)
 * $file 上传文件集
 * $path 保存路径
 */
function com_save_file($file,$path='/Upload/test'){
	$com_path = str_replace('\\App\\Myadmin\\Common','',str_replace('/App/Myadmin/Common','',__DIR__));
    $make_path = $com_path.$path;

    $images = array();
    $img_types = array('jpg','jpeg','bmp','gif','png');
    $audio_types = array('mp3','wav','mp4');
    if(!file_exists($make_path)) mkdir($make_path,0777,true);

    //多张图片
    if($file['image']){
        $num = count($file['image']['name']);
        for($i=0;$i<$num;$i++){
            if($file['image']['name'][$i]) {
                $names = explode('.', $file['image']['name'][$i]);
                $type = strtolower(end($names));
                if ($file['image']['size'][$i] <= 1024 * 1024 * 2 && in_array($type, $img_types)) {
                    $content = file_get_contents($file['image']['tmp_name'][$i]);
                    $new_name = strtolower(md5($content));
                    $origin_name = $path . '/' . $new_name . '.' . $type;
                    $save_path = $com_path . $origin_name;
                    move_uploaded_file($file['image']['tmp_name'][$i], $save_path);
                    $images[$i] = $origin_name;
                }
            }
        }
    }

    //语音
    if($file['audio']){
        $names = explode('.',$file['audio']['name']);
        $type = strtolower(end($names));
        if($file['audio']['size'] <= 1024*1024*2 && in_array($type,$audio_types)){
            $content = file_get_contents($file['audio']['tmp_name']);
            $new_name = strtolower(md5($content));
            $origin_name = $path.'/'.$new_name.'.'.$type;
            $save_path = $com_path.$origin_name;
            move_uploaded_file($file['audio']['tmp_name'],$save_path);
            $images['audio'] = $origin_name;
        }
    }

    return $images;
}


/*
 * 生成缩略图
 * $img_url  原图路径
 * $path     缩略图保存目录
 */
function com_make_thumb($img_url,$path='Upload/thumb',$width=180,$height=180){
	$com_path = str_replace('\\App\\Myadmin\\Common','',str_replace('/App/Myadmin/Common','',__DIR__));
    $make_path = $com_path.$path;
    if(!file_exists($make_path)) mkdir($make_path,0777,true);

    $image = new \Think\Image();
    $name = explode('/',$img_url);
    $names = explode('.',end($name));
    $new_name = $names[0].'_thumb.'.end($names);
    $thumb_name = $path.'/'.$new_name;
    $save_path = $com_path.$thumb_name;
    $image->open($com_path.$img_url);
    $image->thumb($width, $height)->save($save_path);

    return $thumb_name;
}














