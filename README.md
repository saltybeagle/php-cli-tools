PHP Command Line Tools
======================

A collection of functions and classes to assist with command line development.

Requirements

 * PHP >= 5.3

Function List
-------------

 * `\PEAR2\Console\Tools\out($msg, ...)`
 * `\PEAR2\Console\Tools\out_padded($msg, ...)`
 * `\PEAR2\Console\Tools\err($msg, ...)`
 * `\PEAR2\Console\Tools\line($msg = '', ...)`
 * `\PEAR2\Console\Tools\input()`
 * `\PEAR2\Console\Tools\prompt($question, $default = false, $marker = ':')`
 * `\PEAR2\Console\Tools\choose($question, $choices = 'yn', $default = 'n')`
 * `\PEAR2\Console\Tools\menu($items, $default = false, $title = 'Choose an Item')`

Progress Indicators
-------------------

 * `\PEAR2\Console\Tools\notifier\Dots($msg, $dots = 3, $interval = 100)`
 * `\PEAR2\Console\Tools\notifier\Spinner($msg, $interval = 100)`
 * `\PEAR2\Console\Tools\progress\Bar($msg, $total, $interval = 100)`

Tabular Display
---------------

 * `\PEAR2\Console\Tools\Table::__construct(array $headers = null, array $rows = null)`
 * `\PEAR2\Console\Tools\Table::setHeaders(array $headers)`
 * `\PEAR2\Console\Tools\Table::setRows(array $rows)`
 * `\PEAR2\Console\Tools\Table::addRow(array $row)`
 * `\PEAR2\Console\Tools\Table::sort($column)`
 * `\PEAR2\Console\Tools\Table::display()`

Usage
-----

See `example.php` for examples.


Todo
----

 * Expand this README
 * Add doc blocks to rest of code
