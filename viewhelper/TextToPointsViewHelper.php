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
class TextToPointsViewHelper  extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @param string $stringInput
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('text', 'string', 'text',false,NULL);
    }

    /**
     * @return mixed
     */
    public function render(){
        $text = $this->arguments['text'];
        if ( $text ){
            // The text ist used like a CSV here, we generate our Information for the info-points from it
            // first the points ...
            $punktearray = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode("\n",$text);
            // Now we split the points up into the 3 Info-Elements (Text,X,Y)
            foreach( $punktearray AS $punkt){
                $punktarray = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(";",$punkt);
                $punktefinal[] = array( 'text' => $punktarray[0],
                    'x' => $punktarray[1],
                    'y' => $punktarray[2]    );
            }
            return $punktefinal;
        }else{
            return false;
        }
    }
}
?>
