# Pimcore api bridge magento 

Provides api interface for magento. 

Bridge includes 2 extensions:

1. magento extension api-bridge-pimcore 
2. pimcore plugin api-bridge-magento 

## Pimcore installation

Using Composer:  

```
composer require oleksandrmakhno/api-bridge-magento
```

Manually: 

```
https://github.com/oleksandrmakhno/api-bridge-magento.git
```

Generate api key: 

```
1. pimcore => settings => users / roles => users => create user 'api-bridge-magento' 
2. pimcore => settings => users / roles => users => generate user api key
3. set pimcore api key in magento 
```

## Magento installation


## Release History

* 20160205 0.0.1 pimcore plugin initial version 
* 20160216 0.0.2 added logic to install as pimcore plugin 
