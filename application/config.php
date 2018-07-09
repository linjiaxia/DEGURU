<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    // 应用调试模式
    'app_debug'              => true,
    // 应用Trace
    'app_trace'              => false,
    // 应用模式状态
    'app_status'             => '',
    // 是否支持多模块
    'app_multi_module'       => true,
    // 入口自动绑定模块
    'auto_bind_module'       => false,
    // 注册的根命名空间
    'root_namespace'         => [],
    // 扩展函数文件
    'extra_file_list'        => [THINK_PATH . 'helper' . EXT],
    // 默认输出类型
    'default_return_type'    => 'html',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
    // 默认JSONP格式返回的处理方法
    'default_jsonp_handler'  => 'jsonpReturn',
    // 默认JSONP处理方法
    'var_jsonp_handler'      => 'callback',
    // 默认时区
    'default_timezone'       => 'PRC',
    // 是否开启多语言
    'lang_switch_on'         => false,
    // 默认全局过滤方法 用逗号分隔多个
    'default_filter'         => 'htmlspecialchars,addslashes,trim',
    // 默认语言
    'default_lang'           => 'zh-cn',
    // 应用类库后缀
    'class_suffix'           => false,
    // 控制器类后缀
    'controller_suffix'      => false,

    // +----------------------------------------------------------------------
    // | 模块设置
    // +----------------------------------------------------------------------

    // 默认模块名
    'default_module'         => 'index',
    // 禁止访问模块
    'deny_module_list'       => ['common'],
    // 默认控制器名
    'default_controller'     => 'Index',
    // 默认操作名
    'default_action'         => 'index',
    // 默认验证器
    'default_validate'       => '',
    // 默认的空控制器名
    'empty_controller'       => 'Error',
    // 操作方法后缀
    'action_suffix'          => '',
    // 自动搜索控制器
    'controller_auto_search' => false,

    // +----------------------------------------------------------------------
    // | URL设置
    // +----------------------------------------------------------------------

    // PATHINFO变量名 用于兼容模式
    'var_pathinfo'           => 's',
    // 兼容PATH_INFO获取
    'pathinfo_fetch'         => ['ORIG_PATH_INFO', 'REDIRECT_PATH_INFO', 'REDIRECT_URL'],
    // pathinfo分隔符
    'pathinfo_depr'          => '/',
    // URL伪静态后缀
    'url_html_suffix'        => 'html',
    // URL普通方式参数 用于自动生成
    'url_common_param'       => false,
    // URL参数方式 0 按名称成对解析 1 按顺序解析
    'url_param_type'         => 0,
    // 是否开启路由
    'url_route_on'           => true,
    // 路由使用完整匹配
    'route_complete_match'   => true,
    // 路由配置文件（支持配置多个）
    'route_config_file'      => ['route'],
    // 是否强制使用路由
    'url_route_must'         => true,
    // 域名部署
    'url_domain_deploy'      => false,
    // 域名根，如thinkphp.cn
    'url_domain_root'        => '',
    // 是否自动转换URL中的控制器和操作名
    'url_convert'            => true,
    // 默认的访问控制器层
    'url_controller_layer'   => 'controller',
    // 表单请求类型伪装变量
    'var_method'             => '_method',
    // 表单ajax伪装变量
    'var_ajax'               => '_ajax',
    // 表单pjax伪装变量
    'var_pjax'               => '_pjax',
    // 是否开启请求缓存 true自动缓存 支持设置请求缓存规则
    'request_cache'          => false,
    // 请求缓存有效期
    'request_cache_expire'   => null,
    // 全局请求缓存排除规则
    'request_cache_except'   => [],

    // +----------------------------------------------------------------------
    // | 模板设置
    // +----------------------------------------------------------------------

    'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 模板路径
        'view_path'    => '',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',
    ],

    // 视图输出字符串内容替换
    'view_replace_str'       => [
        '__AVIEW__' => '/admin/',
    ],
    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl'  => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'    => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',

    // +----------------------------------------------------------------------
    // | 异常及错误设置
    // +----------------------------------------------------------------------

    // 异常页面的模板文件
    'exception_tmpl'         => THINK_PATH . 'tpl' . DS . 'think_exception.tpl',

    // 错误显示信息,非调试模式有效
    'error_message'          => '页面错误！请稍后再试～',
    // 显示错误信息
    'show_error_msg'         => false,
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'       => '',

    // +----------------------------------------------------------------------
    // | 日志设置
    // +----------------------------------------------------------------------

    'log'                    => [
        // 日志记录方式，内置 file socket 支持扩展
        'type'  => 'File',
        // 日志保存目录
        'path'  => LOG_PATH,
        // 日志记录级别
        'level' => [],
    ],

    // +----------------------------------------------------------------------
    // | Trace设置 开启 app_trace 后 有效
    // +----------------------------------------------------------------------
    'trace'                  => [
        // 内置Html Console 支持扩展
        'type' => 'Html',
    ],

    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------

    'cache'                  => [
        // 驱动方式
        'type'   => 'File',
        // 缓存保存目录
        'path'   => CACHE_PATH,
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------

    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'think',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------
    'cookie'                 => [
        // cookie 名称前缀
        'prefix'    => '',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => '',
        // 是否使用 setcookie
        'setcookie' => true,
    ],

    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],

    //验证码
    'captcha'   =>  [
        'expire'   => 60,
        // 验证码过期时间（s）
        'fontSize' => 18,
        // 验证码字体大小(px)
        'imageH'   => 41,
        // 验证码图片高度
        'imageW'   => 120,
        // 验证码图片宽度
        'length'   => 4,
        // 验证码位数
        'useNoise' => false,
        // 是否添加杂点
        'bg'       => [243, 251, 254],
        // 背景颜色
        'fontttf'  => '4.ttf',
        // 验证码字体，不设置随机获取
    ],

    // 邮箱验证配置
    'email'   =>  [
        'mail_debug'        =>  0,
        'mail_port'         =>  465,
        'mail_smtp'         =>  'smtp.qq.com',
        'mail_address'      =>  '2703412633@qq.com',
        'mail_loginname'    =>  '2703412633@qq.com',
        'mail_password'     =>  'fagxhrcnzkzrddbb',
    ],

    // 支付宝支付
    'alipay'    =>  [
         //应用ID,您的APPID。
        'app_id' => "2016091400508269",

        //商户私钥
        'merchant_private_key' => "MIIEogIBAAKCAQEA23MU1MyeUt2ZXda1Ov+3FmXH1dRdBE7OsuUUTjT+76bWTPnbpsSsCDZja+XuMg3jWuCoFjcZ3j24MsIeA0u/MrhqPk1n3xW3DuqmF3Ymeh8IMnMM0/btOja5uKBZyFLeKD/YJFv/aOVbzw1ABTczR9r/lTTjbV9HCm1vWID+YFT/kSGr1lvPfaqQdf+yyiX/7Wh/XO5EocFz/Kj5VvodVs0tDi2JVbGhjNLNdo3gSobgmeIDx9estKKmyLCVdj0hPrqGZGHtVAr0c4IOIaFDwrhRRWrVU/KsYxHq2YmOYXKTTprNtiyDCIGXRyy601VM9pDoKcCZVIhjpKQLZc9YGQIDAQABAoIBAHye2MiTvqEuSKb6hAaSKwXkHNy4cW491rHO134mKFQt+WrTRUJqU4uCX2lptJ/mNSNpiuq6tcz4Xb8tb1/NxzFleqgQyxjruv4UkOen5+fX8Y68uR8yDbvOUh+fp/zT2mcfAn57ZArMnRty2dVcaJm4qwWveCunPK+WP/IRpuNKtD1PuiJGmyoYqdnh6jqLolsrMzjp8KJUI37dYZbxlh2lG+b6RAG53sYVi8O1FCOLmroMcntcBbiNIyvSH+DGX+vVsM5No1S+YB/gczPBTPXeOUdT9rATTupBWycpg2J7MpCZZyRIFP8Z6Gh7a/h45U/FKzlXCnpls5xfQlWU5IECgYEA9vfGB2MGs9l8QKryHZ2lMfcoUk8QqQxnbcN6Qn9XkHWNFae5yHLUH8ICXVCyoCl8IgLI0gKg5rVHMLmxRsxMv+F8xkO7SZHFmtzO9DnDuKHQaeeS3ozWFVSJVOP9fROvuKBHcNEfcc8+9idjueXH1tfcGTIpfIxOJ6bXBbXG4wkCgYEA43mrKZzlBL6d0FRS1B3VA0Pu+oQ3oz6J6ERjdoE32zYmrZ0tTZ10Ur/99GTGn2nok6SNPT7DBu1kMukDApEbB5OjwWEl9vPf1HdA8ZwPXfEnTXfnpaNH/LDU6h8zAAERYTasSngdDRomLRRzUGdb/f6pnfexD0bHPr/MW2VSwJECgYA4HG9nuj4Jmr46SxybUff4dDk7Ci+02Nae/6zFcv1IGw0lAGibfEtps8Cpxu3uqb5EU/GglWxNPp6gGXCHr184sViSC02AF5iX6Nc0cfNf/ZPGnBCoc8MoMX7KRMqRImnoPrI8labZSsb5UlW8JNLUo1KkftsiKxaOt79e0sAPUQKBgG1j6SfNx2SMth+lLV/MKM+1L4tRYeAjBvanTJ2EbnQAioEbANo+Sd4xbdLFU679o1a83x8Au5DtQC4rV8M4PKNcIHeyXCtyA8WMw7JstgcbHSdn7gH9j3S5JOqhrkjmOpFhVWFKec3/MTSkjP+xdM+kU7UflAogo1hNq9yX0T/BAoGAMWDhtIPCb7hdQ/9F0f/2UyxLjSkb3yVv/SpnTKROnyr7XVEwJMnTvlh1dSbz+YwADlbN4kpQl+r/x29e+jQ1Src4m182H9uVD2kvlB3FvQ8M6D+/GI1NdsZ3/TrH8IdG3m3G7FF9KU2pK0wHjdG9R6kniP1UyKgkiWueQaoOJV0=",
        
        //异步通知地址
        'notify_url' => "",
        
        //同步跳转
        'return_url' => "http://miracle.51zuopin.com/pay_success.html",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA23MU1MyeUt2ZXda1Ov+3FmXH1dRdBE7OsuUUTjT+76bWTPnbpsSsCDZja+XuMg3jWuCoFjcZ3j24MsIeA0u/MrhqPk1n3xW3DuqmF3Ymeh8IMnMM0/btOja5uKBZyFLeKD/YJFv/aOVbzw1ABTczR9r/lTTjbV9HCm1vWID+YFT/kSGr1lvPfaqQdf+yyiX/7Wh/XO5EocFz/Kj5VvodVs0tDi2JVbGhjNLNdo3gSobgmeIDx9estKKmyLCVdj0hPrqGZGHtVAr0c4IOIaFDwrhRRWrVU/KsYxHq2YmOYXKTTprNtiyDCIGXRyy601VM9pDoKcCZVIhjpKQLZc9YGQIDAQAB",
    ],
];