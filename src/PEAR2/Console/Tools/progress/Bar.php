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

namespace PEAR2\Console\Tools\Progress;
use PEAR2\Console\Tools;

/**
 * Displays a progress bar spanning the entire shell.
 *
 * Basic format:
 *
 *   ^MSG  PER% [=======================            ]  00:00 / 00:00$
 */
class Bar extends Tools\Progress {
	protected $_bars = '=>';
	protected $_formatMessage = '{:msg}  {:percent}% [';
	protected $_formatTiming = '] {:elapsed} / {:estimated}';
	protected $_format = '{:msg}{:bar}{:timing}';

	/**
	 * Prints the progress bar to the screen with percent complete, elapsed time
	 * and estimated total time.
	 *
	 * @param boolean  $finish  `true` if this was called from
	 *                          `PEAR2\Console\Tools\Notify::finish()`, `false` otherwise.
	 * @see PEAR2\Console\Tools\out()
	 * @see PEAR2\Console\Tools\Notify::formatTime()
	 * @see PEAR2\Console\Tools\Notify::elapsed()
	 * @see PEAR2\Console\Tools\Progress::estimated();
	 * @see PEAR2\Console\Tools\Progress::percent()
	 * @see PEAR2\Console\Tools\Shell::columns()
	 */
	public function display($finish = false) {
		$_percent = $this->percent();

		$percent = str_pad(floor($_percent * 100), 3);;
		$msg = $this->_message;
		$msg = Tools\render($this->_formatMessage, compact('msg', 'percent'));

		$estimated = $this->formatTime($this->estimated());
		$elapsed   = str_pad($this->formatTime($this->elapsed()), strlen($estimated));
		$timing    = Tools\Render($this->_formatTiming, compact('elapsed', 'estimated'));

		$size = Tools\Shell::columns();
		$size -= strlen($msg . $timing);

		$bar = str_repeat($this->_bars[0], floor($_percent * $size)) . $this->_bars[1];
		// substr is needed to trim off the bar cap at 100%
		$bar = substr(str_pad($bar, $size, ' '), 0, $size);

		Tools\Out($this->_format, compact('msg', 'bar', 'timing'));
	}
}
