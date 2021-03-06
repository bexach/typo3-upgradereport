<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Michiel Roos <michiel@maxserv.nl>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class Tx_Smoothmigration_Checks_Core_RemovedConstants_Definition
 *
 * @author Michiel Roos
 */
class Tx_Smoothmigration_Checks_Core_RemovedConstants_Processor extends Tx_Smoothmigration_Checks_AbstractCheckProcessor {

	/**
	 * @var array
	 */
	protected $constants = array('PATH_t3lib');

	/**
	 * Execute the check
	 *
	 * @return void
	 */
	public function execute() {
		if ($this->getExtensionKey()) {
			$locations = Tx_Smoothmigration_Utility_FileLocatorUtility::searchInExtension(
				$this->getExtensionKey(),
				'.*\.(php|inc)$',
				$this->generateRegularExpression()
			);
		} else {
			$locations = Tx_Smoothmigration_Utility_FileLocatorUtility::searchInExtensions(
				'.*\.(php|inc)$',
				$this->generateRegularExpression()
			);
		}
		foreach ($locations as $location) {
			$this->issues[] = new Tx_Smoothmigration_Domain_Model_Issue($this->parentCheck->getIdentifier(), $location);
		}
	}

	/**
	 * Generate a regular expression to search for all deprecated static calls
	 */
	protected function generateRegularExpression() {
		$regularExpression = array();
		foreach ($this->constants as $constant) {
			$regularExpression[] = $constant;
		}
		return '(' . implode('|', $regularExpression) . ')';
	}
}
