<?php
define('SMART_PHONE', 36);

function products_filter($catId, $products)
{
    $rs = array();
    foreach ($products as $value) {
        if ($value->category->parent_id == $catId)
            $rs[] = $value;
    }
    return $rs;
}
