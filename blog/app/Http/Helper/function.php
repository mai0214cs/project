<?php

// php composer dump-autoload
function stripUnicode($str) {
    $string = trim($str);
    if (!$string) {
        return FALSE;
    }
    $unicode = 'ä|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|Ä|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|';
    $strings = 'a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|';
    $unicode .= 'ç|Ç|';
    $strings .= 'c|c|';
    $unicode .= 'è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|';
    $strings .= 'e|e|e|e|e|e|e|e|e|e|e|e|e|e|e|e|e|e|e|e|e|e|';
    $unicode .= 'ì|í|î|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|';
    $strings .= 'i|i|i|i|i|i|i|i|i|i|i|';
    $unicode .= 'ö|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ö|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|';
    $strings .= 'o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|';
    $unicode .= 'ü|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ü|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|';
    $strings .= 'u|u|u|u|u|u|u|u|u|u|u|u|u|u|u|u|u|u|u|u|u|u|u|u|';
    $unicode .= 'ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ|';
    $strings .= 'y|y|y|y|y|y|y|y|y|y|';
    $unicode .= 'đ|Đ|';
    $strings .= 'd|d|';
    $unicode .= ' |-|';
    $strings .= '-|-|';
    $unicode .= 'q|w|e|r|t|y|u|i|o|p|a|s|d|f|g|h|j|k|l|z|x|c|v|b|n|m|Q|W|E|R|T|Y|U|I|O|P|A|S|D|F|G|H|J|K|L|Z|X|C|V|B|N|M';
    $strings .= 'q|w|e|r|t|y|u|i|o|p|a|s|d|f|g|h|j|k|l|z|x|c|v|b|n|m|q|w|e|r|t|y|u|i|o|p|a|s|d|f|g|h|j|k|l|z|x|c|v|b|n|m';
    $strings_arr = explode('|', $strings);
    $unicode_arr = explode('|', $unicode);
    $tests = array();
    $result = '';
    foreach ($unicode_arr as $key => $value) {
        $tests[$value] = $strings_arr[$key];
    }
    for ($i = 0; $i < strlen($string); $i++) {
        if (isset($tests[$string[$i]])) {
            $result .= $tests[$string[$i]];
        }
    }
    return $result;
}

function information($status, $message) {
    return array('status' => $status, 'message' => trans($message));
}

function imageReset($url) {
    return is_file(trim($url, '/')) ? $url : '/image.png';
}

function GetPagination($current, $total, $limitcount) {
    if ($total <= 1) {
        return;
    } $middle = ceil($limitcount / 2);
    $result = '';
    // Get begin
    $begin = ($current - $middle <= 1) ? 1 : $current - $middle;
    $end = ($begin + $limitcount >= $total) ? $total : $begin + $limitcount;
    if ($current > 1) {
        $result.='<li><a onclick="SelectPageShow(1)" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
    }
    for ($i = $begin; $i <= $end; $i++) {
        $result .= '<li ' . ($current == $i ? 'class="active"' : '') . '><a onclick="SelectPageShow(' . $i . ')">' . $i . '</a></li>';
    }
    if ($current < $total) {
        $result.='<li><a onclick="SelectPageShow(' . $total . ')" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
    }
    return '<nav><ul class="pagination">' . $result . '</ul></nav>';
}

function GetPageCount() {
    $rs = '<select class="form-control" onchange="GetPageCount()">';
    foreach (config('app.listperpage') as $value) {
        $rs .= '<option value="'.$value.'">'.$value.'</option>';
    }
    $rs .= '</select>';
    return $rs;
}
