<?php
/**
 * Created by PhpStorm.
 * User: al.filippov
 * Date: 10.07.2020
 * Time: 9:20
 */

namespace common\helpers;


use backend\models\Files;
use frontend\helpers\ImageHelper;
use Yii;
use yii\base\Exception;
use yii\db\Query;
use yii\helpers\FileHelper;
use yii\helpers\Html;

class File extends FileHelper
{

	static $array_file_images_extension = [
		'jpg',
		'jpeg',
		'png'
	];

	static $string_file_images_extension = 'jpg, jpeg, png';

	/**
	 * Относительная ссылка на файл.
	 * Добавил проверку на наличие файла, если нету - тянем с боя.
	 *
	 * @param string $filename
	 *
	 * @return string
	 */
	public static function src($filename)
	{
		if (!$filename) {
			return false;
		}
		$substr = substr($filename, 0, 2);
		$rootPath = Yii::getAlias("@upload/{$substr}/{$filename}");
		$webPath = "/upload/{$substr}/{$filename}";
		if (file_exists($rootPath)) {
			$result = $webPath;
		} else {
			$result = Yii::$app->params['prodUrl'] . $webPath;
		}
		return $result;
	}

	/**
	 * Полный путь к файлу.
	 *
	 * @param string $filename
	 *
	 * @return string|null
	 */
	public static function filepath($filename)
	{
		if (!$filename) {
			return false;
		}
		$substr = substr($filename, 0, 2);
		$rootPath = Yii::getAlias("@upload/{$substr}/{$filename}");
		if (file_exists($rootPath)) {
			return $rootPath;
		} else {
			return null;
		}
	}

	public static function get_full_path($file_id)
	{
		if (empty($file_id)) return false;
		$img = Files::findOne($file_id);
		if (!$img) {
			echo 'Wrong file ID(' . $file_id . ')';
			return false;
		}
		$path = (YII_ENV_LOCAL ? DEV_HOST . '/upload/' : Yii::getAlias('@frontend') . '/web/upload/') . substr($img->filename, 0, 2) . '/' . $img->filename;

		$filename = basename($path);
		$file_full_path = Yii::getAlias('@frontend') . '/web/upload/'. substr($filename, 0, 2) . '/' . $filename;
		if (!file_exists($file_full_path)) {
			$file_full_path = false;
		}
		return $file_full_path;
	}

	public static function getPath($file, $domain = false)
	{
		$model = $file instanceof File ? $file : (is_array($file) ? $file : Files::findOne($file));
		if ($model) {
			$substr = substr($model['filename'], 0, 2);
			if ($domain) {
				$domain = CF::domain();
				return "{$domain}/upload/{$substr}/{$model['filename']}";
			} else {
				return "/upload/{$substr}/{$model['filename']}";
			}
		}
	}

	/**
	 * Получить фото (превью) нужного размера.
	 *
	 * @param string $filename Имя
	 * @param int $w Ширина
	 * @param int $h Высота
	 * @param int $quality Качество
	 *
	 * @return string
	 * @throws Exception
	 */
	public static function getResizedImageByName($filename, $w, $h, $quality = 100) : string
	{
		if (!$filename) {
			return false;
		}
		$substr = substr($filename, 0, 2);
		$imagePath = self::filepath($filename);
		$resizePath = "/upload/resize/{$substr}/{$w}_{$h}_{$quality}";
		$resizedUrl = "{$resizePath}/{$filename}";
		$resizedPath = Yii::getAlias("@resize/{$substr}/{$w}_{$h}_{$quality}");
		$resizedFile = "{$resizedPath}/{$filename}";

		if (!file_exists($imagePath)) {
			if (!YII_ENV_LOCAL) {
				return false;
			} else {
				return Yii::$app->params['prodUrl'] . $resizedUrl;
			}
		}

		self::createDirectory($resizedPath);
		if (!file_exists($resizedFile)) {
			ImageHelper::resizeImage($imagePath, $resizedFile, $w, $h, $quality);
		}
		return $resizedUrl;
	}

	public static function name2ext(string $name)
	{
		$name = explode('.', $name);
		return $name[array_key_last($name)];
	}

