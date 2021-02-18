<?php

function uploadFile($file_info, $allow_ext = array('jpeg', 'jpg', 'gif', 'png'), $maxSize = 4194304, $flag = true, $uploadPath = 'img/upload') {
    // 存放錯誤訊息
    $err_msg = '';
 
    // 取得上傳檔案的擴展名
    $ext = pathinfo($file_info['name'], PATHINFO_EXTENSION);
    $ext = strtolower($ext);
 
    // 確保檔案名稱唯一，防止重覆名稱產生覆蓋
    $uni_name = md5(uniqid(microtime(true), true)) . '.' . $ext;
    $dest = $uploadPath . '/' . $uni_name;
     
    // 判斷是否有錯誤
    if ($file_info['error'] > 0) {
        // 匹配的錯誤代碼
        switch ($file_info['error']) {
            case 1:
                $err_msg = '上傳的檔案超過了 php.ini 中 upload_max_filesize 允許上傳檔案容量的最大值';
                break;
            case 2:
                $err_msg = '上傳檔案的大小超過了 HTML 表單中 MAX_FILE_SIZE 選項指定的值';
                break;
            case 3:
                $err_msg = '檔案只有部分被上傳';
                break;
            case 4:
                $err_msg = '沒有檔案被上傳（沒有選擇上傳檔案就送出表單）';
                break;
            case 6:
                $err_msg = '找不到臨時目錄';
                break;
            case 7:
                $err_msg = '檔案寫入失敗';
                break;
            case 8:
                $err_msg = '上傳的文件被 PHP 擴展程式中斷';
                break;
        }
 
        exit($err_msg);
    }
 
    // 檢查檔案是否是通過 HTTP POST 上傳的
    if (!is_uploaded_file($file_info['tmp_name']))
        exit('檔案不是通過 HTTP POST 方式上傳的');
     
    // 檢查上傳檔案是否為允許的擴展名
    if (!is_array($allow_ext))  // 判斷參數是否為陣列
        exit('檔案類型型態必須為 array');
    else {
        if (!in_array($ext, $allow_ext))  // 檢查陣列中是否有允許的擴展名
            exit('非法檔案類型');
    }
 
    // 檢查上傳檔案的容量大小是否符合規範
    if ($file_info['size'] > $maxSize)
        exit('上傳檔案容量超過限制');
 
    // 檢查是否為真實的圖片類型
    if ($flag && !@getimagesize($file_info['tmp_name']))
        exit('不是真正的圖片類型');
 
    // 檢查指定目錄是否存在，不存在就建立目錄
    if (!file_exists($uploadPath))
        mkdir($uploadPath, 0777, true);  // 建立目錄
     
    // 將檔案從臨時目錄移至指定目錄
    if (!@move_uploaded_file($file_info['tmp_name'], $dest))  // 如果移動檔案失敗
        exit('檔案移動失敗');
 
    return array($dest, $uni_name);
}