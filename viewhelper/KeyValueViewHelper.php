<?php
namespace TYPO3\KcHumbaurProducts\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Sascha Urbanek
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
class KeyValueViewHelper  extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {
    /**
     * Inline-Schreibweise
     * {h:keyValue(obj: object, prop: key)}
     * Inline-Schreibweise mit zusammengesetzem Key
     * {h:keyValue(obj: object, prop: {0:key1, 1:key2}}, sep:'-' )}
     * @param $obj  object Object
     * @param $prop	string Property
     */

    public function initializeArguments(){
        $this->registerArgument( 'obj', 'mixed', '');
        $this->registerArgument( 'prop', 'mixed', '');
        $this->registerArgument( 'sep', 'mixed', '');
    }

    public function render() {

        $obj = $this->arguments['obj'];
        $prop = $this->arguments['prop'];
        $sep = $this->arguments['sep'];

        if(is_array($prop)) $prop = implode($sep,$prop);

        if(is_object($obj)) {
            return $obj->{'get'.$prop}();
        } elseif(is_array($obj)) {
            if(array_key_exists($prop, $obj)) {
                return $obj[$prop];
            }
        }
        return NULL;
    }
}
?>