	public static function mime2ext(string $mime)
	{
		$mime_map = [
			'video/3gpp2' => '3g2',
			'video/3gp' => '3gp',
			'video/3gpp' => '3gp',
			'application/x-compressed' => '7zip',
			'audio/x-acc' => 'aac',
			'audio/ac3' => 'ac3',
			'application/postscript' => 'ai',
			'audio/x-aiff' => 'aif',
			'audio/aiff' => 'aif',
			'audio/x-au' => 'au',
			'video/x-msvideo' => 'avi',
			'video/msvideo' => 'avi',
			'video/avi' => 'avi',
			'application/x-troff-msvideo' => 'avi',
			'application/macbinary' => 'bin',
			'application/mac-binary' => 'bin',
			'application/x-binary' => 'bin',
			'application/x-macbinary' => 'bin',
			'image/bmp' => 'bmp',
			'image/x-bmp' => 'bmp',
			'image/x-bitmap' => 'bmp',
			'image/x-xbitmap' => 'bmp',
			'image/x-win-bitmap' => 'bmp',
			'image/x-windows-bmp' => 'bmp',
			'image/ms-bmp' => 'bmp',
			'image/x-ms-bmp' => 'bmp',
			'application/bmp' => 'bmp',
			'application/x-bmp' => 'bmp',
			'application/x-win-bitmap' => 'bmp',
			'application/cdr' => 'cdr',
			'application/coreldraw' => 'cdr',
			'application/x-cdr' => 'cdr',
			'application/x-coreldraw' => 'cdr',
			'image/cdr' => 'cdr',
			'image/x-cdr' => 'cdr',
			'zz-application/zz-winassoc-cdr' => 'cdr',
			'application/mac-compactpro' => 'cpt',
			'application/pkix-crl' => 'crl',
			'application/pkcs-crl' => 'crl',
			'application/x-x509-ca-cert' => 'crt',
			'application/pkix-cert' => 'crt',
			'text/css' => 'css',
			'text/x-comma-separated-values' => 'csv',
			'text/comma-separated-values' => 'csv',
			'application/vnd.msexcel' => 'csv',
			'application/x-director' => 'dcr',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
			'application/x-dvi' => 'dvi',
			'message/rfc822' => 'eml',
			'application/x-msdownload' => 'exe',
			'video/x-f4v' => 'f4v',
			'audio/x-flac' => 'flac',
			'video/x-flv' => 'flv',
			'image/gif' => 'gif',
			'application/gpg-keys' => 'gpg',
			'application/x-gtar' => 'gtar',
			'application/x-gzip' => 'gzip',
			'application/mac-binhex40' => 'hqx',
			'application/mac-binhex' => 'hqx',
			'application/x-binhex40' => 'hqx',
			'application/x-mac-binhex40' => 'hqx',
			'text/html' => 'html',
			'image/x-icon' => 'ico',
			'image/x-ico' => 'ico',
			'image/vnd.microsoft.icon' => 'ico',
			'text/calendar' => 'ics',
			'application/java-archive' => 'jar',
			'application/x-java-application' => 'jar',
			'application/x-jar' => 'jar',
			'image/jp2' => 'jp2',
			'video/mj2' => 'jp2',
			'image/jpx' => 'jp2',
			'image/jpm' => 'jp2',
			'image/jpeg' => 'jpeg',
			'image/pjpeg' => 'jpeg',
			'application/x-javascript' => 'js',
			'application/json' => 'json',
			'text/json' => 'json',
			'application/vnd.google-earth.kml+xml' => 'kml',
			'application/vnd.google-earth.kmz' => 'kmz',
			'text/x-log' => 'log',
			'audio/x-m4a' => 'm4a',
			'application/vnd.mpegurl' => 'm4u',
			'audio/midi' => 'mid',
			'application/vnd.mif' => 'mif',
			'video/quicktime' => 'mov',
			'video/x-sgi-movie' => 'movie',
			'audio/mpeg' => 'mp3',
			'audio/mpg' => 'mp3',
			'audio/mpeg3' => 'mp3',
			'audio/mp3' => 'mp3',
			'video/mp4' => 'mp4',
			'video/mpeg' => 'mpeg',
			'application/oda' => 'oda',
			'audio/ogg' => 'ogg',
			'video/ogg' => 'ogg',
			'application/ogg' => 'ogg',
			'application/x-pkcs10' => 'p10',
			'application/pkcs10' => 'p10',
			'application/x-pkcs12' => 'p12',
			'application/x-pkcs7-signature' => 'p7a',
			'application/pkcs7-mime' => 'p7c',
			'application/x-pkcs7-mime' => 'p7c',
			'application/x-pkcs7-certreqresp' => 'p7r',
			'application/pkcs7-signature' => 'p7s',
			'application/pdf' => 'pdf',
			'application/octet-stream' => 'pdf',
			'application/x-x509-user-cert' => 'pem',
			'application/x-pem-file' => 'pem',
			'application/pgp' => 'pgp',
			'application/x-httpd-php' => 'php',
			'application/php' => 'php',
			'application/x-php' => 'php',
			'text/php' => 'php',
			'text/x-php' => 'php',
			'application/x-httpd-php-source' => 'php',
			'image/png' => 'png',
			'image/x-png' => 'png',
			'application/powerpoint' => 'ppt',
			'application/vnd.ms-powerpoint' => 'ppt',
			'application/vnd.ms-office' => 'ppt',
			'application/msword' => 'doc',
			'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
			'application/x-photoshop' => 'psd',
			'image/vnd.adobe.photoshop' => 'psd',
			'audio/x-realaudio' => 'ra',
			'audio/x-pn-realaudio' => 'ram',
			'application/x-rar' => 'rar',
			'application/rar' => 'rar',
			'application/x-rar-compressed' => 'rar',
			'audio/x-pn-realaudio-plugin' => 'rpm',
			'application/x-pkcs7' => 'rsa',
			'text/rtf' => 'rtf',
			'text/richtext' => 'rtx',
			'video/vnd.rn-realvideo' => 'rv',
			'application/x-stuffit' => 'sit',
			'application/smil' => 'smil',
			'text/srt' => 'srt',
			'image/svg+xml' => 'svg',
			'application/x-shockwave-flash' => 'swf',
			'application/x-tar' => 'tar',
			'application/x-gzip-compressed' => 'tgz',
			'image/tiff' => 'tiff',
			'text/plain' => 'txt',
			'text/x-vcard' => 'vcf',
			'application/videolan' => 'vlc',
			'text/vtt' => 'vtt',
			'audio/x-wav' => 'wav',
			'audio/wave' => 'wav',
			'audio/wav' => 'wav',
			'application/wbxml' => 'wbxml',
			'video/webm' => 'webm',
			'audio/x-ms-wma' => 'wma',
			'application/wmlc' => 'wmlc',
			'video/x-ms-wmv' => 'wmv',
			'video/x-ms-asf' => 'wmv',
			'application/xhtml+xml' => 'xhtml',
			'application/excel' => 'xl',
			'application/msexcel' => 'xls',
			'application/x-msexcel' => 'xls',
			'application/x-ms-excel' => 'xls',
			'application/x-excel' => 'xls',
			'application/x-dos_ms_excel' => 'xls',
			'application/xls' => 'xls',
			'application/x-xls' => 'xls',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
			'application/vnd.ms-excel' => 'xlsx',
			'application/xml' => 'xml',
			'text/xml' => 'xml',
			'text/xsl' => 'xsl',
			'application/xspf+xml' => 'xspf',
			'application/x-compress' => 'z',
			'application/x-zip' => 'zip',
			'application/zip' => 'zip',
			'application/x-zip-compressed' => 'zip',
			'application/s-compressed' => 'zip',
			'multipart/x-zip' => 'zip',
			'text/x-scriptzsh' => 'zsh',
		];

		return isset($mime_map[$mime]) === true ? $mime_map[$mime] : false;
	}

