<?php
namespace TYPO3\KcHumbaurProducts\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Sven Külpmann , kalter_lwf
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

class IsInConfigViewHelper  extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {


	/**
     * @param string $stringInput
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('trailer', '\TYPO3\KcHumbaurProducts\Domain\Model\Trailer', 'trailer',false,NULL);
        $this->registerArgument('part', '\TYPO3\KcHumbaurProducts\Domain\Model\Part', 'part',false,NULL);
    }

	/**
	 *
	 * @return int
	 */
	public function render(){

		$trailer = $this->arguments['trailer'];
		$part = $this->arguments['part'];

		// MO20140627: part can be NULL, if no relation/translation is found
		if(is_null($part) || get_class($part) != "Part")
		{
			return false;
		}

		$this->session = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\KcHumbaurProducts\Domain\Session\SessionHandler');



		$trailerUid = $trailer->getUid();
		$partUid = $part->getUid();
		if($this->session->has('configurations') ) {
			$configurations = $this->session->get('configurations');

			//if part not in Configuration?
			if(is_array($configurations[$trailerUid])){
				$key = array_search( $partUid, $configurations[$trailerUid] );
				if($key === FALSE){
					return FALSE;
				}else{
					return TRUE;
				}
			}
		}

		return FALSE;
	}
}

?>
