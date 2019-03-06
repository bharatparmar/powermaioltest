<?php
namespace TYPO3\KcHumbaurProducts\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Eugen Wagner, KSA Media
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

class GetTrailerImagesViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {

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
        $this->registerArgument('index', 'integer', 'index',false,0);
    }

	/**
	 * Get List Image
	 * Check if product has image on FILESYSTEM
	 *
	 * @return string
	 */
	public function render($product, $index= 0) {
		$product = $this->arguments['product'];
		$index = $this->arguments['index'];

		if(NULL !== $product) {

			$images = [];

			//image from product
			try {
				$trailerNumber = $product->getNumber();
				$imageFile = $this->imagePathTrailer . $trailerNumber;

				$i = 1;
				while ($i <= 5):
					if(file_exists($imageFile . "_0" . $i . ".png")) {
						$images[] = $imageFile . "_0" . $i . ".png";
					} else if(file_exists($imageFile . "_0" . $i . ".jpg")) {
						$images[] = $imageFile . "_0" . $i . ".jpg";
					}
					$i++;
				endwhile;
			} catch(Exception $e) {
				throw new Exception('Image from Product: ' . $product->getUid(), 0, $e);
			}

			//image from model
			try {
				if(FALSE === empty($product->getTrailermodell()) ) {
					$modelnr = $product->getTrailermodell()->getModelnr();
					$imageFile = $this->imagePathTrailermodel . $modelnr;

					$i = 1;
					while ($i <= 5):
						if(file_exists($imageFile . "_0" . $i . ".png")) {
							$images[] = $imageFile . "_0" . $i . ".png";
						} else if(file_exists($imageFile . "_0" . $i . ".jpg")) {
							$images[] = $imageFile . "_0" . $i . ".jpg";
						}
						$i++;
					endwhile;
				}
			} catch(Exception $e) {
				throw new Exception('Image from Model: ' . $product->getUid(), 0, $e);
			}

			return $images;
		}

		//image none
		return 'fileadmin/img_products/kein-Bild.jpg';
	}
}

?>
