# server-planner (PHP)

This package provides you an easy-to-use vServer calculator which calculates how many bare-metal servers it would need to fit the vServer expectations.

### Requirements

- \>= PHP 7.0

### Install

> At the time of writing, I don't published it to packagist, but I have planned to do it.

You can use composer to use this library in your project.  
```bash
composer require isikemre/server-planner
```

### How to use it?

It's very simple. You just need only one method.  
Here is an example how you could use the server-planner.

```php
$yourBareMetalServer = new BareMetalServer(8, 32, 1000); //CPU, RAM, HDD
$virtualMachines = [
    new VServer(4, 16, 100),
    new VServer(2, 8, 100),
    new VServer(8, 32, 300)
];

$serverCount = ServerPlanning::calculate($resources, $virtualMachines); // the amount of how many bare metal servers you gonna need.
echo $serverCount; // or use it anywhere :)
```

### License

This library is open-source and licensed under the Apache License 2.0. 