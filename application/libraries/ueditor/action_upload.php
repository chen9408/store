<?php
include "Uploader.class.php";

/* 上传配置 */
$base64 = "upload";
switch (htmlspecialchars($_GET['action'])) {
    case 'uploadimage':
        $fieldName = $config['imageFieldName'];
        $file_config = array(
            "pathFormat" => $config['imagePathFormat'],
            "maxSize" => $config['imageMaxSize'],
            "allowFiles" => $config['imageAllowFiles']
        );
        break;
    case 'uploadscrawl':
        $fieldName = $config['scrawlFieldName'];
        $base64 = "base64";
        $file_config = array(
            "pathFormat" => $config['scrawlPathFormat'],
            "maxSize" => $config['scrawlMaxSize'],
            "allowFiles" => $config['scrawlAllowFiles'],
            "oriName" => "scrawl.png"
        );
        break;
    case 'uploadvideo':
        $fieldName = $config['videoFieldName'];
        $file_config = array(
            "pathFormat" => $config['videoPathFormat'],
            "maxSize" => $config['videoMaxSize'],
            "allowFiles" => $config['videoAllowFiles']
        );
        break;
    case 'uploadfile':
    default:
        $fieldName = $config['fileFieldName'];
        $file_config = array(
            "pathFormat" => $config['filePathFormat'],
            "maxSize" => $config['fileMaxSize'],
            "allowFiles" => $config['fileAllowFiles']
        );
        break;
}

/* 生成上传实例对象并完成上传 */
$up = new Uploader($fieldName, $file_config, $base64);

/**
 * 得到上传文件所对应的各个参数,数组结构
 * array(
 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
 *     "url" => "",            //返回的地址
 *     "title" => "",          //新文件名
 *     "original" => "",       //原始文件名
 *     "type" => ""            //文件类型
 *     "size" => "",           //文件大小
 * )
 */

/* 返回数据 */
return json_encode($up->getFileInfo());
