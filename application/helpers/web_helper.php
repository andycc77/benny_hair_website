<?php
function script($name){
    return '<script type="text/javascript" src="'.base_url('public/js/'.$name).'"></script>' . "\n";
}

function css($name){
    return '<link href="'.base_url('public/css/'.$name).'" rel="stylesheet" type="text/css">' . "\n";
}

?>