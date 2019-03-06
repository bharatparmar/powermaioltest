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

class GetListImageViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * filepath for product images
	 */
	protected $imagePathTrailer = 'fileadmin/img_products/trailers/';

	/**
	 * filepath for model images
	 */
	protected $imagePathTrailermodel = 'fileadmin/img_products/trailermodels/';

	/**
     * @param string $stringInput
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('product', 'object', 'product',false,NULL);
        $this->registerArgument('trailer', 'string', 'String because trailer "number" can include points',false,NULL);
        $this->registerArgument('trailermodell', 'integer', 'NavisionID of trailermodell group',false,NULL);


    }

    /**
	 * Get List Image
	 * Check if product has image on FILESYSTEM
	 *
	 * @return string
     * @throws \Exception
	 */
	public function render() {
        $product = $this->arguments['product'];
        $trailer = $this->arguments['trailer'];
        $trailermodell = $this->arguments['trailermodell'];
		if(!is_null($product) || !is_null($trailer) || !is_null($trailermodell)) {

			//image from product
			try {
                if ($trailer){
                    $trailerNumber = $trailer;
                }else if(is_object($product)){
                    $trailerNumber = $product->getNumber();
                }

                $img  = $this->findImg($this->imagePathTrailer, $trailerNumber);
                if ($img) return $img;

			} catch(\Exception $e) {
				throw new \Exception('Image from Product: ' . $product->getUid(), 0, $e);
			}

			//image from model
			try {
                if ($trailermodell){
                    $modelnr = $trailermodell;
                }else if(is_object($product) && FALSE === empty($product->getTrailermodell()) ) {
                    $modelnr = $product->getTrailermodell()->getModelnr();
                }

                $img  = $this->findImg($this->imagePathTrailermodel, $modelnr);
                if ($img) return $img;

            } catch(\Exception $e) {
				throw new \Exception('Image from Model: ' . $product->getUid(), 0, $e);
			}
		}

		//image none
		return 'fileadmin/img_products/kein-Bild.jpg';
	}

    /**
     * Look for Image in a specific name format like 250_01.jpg
     * @param string $path Imagepath to check for
     * @param string $number Part of the Image name
     * @return bool|string Imagepath or FALSE if nothing was found
     */
	private function findImg($path,$number)
    {
        $imageFile = $path . $number . "_" . "01";
        if(file_exists($imageFile . ".png")) {
            return $imageFile . ".png";
        } else if(file_exists($imageFile . ".jpg")) {
            return $imageFile . ".jpg";
        } else {
            return false;
        }
    }
}

?>
