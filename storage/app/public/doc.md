## 调用文档

### 基本设置

```blade
$system['字段值'];

dd($system) //可页面上打印查看标签值。

```
> 字段名称可打印函数查看，或者后台模块查看（ **标题包含字段名** ）

### 幻灯片设置
```blade
  banner($id)  // $id为后台幻灯片id 
```
> 例子：页面渲染后台id为1的幻灯片组。
```blade
@foreach(banner(1) as $v)

{{$v["banner_title"]}}
{{$v["banner_url"]}}
{{$v["banner_m_url"]}}
{{$v["banner_link"]}}
{{$v["banner_c_t"]}}
... 

@endforeach
```


### 快捷命令行

#### 创建管理员

> 提示：此处终端命令行默认已经配置了php环境变量。

```shell
 php artisan create:admin
```
