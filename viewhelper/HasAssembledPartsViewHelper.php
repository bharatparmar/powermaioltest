<?php
namespace TYPO3\KcHumbaurProducts\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Gabor Voros, hs-digital
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package kc_humbaur_products
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class HasAssembledPartsViewHelper  extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
     * @param string $stringInput
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('parts', '\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult', 'parts',false,NULL);
        $this->registerArgument('trailer', '\TYPO3\KcHumbaurProducts\Domain\Model\Trailer', 'trailer',false,NULL);
    }

	/**
	 * return the localization of the User as lowercase ISO2-code
	 *
	 * @return string
	 */

	public function render(){

		$parts = $this->arguments['parts'];
		$trailer = $this->arguments['trailer'];

		$partAssembled = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\KcHumbaurProducts\Domain\Repository\PartReferenceRepository');
		$partAssembledArray;
		if (is_array($parts) || is_object($parts)){
			foreach($parts as $part){
				$partAssembledArray[] = $partAssembled->findIfAssembled($part->getUid(), $trailer->getUid());
			}
		}
		return $partAssembled->searchForAssembled('1', $partAssembledArray);
	}
}

?>