	public static function ShowResizedImage($file, $w, $h, $options = [], $quality = 100)
	{
		echo static::GetResizedImage($file, $w, $h, $options, $quality);
	}

	public static function GetResizedImage($file, $w, $h, $options = [], $quality = 100)
	{
		if (is_null($file)) return false;
		$ar_img = (new Query())
			->from('files')
			->select(['filename','type'])
			->where(['id' => $file])
			->one();
		if (empty($ar_img['filename'])) {
			return false;
		}
		if (!empty($ar_img['type'])) {
			$ar_file_name = explode('/', $ar_img['type']);
			$type = ($ar_file_name[array_key_first($ar_file_name)]);
			if ($type != 'image') {
				return false;
			}

		}
		if (!is_dir(Yii::getAlias('@frontend') . '/web/upload/resize/')) {
			mkdir(Yii::getAlias('@frontend') . '/web/upload/resize/');
		}
		$path = (YII_ENV_LOCAL ? DEV_HOST . '/upload/' : Yii::getAlias('@frontend') . '/web/upload/') . '/' . substr($ar_img['filename'], 0, 2) . '/' . $ar_img['filename'];
		$resized_file_path = Yii::getAlias('@frontend') . '/web/upload/resize/' . $w . '_' . $h . '_' . $quality . '/' . substr($ar_img['filename'], 0, 2) . '/' . $ar_img['filename'];
		if (
			!file_exists($resized_file_path) &&
			!YII_ENV_LOCAL) {
			self::ResizeImage($path, $w, $h, $quality);
		}
		return Html::img('/upload/resize/' . $w . '_' . $h . '_' . $quality . '/' . substr($ar_img['filename'], 0, 2) . '/' . $ar_img['filename'], $options);
	}

