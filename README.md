Menu element is moved to another tab, since in Magento 2.3.1 there is no one as mentioned

=== ===

During custom product creation there is a hardcoded attribute set and other values.
Not perfect solution, but need to bypass the required values validation on database level

=== ===

API user should get Admin token.

=== ===

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