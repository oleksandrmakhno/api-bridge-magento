# Pimcore plugin api-bridge-magento 

Bridge includes 2 extensions: 

1. magento extension https://github.com/oleksandrmakhno/api-bridge-pimcore 
2. pimcore plugin https://github.com/oleksandrmakhno/api-bridge-magento

## Pimcore plugin installation

Using Composer:  

```
composer require oleksandrmakhno/api-bridge-magento
```

Manually: 

```
https://github.com/oleksandrmakhno/api-bridge-magento.git
```

Manage pimcore settings: 

```
1. pimcore => settings => object => classes => add class 'MagentoBaseProduct' => import (button in the bottom) => objectDefinition/class_MagentoBaseProduct_export.json 
2. pimcore => settings => system => web service api => web service api enabled (check checkbox) => save 
3. pimcore => settings => users / roles => users => create user 'api-bridge-magento' => save 
4. pimcore => settings => users / roles => users => generate user api key (mypimcorerestapikey) => save 
5. magento => set pimcore user api key (mypimcorerestapikey)
6. pimcore => extras => extensions => ApiBridgeMagento => enable
7. pimcore => objects panel => home (right click) add object => MagentoBaseProduct (sku=e123) => save 
```

Test url (api returns data or nothing): 

```
http://myhost.local/plugin/ApiBridgeMagento/api/gateway?commandName=getProduct&sku=e123&apiKey=mypimcorerestapikey 
response: {"sku":"e123","info":"info magento product"}
```

## Release History

* 20160205 0.0.1 pimcore plugin initial version 
* 20160216 0.0.2 added logic to install as pimcore plugin 

## Maintainer 
* Oleksandr Makhno
* option25@gmail.com 
* <a href='https://ua.linkedin.com/in/oleksandr-makhno-98a30b45'>https://ua.linkedin.com/in/oleksandr-makhno-98a30b45</a>
