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

class PriceByIpFastViewHelper  extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
     * @param string $stringInput
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('partUid', 'string', 'partUid',false,NULL);
        $this->registerArgument('trailerUid', 'string', 'trailerUid',false,NULL);
    }

	/**
	 * return the localization of the User as lowercase ISO2-code
	 *
	 * @return float
	 */
	public function render(){
		$partUid = $this->arguments['partUid'];
		$trailerUid = $this->arguments['trailerUid'];
	/*
		$settings = $this->templateVariableContainer->get('settings');
		$geoIp = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\KcHumbaurProducts\Utility\GeoIp');

		$price = $geoIp->priceByIp($part, $trailer);

		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$configurationManager = $objectManager->get('TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface');
		$settings = $configurationManager->getConfiguration(
				\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'KcHumbaurProducts'
		);


		/*
		**	25.02.2014 / oliverk
		** Specialprices / Pricehighlights should only be shown in Germany
		** (so said by Waliczek)
		*/


		/*if(($geoIp->iso2ByIp() !== "de" && $geoIp->iso2ByIp() !== "ch") || $settings["SpecialPriceHidden"] == "1")
		{
			if(isset($price) && method_exists($price, "setSpecialpricegross"))
			{
				$price->setSpecialpricegross(0);
				$price->setSpecialpricenet(0);
			}
		}
		return $price;
		*/

		$staticCountryRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('SJBR\StaticInfoTables\Domain\Repository\CountryRepository');
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$configurationManager = $objectManager->get('TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface');
		$settings = $configurationManager->getConfiguration(
				\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'KcHumbaurProducts', 'Trailers'
		);

		$settings['showDiscountgroup'] = $settings['showPriceList'];

		//IF USER IS LOGGED IN
		if($GLOBALS['TSFE']->fe_user->user['uid']){
			$userCountry = $GLOBALS['TSFE']->fe_user->user['country'];
			if($userCountry){
				$country = $staticCountryRepository->findByUid($userCountry);
			}
			else{
				$iso2 = $settings['geoIp']['defaultCountry'];
				$countries = $staticCountryRepository->findByIsoCodeA2(strtoupper($iso2));
				$country = $countries[0];
			}
		}
		else{
			$country = $this->staticCountryByIp(TRUE);
		}



	}

}

?>
