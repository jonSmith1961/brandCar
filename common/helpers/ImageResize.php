<?php

namespace common\helpers;

use common\helpers\Gumlet as GumletImageResize;
use common\helpers\File;
use Gumlet\ImageResizeException;
use yii\caching\FileDependency;
use yii\helpers\ArrayHelper;

class ImageResize  {

	public static function resize($file_input, $file_output, $w_o, $h_o, $quality = 100) {
		if (! file_exists($file_input)) {
			return '';
		}

		list($w_i, $h_i, $type) = getimagesize($file_input);
		if (!$w_i || !$h_i) {
			echo 'Невозможно получить длину и ширину изображения';
			return false;
		}
		if ($w_o == $w_i && $h_o == $h_i) {
			file_put_contents($file_output, file_get_contents($file_input));
			return true;
		}
		$types = ['', 'gif', 'jpeg', 'png'];
		$types[18] = 'webp';
		$ext = $types[$type] ?? false;
		if (!$ext) {
			echo 'Некорректный формат файла';
			return false;
		}
		$image = new GumletImageResize($file_input);
		if (!$h_o) {
			$image->resizeToWidth($w_o);
		} elseif (!$w_o) {
			$image->resizeToHeight($h_o);
		} else {
			$image->crop($w_o, $h_o);
		}
		if ($ext == 'jpeg' && !empty($quality)) {
			$image->quality_jpg = $quality;
		}
		$image->save($file_output);
	}

    public static function resize_old($file_input, $file_output, $w_o, $h_o, $quality = 100) {
        if (! file_exists($file_input)) {
            return '';
        }

        list($w_i, $h_i, $type) = getimagesize($file_input);
        if (!$w_i || !$h_i) {
            echo 'Невозможно получить длину и ширину изображения';
            return false;
        }
        if ($w_o == $w_i && $h_o == $h_i) {
            file_put_contents($file_output, file_get_contents($file_input));
            return true;
        }
        $types = ['', 'gif', 'jpeg', 'png'];
        $ext = $types[$type];
        if ($ext) {
            $func = 'imagecreatefrom' . $ext;
            $img = $func($file_input);
        } else {
            echo 'Некорректный формат файла';
            return false;
        }
        if (!$h_o) {
            $h_o = $w_o / ($w_i / $h_i);
        }
        if (!$w_o) {
            $w_o = $h_o / ($h_i / $w_i);
        }
        $w_o_f = $w_o;
        $h_o_f = $h_o;
        if (($w_i / $w_o) > ($h_i / $h_o)) {
            $w_o = intval($w_i / ($h_i / $h_o));
        } elseif (($h_i / $h_o) > ($w_i / $w_o)) {
            $h_o = intval($h_i / ($w_i / $w_o));
        }
        $img_o = imagecreatetruecolor($w_o, $h_o);
        if ($type != IMAGETYPE_JPEG) {
            imagealphablending($img_o, false);
            imagesavealpha($img_o, true);
        }
        imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
        if ($type == IMAGETYPE_JPEG) {
            $resize = imagejpeg($img_o, $file_output, $quality);
        } else {
            $func = 'image' . $ext;
            $resize = $func($img_o, $file_output);
        }
        if ($resize) {
            $size = getimagesize($file_output);
            return self::crop($file_output, $file_output, [($size[0] - $w_o_f) / 2, ($size[1] - $h_o_f) / 2, ($size[0] - $w_o_f) / 2 + $w_o_f, ($size[1] - $h_o_f) / 2 + $h_o_f], $quality);
        }
    }

