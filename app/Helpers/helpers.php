<?php

if (! function_exists('get_public_path')) {
    function get_public_path()
    {
        return config('app.public_path');
    }
}


if(!function_exists('extract_to_decimal')){
    function extract_to_decimal($input=NULL){
        if($input == NULL){
            return 0;
        }
        // Gunakan preg_replace untuk:
        // 1. Hapus semua titik sebagai separator ribuan
        // 2. Ganti koma (,) dengan titik (.)
        $pattern = ['/\./', '/,/'];
        $replacement = ['', '.'];
        return preg_replace($pattern, $replacement, $input);

    }
}