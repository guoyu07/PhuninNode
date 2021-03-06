PhuninNode
==========

[![Build Status](https://travis-ci.org/WyriHaximus/PhuninNode.png)](https://travis-ci.org/WyriHaximus/PhuninNode)
[![Latest Stable Version](https://poser.pugx.org/WyriHaximus/Phunin-Node/v/stable.png)](https://packagist.org/packages/WyriHaximus/Phunin-Node)
[![Total Downloads](https://poser.pugx.org/WyriHaximus/Phunin-Node/downloads.png)](https://packagist.org/packages/wyrihaximus/phunin-node/stats)
[![Code Coverage](https://scrutinizer-ci.com/g/WyriHaximus/PhuninNode/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/WyriHaximus/PhuninNode/?branch=master)
[![License](https://poser.pugx.org/wyrihaximus/phunin-node/license.png)](https://packagist.org/packages/wyrihaximus/phunin-node)

PhuninNode is a munin-node port PHP aiming to provide application monitoring utilizing munin.

## Installation ##

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `~`.

```
composer require wyrihaximus/phunin-node 
```

## Simple usage ##

PhuninNode now also comes with a commandline tool to easily start instances based on a configuration file. It will look for the `phunin-node.yml` file containing the configuration. Just run `./vendor/bin/phunin-node` to start a new instance.

## Basic usage ##

```php
<?php

use React\EventLoop\Factory;
use WyriHaximus\PhuninNode\Factory as NodeFactory;
use WyriHaximus\PhuninNode\Plugins;

require dirname(__DIR__) . '/vendor/autoload.php';

// Create eventloop
$loop = Factory::create();

// Create Node
$node = NodeFactory::create($loop, '0.0.0.0', 12345);

// Add plugins
$node->addPlugin(new Plugins\Plugins());
$node->addPlugin(new Plugins\PluginsCategories());
$node->addPlugin(new Plugins\MemoryUsage());
$node->addPlugin(new Plugins\Uptime());

// Get rolling
$loop->run();
```

## Accessing the example ##

Connect to the running instance: `telnet localhost 12345`

It supports all munin's commands like `list`, `fetch`, `config` etc etc. For example `fetch uptime` resolves the instance uptime.

## Ideas ##

- Async support
- Multigraph
- Full cap command

## License ##

Copyright 2013 - 2016 [Cees-Jan Kiewiet](http://wyrihaximus.net/)

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

