<h1>Installation Guide</h1>

Run

````
composer config repositories.oleksii vcs https://github.com/oltseb/custom-products-extension
composer require oleksii/custom-products
php bin/magento module:enable Oleksii_CustomProducts
php bin/magento setup:upgrade
````


After that extension will be added to the admin panel. And will be fully functional.
It has -

- Product creation;
- Inline edit in the grid;
- Get by VPN API;
- Update custom product API;
- Console command to run consumers (description below);
- Filtering;
- Install script for attributes;


**NOTE!** In Custom Product Creation section below is hardcoded product values are mentioned.
Attribute set is such a value, and by default it is using ``4th`` attribute set. If an instance has custom attribute
set - the value should be adjusted in the code.

<br/>

<h3>Comments</h3>

<h4>Custom Product creation</h4>

During custom product creation there is a hardcoded attribute set and other values.
Not perfect solution, but need to bypass the required values validation on database level

<h4>Authentication</h4>

API user should get Admin token.

<h4>Missing Consumers start command in Magento 2.3.1</h4>

It seems like in Magento 2.3.1 something is broken, as there is no queue:consumers:start command.
I mean, I can see it in the code, but it is not resolved

Thus, I've copied it into the extension and make it work.
Need to check the reason and make a PR for that into the product.

To run it -

````
./magento queue:consumers:start:oleksii consumerOleksii &
````

But it is the exact copy of, just created because of the core bug in M2.3.1

````
./magento queue:consumers:start consumerOleksii &
````

=== ===