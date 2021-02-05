<?php

function isAllowedUpload($ext) {
    $all = array('jpg','jpeg','bmp','gif','png','jpeg-large','tif','tiff','doc','docx','xls','xlsx','pdf','odt','ppt','pptx','txt','zip','rar','csv','tar','gz','7z','mp4','mkv');
    return in_array(strtolower($ext),$all);
}
function randSeed($min, $max, $seed) {
    return round($min + (hexdec(md5($seed)) / hexdec("FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF")) * ($max - $min));
}