    public static function crop($file_input, $file_output, $crop, $quality) {
        list($w_i, $h_i, $type) = getimagesize($file_input);
        if (!$w_i || !$h_i) {
            echo 'Невозможно получить длину и ширину изображения';
            return false;
        }
        $types = array('', 'gif', 'jpeg', 'png');
        $ext = $types[$type];
        if ($ext) {
            $func = 'imagecreatefrom' . $ext;
            $img = $func($file_input);
        } else {
            echo 'Некорректный формат файла';
            return false;
        }
        list($x_o, $y_o, $w_o, $h_o) = $crop;
        if ($w_o < 0) {
            $w_o += $w_i;
        }
        $w_o -= $x_o;
        if ($h_o < 0) {
            $h_o += $h_i;
        }
        $h_o -= $y_o;
        $img_o = imagecreatetruecolor($w_o, $h_o);
        if ($type != IMAGETYPE_JPEG) {
            imagealphablending($img_o, false);
            imagesavealpha($img_o, true);
        }
        imagecopy($img_o, $img, 0, 0, $x_o, $y_o, $w_o, $h_o);
        if ($type == IMAGETYPE_JPEG) {
            imagejpeg($img_o, $file_output, $quality);
            //exec('jpegoptim --all-progressive -v --strip-all ' . $file_output);
            return true;
        } else {
            $func = 'image' . $ext;
            $func($img_o, $file_output);
            if ($ext == 'png') {
                //exec('optipng -o7 -strip all ' . $file_output);
            }
            return true;
        }
    }

	private static $fileDependency;

	private static $absolutePathArray;
	private static $webPathArray;

	private static $webpAbsolutePathArray;
	private static $webpWebPathArray;

	private static $fileIndex;
	private static $webpIndex;

	/**
	 * Создаем зависимость
	 * Выбрал файл импорта автомобилей с пробегом, так как это основной поставщик картинок
	 *
	 * @return null
	 */
	private static function fileDependency()
	{
		if (empty(self::$fileDependency)) {
			if (file_exists(CommonVars::$importTradeInTimeFile)) {
				self::$fileDependency = new FileDependency(['fileName' => CommonVars::$importTradeInTimeFile]);
			} else {
				self::$fileDependency = null;
			}
		}
		return self::$fileDependency;
	}

	/**
	 * Строит индекс всех картинок
	 *
	 * @return mixed
	 */
	private static function getFileIndex()
	{
		if (empty(self::$fileIndex)) {
			$fileDependency = (!empty(self::$fileDependency) ? self::$fileDependency : self::fileDependency());
			self::$fileIndex = \Yii::$app->cache->getOrSet([__FUNCTION__, 'image_index'], function () {
				$query = \Yii::$app->db
					->createCommand("SELECT 'id', 'filename' FROM file WHERE 'type' LIKE 'image%'")
					->queryAll();
				return ArrayHelper::map($query, 'id', 'filename');
			}, 86400, $fileDependency);
		}
		return self::$fileIndex;
	}

	/**
	 * На основе индекса картинок, формирует индекс, переводя расширение файлов в webp
	 *
	 * @return mixed
	 */
	private static function getWebpIndex()
	{
		if (empty(self::$webpIndex)) {
			$fileDependency = (!empty(self::$fileDependency) ? self::$fileDependency : self::fileDependency());
			$files = (!empty(self::$fileIndex) ? self::$fileIndex : self::getFileIndex());
			self::$webpIndex = \Yii::$app->cache->getOrSet([__FUNCTION__, 'webp_index'], function () use ($files) {
				$result = [];
				foreach ($files as $id => $filename) {
					$result[$id] = explode('.', $filename)[0] . '.webp';
				}
				return $result;
			}, 86400, $fileDependency);
		}
		return self::$webpIndex;
	}

	/**
	 * На основе индекса картинок, создает индекс с абсолютным путем к файлу
	 *
	 * @return mixed
	 */
	private static function getAbsolutePathArray()
	{
		if (empty(self::$absolutePathArray)) {
			$fileDependency = (!empty(self::$fileDependency) ? self::$fileDependency : self::fileDependency());
			$files = (!empty(self::$fileIndex) ? self::$fileIndex : self::getFileIndex());
			self::$absolutePathArray = \Yii::$app->cache->getOrSet([__FUNCTION__, 'absolute_path_array'], function () use ($files) {
				$result = [];
				$uploadDir = \Yii::getAlias('@upload');
				if (!empty($files)) {
					foreach ($files as $id => $filename) {
						$substr = substr($filename, 0, 2);
						$result[$id] = "{$uploadDir}/{$substr}/{$filename}";
					}
				}
				return $result;
			}, 86400, $fileDependency);
		}
		return self::$absolutePathArray;
	}

