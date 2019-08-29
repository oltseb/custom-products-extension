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


````
./magento queue:consumers:start:oleksii consumerOleksii &
````


=== ===