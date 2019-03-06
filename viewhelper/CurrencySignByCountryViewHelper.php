<?php
namespace TYPO3\KcHumbaurProducts\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Sascha Urbanek
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
 * @package kc_humbaur_products
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CurrencySignByCountryViewHelper  extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {
    /**
     * @return mixed
     */
    public function render(){

        $country = $GLOBALS['TSFE']->fe_user->user['country'];
        // traurig, aber ich habs nicht hinbekommen die Currency nach LaenderID aus den Static Tables zu holen
        // CH 41 / DE 54 / AT 13 / FR 72
        switch ($country) {
            case "41": $currency = "SFr."; // Schweiz
                break;
            default: $currency = "€";
                break;
        }

        return $currency;
    }
}
?>