	/**
	 * На основе индекса картинок, создает индекс с путем от директории upload
	 *
	 * @return mixed
	 */
	private static function getWebPathArray()
	{
		if (empty(self::$webPathArray)) {
			$fileDependency = (!empty(self::$fileDependency) ? self::$fileDependency : self::fileDependency());
			$files = (!empty(self::$fileIndex) ? self::$fileIndex : self::getFileIndex());
			self::$webPathArray = \Yii::$app->cache->getOrSet([__FUNCTION__, 'web_path_array'], function () use ($files) {
				$result = [];
				if (!empty($files)) {
					foreach ($files as $id => $filename) {
						$substr = substr($filename, 0, 2);
						$result[$id] = "/upload/{$substr}/{$filename}";
					}
				}
				return $result;
			}, 86400, $fileDependency);
		}
		return self::$webPathArray;
	}

	/**
	 * На основе индекса картинок, создает индекс с абсолютным путем к файлу webp
	 * !!! Функция просто возвращает пути, никакой конвертаци не происходит !!!
	 *
	 * @return mixed
	 */
	private static function getWebpAbsolutePathArray()
	{
		if (empty(self::$webpAbsolutePathArray)) {
			$fileDependency = (!empty(self::$fileDependency) ? self::$fileDependency : self::fileDependency());
			$files = (!empty(self::$webpIndex) ? self::$webpIndex : self::getWebpIndex());
			self::$webpAbsolutePathArray = \Yii::$app->cache->getOrSet([__FUNCTION__, 'webp_absolute_path_array'], function () use ($files) {
				$result = [];
				$uploadDir = \Yii::getAlias('@upload');
				if (!empty($files)) {
					foreach ($files as $id => $filename) {
						$substr = substr($filename, 0, 2);
						$result[$id] = "{$uploadDir}/webp/{$substr}/{$filename}";
					}
				}
				return $result;
			}, 86400, $fileDependency);
		}
		return self::$webpAbsolutePathArray;
	}

	/**
	 * На основе индекса картинок, создает индекс с путем от директории upload к файлу webp
	 * !!! Функция просто возвращает пути, никакой конвертаци не происходит !!!
	 *
	 * @return mixed
	 */
	private static function getWebpWebPathArray()
	{
		if (empty(self::$webpWebPathArray)) {
			$fileDependency = (!empty(self::$fileDependency) ? self::$fileDependency : self::fileDependency());
			$files = (!empty(self::$webpIndex) ? self::$webpIndex : self::getWebpIndex());
			self::$webpWebPathArray = \Yii::$app->cache->getOrSet([__FUNCTION__, 'webp_web_path_array'], function () use ($files) {
				$result = [];
				if (!empty($files)) {
					foreach ($files as $id => $filename) {
						$substr = substr($filename, 0, 2);
						$result[$id] = "/upload/webp/{$substr}/{$filename}";
					}
				}
				return $result;
			}, 86400, $fileDependency);
		}
		return self::$webpWebPathArray;
	}

	/**
	 * Можно передать как ID файла, так и путь к файлу (абсолютный или относительный) в пределах папки /frontend/web/
	 *
	 * @param $data
	 *
	 * @return mixed|string|string[]|null
	 */
	private static function getAbsolutePath($data)
	{
		$frontend = \Yii::getAlias('@frontend');
		$upload = \Yii::getAlias('@upload');

		if (is_numeric($data)) {
			$files = (!empty(self::$absolutePathArray) ? self::$absolutePathArray : self::getAbsolutePathArray());
			$path = $files[$data] ?? null;
			if (empty($path)) {
				$file = File::findOne(['id' => $data]);
				if (!empty($file)) {
					$substr = substr($file->filename, 0, 2);
					return preg_replace('/\/+/', '/', "{$upload}/{$substr}/{$file->filename}");
				} else {
					return (new \Exception('File not found'))->getMessage();
				}
			} else {
				return $path;
			}
		} elseif (is_string($data)) {
			$path = preg_replace('/\/+/', '/', "{$upload}/{$data}");
			if (file_exists($path)) {
				return $path;
			} else {
				$path = preg_replace('/\/+/', '/', "{$frontend}/web/{$data}");
				if (file_exists($path)) {
					return $path;
				} else {
					return (new \Exception('File not found'))->getMessage();
				}
			}
		}
	}

