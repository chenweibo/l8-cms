<?php

/**
 * 一维数据数组生成数据树.
 * @param array $list 数据列表
 * @param string $id 父ID Key
 * @param string $pid ID Key
 * @param string $son 定义子数据Key
 * @return array
 */
function arr2tree($list, $id = 'id', $pid = 'pid', $son = 'sub')
{
    list($tree, $map) = [[], []];
    foreach ($list as $item) {
        $map[$item[$id]] = $item;
    }

    foreach ($list as $item) {
        if (isset($item[$pid]) && isset($map[$item[$pid]])) {
            $map[$item[$pid]][$son][] = &$map[$item[$id]];
        } else {
            $tree[] = &$map[$item[$id]];
        }
    }
    unset($map);

    return $tree;
}

function modifyEnv(array $data)
{
    $envPath = base_path().DIRECTORY_SEPARATOR.'.env';

    $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));

    $contentArray->transform(function ($item) use ($data) {
        foreach ($data as $key => $value) {
            if (str_contains($item, $key)) {
                return $key.'='.$value;
            }
        }

        return $item;
    });

    $content = implode($contentArray->toArray(), "\n");

    \File::put($envPath, $content);
}

function handleType($type)
{
    $list = [''];
}

function second_array_unique_bykey($arr, $key)
{
    $tmp_arr = [];
    foreach ($arr as $k => $v) {
        if (in_array($v[$key], $tmp_arr)) {   //搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
            unset($arr[$k]); //销毁一个变量  如果$tmp_arr中已存在相同的值就删除该值
        } else {
            $tmp_arr[$k] = $v[$key];  //将不同的值放在该数组中保存
        }
    }
    //ksort($arr); //ksort函数对数组进行排序(保留原键值key)  sort为不保留key值
    return $arr;
}

/*
    * 根据二维数组某个字段的值查找数组
   */
function filter_by_value($array, $index, $value)
{
    $newarray = [];
    if (is_array($array) && count($array) > 0) {
        foreach (array_keys($array) as $key) {
            $temp[$key] = $array[$key][$index];

            if ($temp[$key] == $value) {
                $newarray[$key] = $array[$key];
            }
        }
    }
    if (count($newarray) > 1) {
        return $newarray[0];
    }

    return $newarray;
}

function handleMigrateComponent($component, $v)
{

    //dd($component,$v);
    $c = [];

    foreach ($component as &$value) {
        $arr = filter_by_value($v, 'column', $value['column']);
        // dd($component,$v,$arr,!empty($arr));

        //dd($arr);
        if (! empty($arr)) {
            //dd($component,$v,$arr[0]);
            $value['note'] = $arr[0]['note'];
            $value['value'] = $arr[0]['value'];
        }
    }
    unset($value);

    return $component;
}
