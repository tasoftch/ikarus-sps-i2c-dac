# I2C Digital Analog Converter
This package contains php classes to control dac chips.

### Installation
````bin
$ composer require ikarus/sps-i2c-dac
````

### Usage

```php
<?php
use Ikarus\SPS\I2C\DAC_MCP4625;
use TASoft\Bus\I2C;

$dac = new DAC_MCP4625( new I2C( DAC_MCP4625::DEFAULT_ADDRESS ) );
$dac->setOutput(2048); // Set to half of vdd.
sleep(5);
$dac->setOutput(0, true); // Set to 0 and store this.

```