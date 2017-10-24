# Simple-PhalconApi
感谢phalconCms 作者的https://github.com/KevinJay/PhalconCMS

顺便作者QQ群号:150237524 大家也可以一起来讨论交流phalcon

主要对框架改造,封装http返回信息,与框架简化处理,一切还是按原来CMS操作哦！

后期有时间会重构框架

这里主要是对多模块进行说明PHQL模型识别
详情请看博客:http://blog.csdn.net/ycc297876771/article/details/78117009 如何进行多模块的模型定位

注:后台暂时没用phalcon,一般使用其做http协议api接口

配置如下
根据cgi接口不同,请适当修改配置

    server {
	    listen 80;
	    server_name phalcon.cc;
	    root "E:\xxxxxxx\project\public";
	    index index.php index.html index.htm;
	
	    location / {
	        if ($request_uri ~ (.+?\.php)(|/.+)$ ) {
	            break;
	        }
        
	        if (!-e $request_filename) {
	            rewrite ^/(.*)$ /index.php?_url=/$1;
	        }
	    }
	
	    location ~ \.php {
	        try_files     $uri =404;
          
          fastcgi_pass  127.0.0.1:9000;
          fastcgi_index /index.php;

          include fastcgi_params;
          fastcgi_split_path_info       ^(.+\.php)(/.+)$;
          fastcgi_param PATH_INFO       $fastcgi_path_info;
          fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
          fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
	    }
	
	    access_log  "E:\xxxxx\log\access.log";
	    error_log   "E:\xxxxx\log\error.log";
}

后台地址 http://yourhost/admin 访问后台 admin 654321

前台 demo: http://yourhost/api/sendSms

其他的使用方法参考 https://www.marser.cn

如不需要后台功能,保留file表就可以了(文件上传会使用到)

redis注入服务都是手动注入,请详细参考下,phalcon的redis组件功能可能不够用
