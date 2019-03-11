# miniAlipay

## 安装使用
```
# 从仓库中下载
$ git clone https://github.com/icharle/miniAlipay
   
# 进入代码根目录安装依赖
$ composer install
   
# copy .env文件
$ cp .env.example .env
   
# 生成项目key
$ php artisan key:generate

# 配置小程序appID && 支付宝公钥私钥路径(路径按照下面填写即可)
ALIPAY_APP_ID=
APP_PRIVATE_KEY_PATH=pem/private.txt
ALIPAY_PUBLIC_KEY_PATH=pem/public.txt
```