	/**
	 * Можно передать как ID файла, так и путь к файлу (абсолютный или относительный) в пределах папки /frontend/web/
	 *
	 * @param $data
	 *
	 * @return mixed|string|string[]|null
	 */
	private static function getWebPath($data)
	{
		$path = self::getAbsolutePath($data);
		return preg_replace('/(.+\/web\/)(.+)/', '/$2', $path);
	}

	/**
	 * Можно передать как ID файла, так и путь к файлу (абсолютный или относительный) в пределах папки /frontend/web/
	 *
	 * @param $data
	 *
	 * @return mixed|string|string[]|null
	 */
	private static function getWebpAbsolutePath($data)
	{
		$upload = \Yii::getAlias('@upload');

		if (is_numeric($data)) {
			$files = (!empty(self::$webpAbsolutePathArray) ? self::$webpAbsolutePathArray : self::getWebpAbsolutePathArray());
			$path = $files[$data] ?? null;
			if (empty($path)) {
				$file = File::findOne(['id' => $data]);
				if (!empty($file)) {
					$filename = explode('.', $file->filename)[0] . '.webp';
					$substr = substr($filename, 0, 2);
					return preg_replace('/\/+/', '/', "{$upload}/webp/{$substr}/{$filename}");
				} else {
					return (new \Exception('File not found'))->getMessage();
				}
			} else {
				return $path;
			}
		} elseif (is_string($data)) {
			$filename = explode('.', basename($data))[0] . '.webp';
			$substr = substr($filename, 0, 2);
			$path = preg_replace('/\/+/', '/', "{$upload}/webp/{$substr}/{$filename}");
			if (file_exists($path)) {
				return $path;
			} else {
				return (new \Exception('File not found'))->getMessage();
			}
		}
	}

	/**
	 * Можно передать как ID файла, так и путь к файлу (абсолютный или относительный) в пределах папки /frontend/web/
	 *
	 * @param $data
	 *
	 * @return mixed|string|string[]|null
	 */
	private static function getWebpWebPath($data)
	{
		$path = self::getWebpAbsolutePath($data);
		return preg_replace('/(.+\/web\/)(.+)/', '/$2', $path);
	}

	/**
	 * @param $path
	 * @param $width
	 * @param $height
	 * @param $quality
	 *
	 * @return string|string[]|null
	 */
	private static function getResizedAbsolutePath($path, $width, $height, $quality)
	{
		$upload = \Yii::getAlias('@upload');
		$resize = preg_replace('/\/+/', '/', "{$upload}/resize/");
		@mkdir($resize);

		$filename = basename($path);
		$extension = explode('.', $filename)[1];
		$substr = substr($filename, 0, 2);
		$prefix = "{$width}_{$height}_{$quality}";

		if ($extension == 'webp') {
			@mkdir(preg_replace('/\/+/', '/', "{$resize}/webp/"));
			@mkdir(preg_replace('/\/+/', '/', "{$resize}/webp/{$prefix}"));
			@mkdir(preg_replace('/\/+/', '/', "{$resize}/webp/{$prefix}/{$substr}"));
			$resizedPath = preg_replace('/\/+/', '/', "{$resize}/webp/{$prefix}/{$substr}/{$filename}");
		} else {
			@mkdir(preg_replace('/\/+/', '/', "{$resize}/{$prefix}"));
			@mkdir(preg_replace('/\/+/', '/', "{$resize}/{$prefix}/{$substr}"));
			$resizedPath = preg_replace('/\/+/', '/', "{$resize}/{$prefix}/{$substr}/{$filename}");
		}

		return $resizedPath;
	}

	/**
	 * @param $path
	 * @param $width
	 * @param $height
	 * @param $quality
	 *
	 * @return string|string[]|null
	 */
	private static function getResizedWebPath($path, $width, $height, $quality)
	{
		$path = self::getResizedAbsolutePath($path, $width, $height, $quality);
		return preg_replace('/(.+\/web\/)(.+)/', '/$2', $path);
	}

