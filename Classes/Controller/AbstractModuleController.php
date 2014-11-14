<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Steffen Ritter, rs websystems <steffen.ritter@typo3.org>
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
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

if (t3lib_div::int_from_ver(TYPO3_version) < 6002000) {
	require_once(PATH_site . TYPO3_mainDir . 'template.php');
}

/**
 * Abstract action controller.
 *
 * @author Steffen Ritter

 */
class Tx_Smoothmigration_Controller_AbstractModuleController extends Tx_Extbase_MVC_Controller_ActionController {
	/**
	 * @var string Key of the extension this controller belongs to
	 */
	protected $extensionName = 'Smoothmigration';

	/**
	 * @var string The module security token
	 */
	protected $moduleToken = '';

	/**
	 * @var t3lib_PageRenderer
	 */
	protected $pageRenderer;
	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->pageRenderer->addCssFile(t3lib_extMgm::extRelPath('smoothmigration') . 'Resources/Public/StyleSheet/module.css');
		$this->pageRenderer->addInlineLanguageLabelFile('EXT:smoothmigration/Resources/Private/Language/locallang.xml');
		$this->pageRenderer->addJsLibrary('jquery', t3lib_extMgm::extRelPath('smoothmigration') . 'Resources/Public/JavaScript/jquery-1.10.1.min.js');
		$this->pageRenderer->addJsLibrary('sprintf', t3lib_extMgm::extRelPath('smoothmigration') . 'Resources/Public/JavaScript/sprintf.min.js');
		$this->pageRenderer->addJsFile(t3lib_extMgm::extRelPath('smoothmigration') . 'Resources/Public/JavaScript/General.js');

		if (t3lib_div::int_from_ver(TYPO3_version) > 6001000) {
			$this->moduleToken = \TYPO3\CMS\Core\FormProtection\FormProtectionFactory::get()->generateToken('moduleCall', 'tools_SmoothmigrationSmoothmigration');
		}
	}

	/**
	 * Processes a general request. The result can be returned by altering the given response.
	 *
	 * @param Tx_Extbase_MVC_RequestInterface $request The request object
	 * @param Tx_Extbase_MVC_ResponseInterface $response The response, modified by this handler
	 * @throws Tx_Extbase_MVC_Exception_UnsupportedRequestType if the controller doesn't support the current request type
	 * @return void
	 */
	public function processRequest(Tx_Extbase_MVC_RequestInterface $request, Tx_Extbase_MVC_ResponseInterface $response) {
		$this->template = t3lib_div::makeInstance('template');
		$this->pageRenderer = $this->template->getPageRenderer();

		$GLOBALS['SOBE'] = new stdClass();
		$GLOBALS['SOBE']->doc = $this->template;

		parent::processRequest($request, $response);

		$pageHeader = $this->template->startpage(
			$GLOBALS['LANG']->sL('LLL:EXT:smoothmigration/Resources/Private/Language/locallang.xml:module.title')
		);
		$pageEnd = $this->template->endPage();

		$response->setContent($pageHeader . $response->getContent() . $pageEnd);
	}
}

if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/smoothmigration/Classes/Controller/AbstractModuleController.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/smoothmigration/Classes/Controller/AbstractModuleController.php']);
}
?>