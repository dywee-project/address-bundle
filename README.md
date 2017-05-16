#DyweeAddressBundle

```
$ composer require dywee/address-bundle
```

##Add the bundle to the kernel

AppKernel.php
```
$bundles = [
    ...
    new Dywee\AddressBundle\DyweeAddressBundle(),
]
```

##Make sure you also have

* "knplabs/knp-paginator-bundle": "^2.5",
* "misd/phone-number-bundle": "^1.2"`


###Configure knp paginator

AppKernel
```
$bundles = [
    ...
    new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
]
```

config.yml            
```
knp_paginator:
       page_range: 5                      # default page range used in pagination control
       default_options:
           page_name: page                # page query parameter name
           sort_field_name: sort          # sort field query parameter name
           sort_direction_name: direction # sort direction query parameter name
           distinct: true                 # ensure distinct results, useful when ORM queries are using GROUP BY statements
       template:
           pagination: KnpPaginatorBundle:Pagination:sliding.html.twig     # sliding pagination controls template
           sortable: KnpPaginatorBundle:Pagination:sortable_link.html.twig # sort link template
```

###Configure phone number bundle

AppKernel.php
```
$bundles = [
    ...
    new Misd\PhoneNumberBundle\MisdPhoneNumberBundle()
]
``` 

config.yml
```
doctrine:
    dbal:
        types:
            phone_number: Misd\PhoneNumberBundle\Doctrine\DBAL\Types\PhoneNumberType
``
