<?php
/**
 *  Copyright notice
 *
 *  ⓒ 2014 Michiel Roos <michiel@maxserv.nl>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is free
 *  software; you can redistribute it and/or modify it under the terms of the
 *  GNU General Public License as published by the Free Software Foundation;
 *  either version 2 of the License, or (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful, but
 *  WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 *  or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
 *  more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 */

/**
 * A Deprecation Repository
 *
 */
class Tx_Smoothmigration_Domain_Repository_DeprecationRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * Find replacements by Class and Method
	 *
	 * @param $class
	 * @param $method
	 * @return \Tx_Smoothmigration_Domain_Model_Deprecation
	 */
	public function findOneStaticByClassAndMethod($class, $method) {
		$result = NULL;
		$query = $this->createQuery();
		$queryResult = $query->matching(
			$query->logicalAnd(
				$query->equals('class', $class),
				$query->equals('method', $method),
				$query->equals('isStatic', TRUE)
			)
		)->execute();
		if ($queryResult instanceof Tx_Extbase_Persistence_QueryResultInterface) {
			$result = $queryResult->getFirst();
		} elseif (is_array($queryResult)) {
			$result = isset($queryResult[0]) ? $queryResult[0] : NULL;
		}
		return $result;
	}
}
