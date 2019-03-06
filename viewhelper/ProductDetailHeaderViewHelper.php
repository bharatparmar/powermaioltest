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
class ProductDetailHeaderViewHelper  extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {


    /**
     * @param string $stringInput
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('text', 'string', 'text',false,NULL);
        $this->registerArgument('color', 'string', 'color',false,false);
    }

    /**
     * Automatically puts the text after the first word in a B tag so it can be targeted by CSS
     * @return mixed
     */
    public function render(){
        $text = $this->arguments['text'];
        $color = $this->arguments['color'];

        if ( $text ){
            $textdecoded = html_entity_decode($text);
            $textstripped = strip_tags($textdecoded, '<h1></h1><h2></h2><b></b>'); // We do not need the rest ..
            // We get the Content of the H1 Tag
            $newtext = $textstripped;
            preg_match("/<\s*h1[^>]*>(.*?)<\s*\/\s*h1>/", $textstripped, $h1content);
            if ( isset($h1content[1]) && strpos($h1content[1],"<b>") === false  ){ // only if NO B-Tag exists
                $style = trim($color) ? ' style="color:'.$color.';"' : false;
                $newh1content = preg_replace("/(\w {1})(.*)/", "$1 <b".$style.">$2</b>", $h1content[1]);
                $newtext = str_replace($h1content[1],$newh1content,$textstripped);
            }
            return $newtext;
        }else{
            return false;
        }
    }
}
?>
