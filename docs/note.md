
服务器虚拟主机配置
```
<VirtualHost *:9999>
        #ServerName  www.shmp.com
        #ServerAlias shmp.com  abc.shmp.com
        DocumentRoot  "/mnt/hgfs/develop/backworker_laravel54/public"
        DirectoryIndex  index.php
        <Directory "/mnt/hgfs/develop/backworker_laravel54/public">
            Options  FollowSymLinks MultiViews
            AllowOverride all
            Order Deny,Allow
            Allow from all
            Require all granted
        </Directory>
</VirtualHost>
```