<?php

function haschild($data, $id)
{
    foreach ($data as $value) {
        if ($value['parent_id'] === $id) {
            return true;
        }
    }
    return false;
}
//dùng đệ quy để sắp xếp mảng đa cấp
function data_tree($data, $parent_id = 0, $level = 0)
{
    $result = array();
    foreach ($data as $value) {
        if ($value['parent_id'] == $parent_id) {
            $value['level'] = $level;
            $result[] = $value;
            if (haschild($data, $value['id'])) {
                $result_child = data_tree($data, $value['id'], $level + 1);
                $result = array_merge($result, $result_child);
            }
        }
    }
    return $result;
}
