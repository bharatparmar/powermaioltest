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
class TextToTableViewHelper  extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {

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
     * Creates a table from a simple text that uses | as a cell delimiter
     * @return string
     */
    public function render($text){
        $text = $this->arguments['text'];
        if ( $text ){
            $longest = 0; $tablerows = [];
            // Wir zerlegen den String in Zeilen (Linebreak) und Spalten (|)
            $rows = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode("\n",$text);
            foreach($rows AS $row){
                // Array_filter vermeidet leere Zeilen und Zellen
                $cells =  \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode("|",$row) ;
                if ( array_filter($cells)) {
                    $tablerows[] = array_filter($cells);
                    $longest = max( max(array_keys(array_filter($cells))), $longest);
                }
            }

            // Und bauen eine Tabelle draus
            $tablestring = '<table class="contenttable table-responsive table">';
            foreach($tablerows AS $tablerow){
                $tablestring.= '<tr>';
                // Damit jede Zeile die gleiche Anzahl Zellen hat
                for($i = 0; $i <= $longest; $i++){
                    $tablestring.= '<td>'.( isset($tablerow[$i]) ? $tablerow[$i] : '' ).'</td>';
                }
                $tablestring.= '</tr>';
            }
            $tablestring.= '</table>';

            $text = $tablestring;
        }
        return $text;
    }
}
?>
