<?php
/*
 * BSD 3-Clause License
 *
 * Copyright (c) 2019, TASoft Applications
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *  Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 *
 *  Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 *  Neither the name of the copyright holder nor the names of its
 *   contributors may be used to endorse or promote products derived from
 *   this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

namespace Ikarus\SPS\I2C;


use TASoft\Bus\I2C;

class DAC_MCP4625
{
	const ADDRESS_1 = 0x62;
	const ADDRESS_2 = 0x63;

	const DEFAULT_ADDRESS = self::ADDRESS_1;

	/** @var I2C */
	private $bus;

	/**
	 * DAC_MCP4625 constructor.
	 * @param I2C $bus
	 */
	public function __construct(I2C $bus)
	{
		$this->bus = $bus;
	}

	/**
	 * Gets the i2c instance
	 * @return I2C
	 */
	public function getBus(): I2C
	{
		return $this->bus;
	}

	/**
	 * Writes the value to the dac.
	 *
	 * If persistent is true, the dac will remember the value after reboot.
	 *
	 * @param int $value
	 * @param bool $persistent
	 */
	public function setOutput(int $value, bool $persistent = false) {
		if($persistent)
			$this->bus->write(0b01100000, [ ($value>>4) & 0xFF, ($value<<4) &  0xF0]);
		else
			$this->bus->write(0x0 | (($value>>8) & 0xF), [ $value&0xFF ]);
	}
}