	public static function ResizeImage($file_input, $w_o, $h_o, $quality = 100)
	{
		$file_output = str_replace('/upload/', '/upload/resize/' . $w_o . '_' . $h_o . '_' . $quality . '/', $file_input);
		@mkdir(Yii::getAlias('@frontend') . '/web/upload/resize/' . $w_o . '_' . $h_o . '_' . $quality . '/');
		@mkdir(Yii::getAlias('@frontend') . '/web/upload/resize/' . $w_o . '_' . $h_o . '_' . $quality . '/' . substr(basename($file_input), 0, 2));
		ImageResize::resize($file_input, $file_output, $w_o, $h_o, $quality);
		usleep(10000);
	}

	public static function getRealName($file)
	{
		$result = false;

		if(!empty($file)) {
			$file_obj = Files::findOne($file);

			if(!empty($file_obj)) {
				$ar_file_name = explode('.', $file_obj->filename);
				$ext = '.' . end($ar_file_name);

				$result = $file_obj->original_name . '' . $ext;
			}
		}

		return $result;
	}

	public static function isImage($file)
	{
		$result = false;

		if(!empty($file)) {
			$file_obj = Files::findOne($file);

			$ar_file_name = explode('/', $file_obj->type);
			$type = ($ar_file_name[array_key_first($ar_file_name)]);
			if ($type === 'image') {
				$result = true;
			}
		}

		return $result;

	}
	public static function isImageFile($file)
	{
		$result = false;

		if(!empty($file)) {

			$ar_file_name = explode('/', $file->type);
			$type = ($ar_file_name[array_key_first($ar_file_name)]);
			if ($type === 'image') {
				$result = true;
			}
		}

		return $result;

	}


	public static function checkContent($content)
	{
		if (!empty($content)) {
			// Create a new DOM Document to hold our webpage structure
			$xmlTest = new \DOMDocument('4.0', 'UTF-8');
			$xml = new \DOMDocument('4.0', 'UTF-8');
			$xml->substituteEntities = false;


			$xmlTest->preserveWhiteSpace = false;
			$xmlTest->formatOutput = true;

			libxml_use_internal_errors(true);

			if ($xmlTest->loadHTML($content)) {
				$errors = "";
//				$xml = XMLReader::
//				$xml->setParserProperty(XMLReader::VALIDATE, true);
				foreach (libxml_get_errors() as $error) {
					$errors .= $error->message . "<br/>";
				}
				libxml_clear_errors();

				if (strlen($errors)) {
					$content = "<b>Ошибка заполнения блока</b> <br>
                        Нарушена структура HTML<br>
                        libxml errors:<br>$errors";
					return $content;
				}
			}

			// Load the url's contents into the DOM
			$xml->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

			//Loop through each <a> tag in the dom and add it to the link array
			$findElementTrigger = true;
			$xml->encoding = "UTF-8";

			$contentXml = $xml->saveHTML($xml->documentElement);

			if ($findElementTrigger) {
				$content = $contentXml;
			}
		} else {
			$content = '';
		}
		//Return the contenet
		return $content;
	}

	public static function rdate($param, $time=0) {
		if(intval($time)==0)$time=time();
		$MonthNames=array("Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
		if(strpos($param,'M')===false) return date($param, $time);
		else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
	}
}