	/**
	 * @param $path
	 * @param $width
	 * @param $height
	 * @param int $quality
	 *
	 * @return string|string[]|null
	 */
	private static function resizeImg($path, $width, $height, $quality = 95)
	{
		$absoluteResizePath = self::getResizedAbsolutePath($path, $width, $height, $quality);
		$webResizePath = self::getResizedWebPath($path, $width, $height, $quality);

		if (!file_exists($absoluteResizePath)) {
			ImageResize::resize($path, $absoluteResizePath, $width, $height, $quality);
		}

		return $webResizePath;
	}

	/**
	 * В функцию можно передавать как абсолютный путь, так и относительный
	 *
	 * @param $path
	 *
	 * @return mixed
	 * Возвращает при успешной конвертации абсолютный путь к файлу webp или ошибку, если файл не найден
	 *
	 * @throws ImageResizeException
	 */
	private static function convertToWebp($path)
	{
		$path = preg_replace('/(.+\/web\/)(.+)/', '/$2', $path);

		$frontend = \Yii::getAlias('@frontend');
		$upload = \Yii::getAlias('@upload');

		$originalFilename = basename($path);
		$webpFilename = explode('.', $originalFilename)[0] . '.webp';

		$substr = substr($originalFilename, 0, 2);

		$originalPath = preg_replace('/\/+/', '/', "{$frontend}/web/{$path}");
		$webpPath = preg_replace('/\/+/', '/', "{$upload}/webp/{$substr}/{$webpFilename}");

		if (file_exists($webpPath)) {
			return $webpPath;
		} else {
			if (file_exists($originalPath)) {
				@mkdir("{$upload}/webp/{$substr}");

				$webpImage = new Gumlet($originalPath);
				$webpImage->save($webpPath, IMAGETYPE_WEBP, 95);

				return $webpPath;
			} else {
				return (new \Exception('File not found'))->getMessage();
			}
		}
	}

	/**
	 * Вычисляем какой формат отдавать
	 *
	 * @return string
	 */
	private static function imageByDevice()
	{
		return 'webp';
	}

	/**
	 * Можно передать как ID файла, так и путь к файлу (абсолютный или относительный) в пределах папки /frontend/web/
	 *
	 * @param $data
	 * @param null $width
	 * @param null $height
	 *
	 * @return mixed|string|string[]|null
	 */
	public static function getPath($data, $width = null, $height = null)
	{
		$absolutePath = self::getAbsolutePath($data);
		if (file_exists($absolutePath)) {
			$absoluteWebpPath = self::getWebpAbsolutePath($data);

			[$w, $h, $type] = getimagesize($absolutePath);

			$outputFormat = self::imageByDevice();

			if ($outputFormat == 'webp' && !file_exists($absoluteWebpPath)) {
				try {
					$absoluteWebpPath = self::convertToWebp($absolutePath);
				} catch (ImageResizeException $e) {
					return $e->getMessage();
				}
			}

			if ((is_null($width) && is_null($height)) || ($width == $w && $height == $h)) {
//				if ($outputFormat == 'webp') {
//					return self::getWebpWebPath($absoluteWebpPath);
//				} else {
					return self::getWebPath($absolutePath);
//				}
			} elseif ((!is_null($width) && !is_null($height)) || ($width != $w && $height != $h)) {
//				if ($outputFormat == 'webp') {
//					return self::resizeImg($absoluteWebpPath, $width, $height);
//				} else {
					return self::resizeImg($absolutePath, $width, $height);
//				}
			}
		} else {
			return (new \Exception('File not found'))->getMessage();
		}
	}

	/**
	 * Функция для запуска по крону, форматирует все изображения из таблизы file в формат webp
	 *
	 * @return array
	 */
	public static function generateWebpImages()
	{
		$result = [];
		$files = (!empty(self::$absolutePathArray) ? self::$absolutePathArray : self::getAbsolutePathArray());

		foreach ($files as $id => $path) {
			try {
				$result[$id] = self::convertToWebp($path);
			} catch (ImageResizeException $e) {
				echo $e->getMessage();
			}
		}

		return $result;
	}

}
