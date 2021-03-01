<?php

namespace common\helpers;

class Gumlet extends \Gumlet\ImageResize
{
	/**
	 * Saves new image
	 *
	 * @param string $filename
	 * @param string $image_type
	 * @param integer $quality
	 * @param integer $permissions
     * @param boolean $exact_size
	 * @return static
	 */
	public function save($filename, $image_type = null, $quality = null, $permissions = null, $exact_size = false)
	{
		$image_type = $image_type ?: $this->source_type;
		$quality = is_numeric($quality) ? (int) abs($quality) : null;

		switch ($image_type) {
			case IMAGETYPE_GIF:
				$dest_image = imagecreatetruecolor($this->getDestWidth(), $this->getDestHeight());

				$background = imagecolorallocatealpha($dest_image, 255, 255, 255, 1);
				imagecolortransparent($dest_image, $background);
				imagefill($dest_image, 0, 0, $background);
				imagesavealpha($dest_image, true);
				break;

			case IMAGETYPE_JPEG:
				$dest_image = imagecreatetruecolor($this->getDestWidth(), $this->getDestHeight());

				$background = imagecolorallocate($dest_image, 255, 255, 255);
				imagefilledrectangle($dest_image, 0, 0, $this->getDestWidth(), $this->getDestHeight(), $background);
				break;

			case IMAGETYPE_WEBP:
				if (version_compare(PHP_VERSION, '5.5.0', '<')) {
					throw new ImageResizeException('For WebP support PHP >= 5.5.0 is required');
				}
				$dest_image = imagecreatetruecolor($this->getDestWidth(), $this->getDestHeight());

				$background = imagecolorallocate($dest_image, 255, 255, 255);
				imagefilledrectangle($dest_image, 0, 0, $this->getDestWidth(), $this->getDestHeight(), $background);
				break;

			case IMAGETYPE_PNG:
				if (!$this->quality_truecolor && !imageistruecolor($this->source_image)) {
					$dest_image = imagecreate($this->getDestWidth(), $this->getDestHeight());

					$background = imagecolorallocatealpha($dest_image, 255, 255, 255, 1);
					imagecolortransparent($dest_image, $background);
					imagefill($dest_image, 0, 0, $background);
				} else {
					$dest_image = imagecreatetruecolor($this->getDestWidth(), $this->getDestHeight());
				}

				imagealphablending($dest_image, false);
				imagesavealpha($dest_image, true);
				break;
		}

		imageinterlace($dest_image, $this->interlace);

		//imagegammacorrect($this->source_image, 2.2, 1.0);

		imagecopyresampled(
			$dest_image,
			$this->source_image,
			$this->dest_x,
			$this->dest_y,
			$this->source_x,
			$this->source_y,
			$this->getDestWidth(),
			$this->getDestHeight(),
			$this->source_w,
			$this->source_h
		);

		//imagegammacorrect($dest_image, 1.0, 2.2);


		$this->applyFilter($dest_image);

		switch ($image_type) {
			case IMAGETYPE_GIF:
				imagegif($dest_image, $filename);
				break;

			case IMAGETYPE_JPEG:
				if ($quality === null || $quality > 100) {
					$quality = $this->quality_jpg;
				}

				imagejpeg($dest_image, $filename, $quality);
				break;

			case IMAGETYPE_WEBP:
				if (version_compare(PHP_VERSION, '5.5.0', '<')) {
					throw new ImageResizeException('For WebP support PHP >= 5.5.0 is required');
				}
				if ($quality === null) {
					$quality = $this->quality_webp;
				}

				imagewebp($dest_image, $filename, $quality);
				break;

			case IMAGETYPE_PNG:
				if ($quality === null || $quality > 9) {
					$quality = $this->quality_png;
				}

				imagepng($dest_image, $filename, $quality);
				break;
		}

		if ($permissions) {
			chmod($filename, $permissions);
		}

		imagedestroy($dest_image);

		return $this;
	}
}