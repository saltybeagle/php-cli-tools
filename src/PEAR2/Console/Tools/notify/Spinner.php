<?php
/**
 * PHP Command Line Tools
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 *
 * @author    James Logsdon <dwarf@girsbrain.org>
 * @copyright 2010 James Logsdom (http://girsbrain.org)
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 */

namespace PEAR2\Console\Tools\notify;

/**
 * The `Spinner` Notifier displays an ASCII spinner.
 */
class Spinner extends \PEAR2\Console\Tools\Notify {
	protected $_chars = '-\|/';
	protected $_format = '{:msg} {:char}  ({:elapsed}, {:speed}/s)';
	protected $_iteration = 0;

	/**
	 * Prints the current spinner position to `STDOUT` with the time elapsed
	 * and tick speed.
	 *
	 * @param boolean  $finish  `true` if this was called from
	 *                          `PEAR2\Console\Tools\Notify::finish()`, `false` otherwise.
	 * @see PEAR2\Console\Tools\out_padded()
	 * @see PEAR2\Console\Tools\Notify::formatTime()
	 * @see PEAR2\Console\Tools\Notify::speed()
	 */
	public function display($finish = false) {
		$msg = $this->_message;
		$idx = $this->_iteration++ % strlen($this->_chars);
		$char = $this->_chars[$idx];
		$speed = number_format(round($this->speed()));
		$elapsed = $this->formatTime($this->elapsed());

		\PEAR2\Console\Tools\out_padded($this->_format, compact('msg', 'char', 'elapsed', 'speed'));
	}
}
