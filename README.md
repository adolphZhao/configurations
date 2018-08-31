## 长连接配置服务端

### 使用步骤
- configs 文件夹内增加配置项
- copy ConfigurationServiceProvider.php 到框架的app/Providers
- 配置config服务 (.env)   地址和端口 

````  
     CONF_SERV=  
     CONF_SERV_PORT=  
````  
- 启动服务 php start.php start
配置自动加载到框架内直接使用 env(KEY,DEFAULT) 就可以获取配置内容
