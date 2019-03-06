<?php
namespace TYPO3\KcHumbaurProducts\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Eugen Wagner, KSA Media GmbH
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

class GetPartImageByArrayViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * filepath for part images
	 */
	protected $imagePath = 'fileadmin/img_shop/';

	/**
	 * filepath for snap images
	 */
	protected $imagePathSnap = 'fileadmin/img_shop/schnaeppchen_aktionen/';

	/**
     * @param string $stringInput
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('product', 'array', 'product',false,NULL);
    }

	/**
	 * Get List Image
	 * Check if product has image on FILESYSTEM
	 *
	 * @return string
	 */
	public function render() {
		$product = $this->arguments['product'];
		$images = [];

		//image from product
		$partNumber = $product['number'];

		//parts or snap
		$imageFile = $this->imagePath . $partNumber;
		if(preg_match('/^s.+/i', $partNumber)) {
			$imageFile = $this->imagePathSnap . $partNumber;
		}

		$i = 1;
		while ($i <= 15):
			if(file_exists($imageFile . "_0" . $i . ".jpg")) {
				$images[$i] = $imageFile . "_0" . $i . ".jpg";
			} else if(file_exists($imageFile . "_0" . $i . ".png")) {
				$images[$i] = $imageFile . "_0" . $i . ".png";
			}
			$i++;
		endwhile;

		return $images;
	}
}

?>
