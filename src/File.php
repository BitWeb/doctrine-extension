<?php

namespace BitWeb\DoctrineExtension;

use BitWeb\Stdlib\Util\StringUtil;
use Zend\Filter\File\RenameUpload;

class File extends \SplFileInfo
{
    const FILES_IN_DIRECTORY = 1000;
    const FILE_NAME_FORMAT = '%d-%s-%s';
    const MIME_TYPE_APPLICATION_ACAD = 'application/acad';
    const MIME_TYPE_APPLICATION_ACROBAT = 'application/acrobat';
    const MIME_TYPE_APPLICATION_DICOM = 'application/dicom';
    const MIME_TYPE_APPLICATION_DXF = 'application/dxf';
    const MIME_TYPE_APPLICATION_EPUB_ZIP = 'application/epub+zip';
    const MIME_TYPE_APPLICATION_EXCEL = 'application/excel';
    const MIME_TYPE_APPLICATION_GNUTAR = 'application/gnutar';
    const MIME_TYPE_APPLICATION_ICS = 'application/ics';
    const MIME_TYPE_APPLICATION_ILLUSTRATOR = 'application/illustrator';
    const MIME_TYPE_APPLICATION_MS_TNEF = 'application/ms-tnef';
    const MIME_TYPE_APPLICATION_MSPOWERPOINT = 'application/mspowerpoint';
    const MIME_TYPE_APPLICATION_MSWORD = 'application/msword';
    const MIME_TYPE_APPLICATION_OCTET_STREAM = 'application/octet-stream';
    const MIME_TYPE_APPLICATION_PDF = 'application/pdf';
    const MIME_TYPE_APPLICATION_PGP_ENCRYPTED = 'application/pgp-encrypted';
    const MIME_TYPE_APPLICATION_PGP_KEYS = 'application/pgp-keys';
    const MIME_TYPE_APPLICATION_PGP_SIGNATURE = 'application/pgp-signature';
    const MIME_TYPE_APPLICATION_PHOTOSHOP = 'application/photoshop';
    const MIME_TYPE_APPLICATION_PKCS10 = 'application/pkcs10';
    const MIME_TYPE_APPLICATION_PKCS7_MIME = 'application/pkcs7-mime';
    const MIME_TYPE_APPLICATION_PKCS7_SIGNATURE = 'application/pkcs7-signature';
    const MIME_TYPE_APPLICATION_PSD = 'application/psd';
    const MIME_TYPE_APPLICATION_POSTSCRIPT = 'application/postscript';
    const MIME_TYPE_APPLICATION_POWERPOINT = 'application/powerpoint';
    const MIME_TYPE_APPLICATION_SGML = 'application/sgml';
    const MIME_TYPE_APPLICATION_RTF = 'application/rtf';
    const MIME_TYPE_APPLICATION_TGA = 'application/tga';
    const MIME_TYPE_APPLICATION_VISIO = 'application/visio';
    const MIME_TYPE_APPLICATION_VISIO_DRAWING = 'application/visio.drawing ';
    const MIME_TYPE_APPLICATION_VND_AMAZON_EBOOK = 'application/vnd.amazon.ebook';
    const MIME_TYPE_APPLICATION_VND_APPLE_PKPASS = 'application/vnd.apple.pkpass';
    const MIME_TYPE_APPLICATION_VND_GOOGLE_EARTH_KML = 'application/vnd.google-earth.kmz';
    const MIME_TYPE_APPLICATION_VND_GOOGLE_EARTH_KML_XML = 'application/vnd.google-earth.kml+xml';
    const MIME_TYPE_APPLICATION_VND_GOOGLE_EARTH_KMZ = 'application/vnd.google-earth.kmz';
    const MIME_TYPE_APPLICATION_VND_MS_EXCEL = 'application/vnd.ms-excel';
    const MIME_TYPE_APPLICATION_VND_MS_OFFICE = 'application/vnd.ms-office';
    const MIME_TYPE_APPLICATION_VND_MS_POWERPOINT = 'application/vnd.ms-powerpoint';
    const MIME_TYPE_APPLICATION_VND_MSWORD = 'application/vnd.msword';
    const MIME_TYPE_APPLICATION_VND_OASIS_OPENDOCUMENT_FORMULA = 'application/vnd.oasis.opendocument.formula';
    const MIME_TYPE_APPLICATION_VND_OASIS_OPENDOCUMENT_PRESENTATION = 'application/vnd.oasis.opendocument.presentation';
    const MIME_TYPE_APPLICATION_VND_OASIS_OPENDOCUMENT_SPREADSHEET = 'application/vnd.oasis.opendocument.spreadsheet';
    const MIME_TYPE_APPLICATION_VND_OASIS_OPENDOCUMENT_SPREADSHEET_TEMPLATE = 'application/vnd.oasis.opendocument.spreadsheet-template';
    const MIME_TYPE_APPLICATION_VND_OASIS_OPENDOCUMENT_TEXT = 'application/vnd.oasis.opendocument.text';
    const MIME_TYPE_APPLICATION_VND_OPENXMLFORMATS_OFFICEDOCUMENT_PRESENTATIONML_PRESENTATION = 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
    const MIME_TYPE_APPLICATION_VND_OPENXMLFORMATS_OFFICEDOCUMENT_PRESENTATIONML_SLIDESHOW = 'application/vnd.openxmlformats-officedocument.presentationml.slideshow';
    const MIME_TYPE_APPLICATION_VND_OPENXMLFORMATS_OFFICEDOCUMENT_SPREADSHEETML_SHEET = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    const MIME_TYPE_APPLICATION_VND_OPENXMLFORMATS_OFFICEDOCUMENT_SPREADSHEETML_TEMPLATE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.template';
    const MIME_TYPE_APPLICATION_VND_OPENXMLFORMATS_OFFICEDOCUMENT_WORDPROCESSINGML_DOCUMENT = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    const MIME_TYPE_APPLICATION_VND_OPENXMLFORMATS_OFFICEDOCUMENT_WORDPROCESSINGML_TEMPLATE = 'application/vnd.openxmlformats-officedocument.wordprocessingml.template';
    const MIME_TYPE_APPLICATION_VND_RN_REALMEDIA = 'application/vnd.rn-realmedia';
    const MIME_TYPE_APPLICATION_VND_VISIO = 'application/vnd.visio ';
    const MIME_TYPE_APPLICATION_VSD = 'application/vsd';
    const MIME_TYPE_APPLICATION_X_BITTORRENT = 'application/x-bittorrent';
    const MIME_TYPE_APPLICATION_X_COMPRESSED = 'application/x-compressed';
    const MIME_TYPE_APPLICATION_X_DIRECTOR = 'application/x-director';
    const MIME_TYPE_APPLICATION_X_EXCEL = 'application/x-excel';
    const MIME_TYPE_APPLICATION_X_EMPTY = 'application/x-empty';
    const MIME_TYPE_APPLICATION_X_MIDI = 'application/x-midi';
    const MIME_TYPE_APPLICATION_X_MOBIPOCKET_EBOOK = 'application/x-mobipocket-ebook';
    const MIME_TYPE_APPLICATION_X_MS_READER = 'application/x-ms-reader';
    const MIME_TYPE_APPLICATION_X_MSEXCEL = 'application/x-msexcel';
    const MIME_TYPE_APPLICATION_X_OBAK = 'application/x-obak';
    const MIME_TYPE_APPLICATION_X_PKCS7_MIME = 'application/x-pkcs7-mime';
    const MIME_TYPE_APPLICATION_X_PKCS7_SIGNATURE = 'application/x-pkcs7-signature';
    const MIME_TYPE_APPLICATION_X_RAR_COMPRESSED = 'application/x-rar-compressed';
    const MIME_TYPE_APPLICATION_X_RPT = 'application/x-rpt';
    const MIME_TYPE_APPLICATION_X_RTF = 'application/x-rtf';
    const MIME_TYPE_APPLICATION_X_TARGA = 'application/x-targa';
    const MIME_TYPE_APPLICATION_X_TGA = 'application/x-tga';
    const MIME_TYPE_APPLICATION_X_TROFF_MSVIDEO = 'application/x-troff-msvideo';
    const MIME_TYPE_APPLICATION_X_VISIO = 'application/x-visio';
    const MIME_TYPE_APPLICATION_X_VND_OASIS_OPENDOCUMENT_FORMULA = 'application/x-vnd.oasis.opendocument.formula';
    const MIME_TYPE_APPLICATION_X_VND_OASIS_OPENDOCUMENT_PRESENTATION = 'application/x-vnd.oasis.opendocument.presentation';
    const MIME_TYPE_APPLICATION_X_VND_OASIS_OPENDOCUMENT_SPREADSHEET = 'application/x-vnd.oasis.opendocument.spreadsheet';
    const MIME_TYPE_APPLICATION_X_VND_OASIS_OPENDOCUMENT_SPREADSHEET_TEMPLATE = 'application/x-vnd.oasis.opendocument.spreadsheet-template';
    const MIME_TYPE_APPLICATION_X_VND_OASIS_OPENDOCUMENT_TEXT = 'application/x-vnd.oasis.opendocument.text';
    const MIME_TYPE_APPLICATION_X_VSD = 'application/x-vsd';
    const MIME_TYPE_APPLICATION_X_X509_CA_CERT = 'application/x-x509-ca-cert';
    const MIME_TYPE_APPLICATION_XHTML_XML = 'application/xhtml+xml';
    const MIME_TYPE_APPLICATION_XML = 'application/xml';
    const MIME_TYPE_APPLICATION_ZIP = 'application/zip';
    const MIME_TYPE_AUDIO_AIFF = 'audio/aiff';
    const MIME_TYPE_AUDIO_MIDI = 'audio/midi';
    const MIME_TYPE_AUDIO_MP4A_LATM = 'audio/mp4a-latm';
    const MIME_TYPE_AUDIO_MPEG = 'audio/mpeg';
    const MIME_TYPE_AUDIO_MPEG3 = 'audio/mpeg3';
    const MIME_TYPE_AUDIO_WAV = 'audio/wav';
    const MIME_TYPE_AUDIO_X_AIFF = 'audio/x-aiff';
    const MIME_TYPE_AUDIO_X_FLAC = 'audo/x-flac';
    const MIME_TYPE_AUDIO_X_MID = 'audio/x-mid';
    const MIME_TYPE_AUDIO_X_MIDI = 'audio/x-midi';
    const MIME_TYPE_AUDIO_X_MPEG = 'audio/x-mpeg';
    const MIME_TYPE_AUDIO_X_MPEG_3 = 'audio/x-mpeg-3';
    const MIME_TYPE_AUDIO_X_MS_WMA = 'audio/x-ms-wma';
    const MIME_TYPE_AUDIO_X_PN_REALAUDIO = 'audio/x-pn-realaudio';
    const MIME_TYPE_AUDIO_X_WAV = 'audio/x-wav';
    const MIME_TYPE_IMAGE_BMP = 'image/bmp';
    const MIME_TYPE_IMAGE_GIF = 'image/gif';
    const MIME_TYPE_IMAGE_JP2 = 'image/jp2';
    const MIME_TYPE_IMAGE_JPG = 'image/jpg';
    const MIME_TYPE_IMAGE_JPM = 'image/jpm';
    const MIME_TYPE_IMAGE_JPEG = 'image/jpeg';
    const MIME_TYPE_IMAGE_JPX = 'image/jpx';
    const MIME_TYPE_IMAGE_PJPEG = 'image/pjpeg';
    const MIME_TYPE_IMAGE_PDF = 'image/pdf';
    const MIME_TYPE_IMAGE_PHOTOSHOP = 'image/photoshop';
    const MIME_TYPE_IMAGE_PNG = 'image/png';
    const MIME_TYPE_IMAGE_PSD = 'image/psd';
    const MIME_TYPE_IMAGE_SVG_XML = 'image/svg+xml';
    const MIME_TYPE_IMAGE_TARGA = 'image/targa';
    const MIME_TYPE_IMAGE_TGA = 'image/tga';
    const MIME_TYPE_IMAGE_TIFF = 'image/tiff';
    const MIME_TYPE_IMAGE_TIFF_FX = 'image/tiff-fx';
    const MIME_TYPE_IMAGE_VND_DWG = 'image/vnd.dwg';
    const MIME_TYPE_IMAGE_VND_MICROSOFT_ICON = 'image/vnd.microsoft.icon';
    const MIME_TYPE_IMAGE_VND_WAP_WBMP = 'image/vnd.wap.wbmp';
    const MIME_TYPE_IMAGE_X_BMP = 'image/x-bmp';
    const MIME_TYPE_IMAGE_X_DICOM = 'image/x-dicom';
    const MIME_TYPE_IMAGE_X_DWG = 'image/x-dwg';
    const MIME_TYPE_IMAGE_X_MS_BMP = 'image/x-ms-bmp';
    const MIME_TYPE_IMAGE_X_TARGA = 'image/x-targa';
    const MIME_TYPE_IMAGE_X_TGA = 'image/x-tga';
    const MIME_TYPE_IMAGE_X_PHOTOSHOP = 'image/x-photoshop';
    const MIME_TYPE_IMAGE_X_WINDOWS_BMP = 'image/x-windows-bmp';
    const MIME_TYPE_MESSAGE_RFC822 = 'message/rfc822';
    const MIME_TYPE_MULTIPART = 'multipart/*';
    const MIME_TYPE_MUSIC_CRESCENDO = 'music/crescendo';
    const MIME_TYPE_TEXT_CALENDAR = 'text/calendar';
    const MIME_TYPE_TEXT_COMMA_SEPARATED_VALUES = 'text/comma-separated-values';
    const MIME_TYPE_TEXT_CSS = 'text/css';
    const MIME_TYPE_TEXT_CSV = 'text/csv';
    const MIME_TYPE_TEXT_HTML = 'text/html';
    const MIME_TYPE_TEXT_PLAIN = 'text/plain';
    const MIME_TYPE_TEXT_RICHTEXT = 'text/richtext';
    const MIME_TYPE_TEXT_RTF = 'text/rtf';
    const MIME_TYPE_TEXT_SGML = 'text/sgml';
    const MIME_TYPE_TEXT_TAB_SEPARATED_VALUES = 'text/tab-separated-values';
    const MIME_TYPE_TEXT_VND_WAP_WML = 'text/vnd.wap.wml';
    const MIME_TYPE_TEXT_X_C = 'text/x-c';
    const MIME_TYPE_TEXT_X_JAVA_SOURCE = 'text/x-java-source';
    const MIME_TYPE_TEXT_X_SCRIPT_PHYTON = 'text/x-script.phyton';
    const MIME_TYPE_TEXT_X_VCARD = 'text/x-vcard';
    const MIME_TYPE_TEXT_XML = 'text/xml';
    const MIME_TYPE_VIDEO_3GPP = 'video/3gpp';
    const MIME_TYPE_VIDEO_3GPP2 = 'video/3gpp2';
    const MIME_TYPE_VIDEO_AVI = 'video/avi';
    const MIME_TYPE_VIDEO_MP4 = 'video/mp4';
    const MIME_TYPE_VIDEO_MPEG = 'video/mpeg';
    const MIME_TYPE_VIDEO_MSVIDEO = 'video/msvideo';
    const MIME_TYPE_VIDEO_OGG = 'video/ogg';
    const MIME_TYPE_VIDEO_QUICKTIME = 'video/quicktime';
    const MIME_TYPE_VIDEO_X_FLV = 'video/x-flv';
    const MIME_TYPE_VIDEO_X_M4V = 'video/x-m4v';
    const MIME_TYPE_VIDEO_X_MPEG = 'video/x-mpeg';
    const MIME_TYPE_VIDEO_X_MS_ASF = 'video/x-ms-asf';
    const MIME_TYPE_VIDEO_X_MS_WMV = 'video/x-ms-wmv';
    const MIME_TYPE_VIDEO_X_MSVIDEO = 'video/x-msvideo';
    const MIME_TYPE_X_MUSIC_X_MIDI = 'x-music/x-midi';
    const EXTENSION_3G2 = '3g2';
    const EXTENSION_3GP = '3gp';
    const EXTENSION_AEH = 'aeh';
    const EXTENSION_AI = 'ai';
    const EXTENSION_AIF = 'aif';
    const EXTENSION_AIFF = 'aiff';
    const EXTENSION_ASC = 'asc';
    const EXTENSION_ASF = 'asf';
    const EXTENSION_ASX = 'asx';
    const EXTENSION_AVI = 'avi';
    const EXTENSION_AZW = 'azw';
    const EXTENSION_BMP = 'bmp';
    const EXTENSION_C = 'c';
    const EXTENSION_CPP = 'cpp';
    const EXTENSION_CSS = 'css';
    const EXTENSION_CSV = 'csv';
    const EXTENSION_DAT = 'dat';
    const EXTENSION_DCM = 'dcm';
    const EXTENSION_DICOM = 'dicom';
    const EXTENSION_DIFF = 'diff';
    const EXTENSION_DOC = 'doc';
    const EXTENSION_DOCX = 'docx';
    const EXTENSION_DOTX = 'dotx';
    const EXTENSION_EPS = 'eps';
    const EXTENSION_EPUB = 'epub';
    const EXTENSION_EXE = 'exe';
    const EXTENSION_FB2 = 'fb2';
    const EXTENSION_FLAC = 'flac';
    const EXTENSION_GIF = 'gif';
    const EXTENSION_H = 'h';
    const EXTENSION_HTM = 'htm';
    const EXTENSION_HTML = 'html';
    const EXTENSION_IBA = 'iba';
    const EXTENSION_ICAL = 'ical';
    const EXTENSION_ICALENDAR = 'icalendar';
    const EXTENSION_ICO = 'ico';
    const EXTENSION_ICS = 'ics';
    const EXTENSION_IFB = 'ifb';
    const EXTENSION_IMG = 'img';
    const EXTENSION_ISO = 'iso';
    const EXTENSION_JAVA = 'java';
    const EXTENSION_JP2 = 'jp2';
    const EXTENSION_JPE = 'jpe';
    const EXTENSION_JPEG = 'jpeg';
    const EXTENSION_JPG = 'jpg';
    const EXTENSION_JPM = 'jpm';
    const EXTENSION_JPX = 'jpx';
    const EXTENSION_KEY = 'key';
    const EXTENSION_KF8 = 'kf8';
    const EXTENSION_KML = 'kml';
    const EXTENSION_KMZ = 'kmz';
    const EXTENSION_LIT = 'lit';
    const EXTENSION_LOG = 'log';
    const EXTENSION_M4A = 'm4a';
    const EXTENSION_M4B = 'm4b';
    const EXTENSION_M4P = 'm4p';
    const EXTENSION_M4V = 'm4v';
    const EXTENSION_MID = 'mid';
    const EXTENSION_MIDI = 'midi';
    const EXTENSION_MOBI = 'mobi';
    const EXTENSION_MOV = 'mov';
    const EXTENSION_MP3 = 'mp3';
    const EXTENSION_MP4 = 'mp4';
    const EXTENSION_MPE = 'mpe';
    const EXTENSION_MPG = 'mpg';
    const EXTENSION_OGG = 'ogg';
    const EXTENSION_ODF = 'odf';
    const EXTENSION_ODS = 'ods';
    const EXTENSION_ODT = 'odt';
    const EXTENSION_OTS = 'ots';
    const EXTENSION_P10 = 'p10';
    const EXTENSION_P7C = 'p7c';
    const EXTENSION_P7M = 'p7m';
    const EXTENSION_P7S = 'p7s';
    const EXTENSION_PDF = 'pdf';
    const EXTENSION_PHP = 'php';
    const EXTENSION_PEM = 'pem';
    const EXTENSION_PJPG = 'pjpg';
    const EXTENSION_PKPASS = 'pkpass';
    const EXTENSION_PNG = 'png';
    const EXTENSION_PPSX = 'ppsx';
    const EXTENSION_PPT = 'ppt';
    const EXTENSION_PPTX = 'pptx';
    const EXTENSION_PS = 'ps';
    const EXTENSION_PSD = 'psd';
    const EXTENSION_QT = 'qt';
    const EXTENSION_RA = 'ra';
    const EXTENSION_RAM = 'ram';
    const EXTENSION_RM = 'rm';
    const EXTENSION_RPT = 'rpt';
    const EXTENSION_RTF = 'rtf';
    const EXTENSION_RTX = 'rtx';
    const EXTENSION_SGML = 'sgml';
    const EXTENSION_SIG = 'sig';
    const EXTENSION_SQL = 'sql';
    const EXTENSION_SVG = 'svg';
    const EXTENSION_ZIP = 'zip';
    const EXTENSION_TARGA = 'targa';
    const EXTENSION_TEXT = 'text';
    const EXTENSION_TFX = 'tfx';
    const EXTENSION_TGA = 'tga';
    const EXTENSION_TIF = 'tif';
    const EXTENSION_TIFF = 'tiff';
    const EXTENSION_TORRENT = 'torrent';
    const EXTENSION_TSV = 'tsv';
    const EXTENSION_TWB = 'twb';
    const EXTENSION_TWBX = 'twbx';
    const EXTENSION_TXT = 'txt';
    const EXTENSION_VCARD = 'vcard';
    const EXTENSION_VCF = 'vcf';
    const EXTENSION_VSD = 'vsd';
    const EXTENSION_WAV = 'wav';
    const EXTENSION_WBMP = 'wbmp';
    const EXTENSION_WMA = 'wma';
    const EXTENSION_WML = 'wml';
    const EXTENSION_WMV = 'wmv';
    const EXTENSION_XHTML = 'xhtml';
    const EXTENSION_XLS = 'xls';
    const EXTENSION_XLSX = 'xlsx';
    const EXTENSION_XLTX = 'xltx';
    const EXTENSION_XML = 'xml';
    private $basePath;
    private $baseUploadPath;
    protected $classPath;
    protected $relativeFileName;
    protected $relativeBasePath;
    protected $isNewObjectRequired = false;
    protected static $defaultBasePath;
    protected static $defaultUploadBasePath;
    protected static $thumbnailSizes;
    protected static $thumbnailNameAssembler;
    private $isLoaded = false;

    public function __construct($fileName = null, $basePath = null, $isLoaded = false)
    {
        $this->relativeFileName = $fileName;
        parent::__construct($this->getFilePath($basePath));

        if ($basePath == null) {
            $basePath = self::$defaultBasePath;
        }

        $this->basePath = $basePath;

        $this->setLoaded($isLoaded);
        if ($this->isLoaded()) {
            $this->init();
        }
    }

    protected function init()
    {
    }

    public static final function setDefaultBasePath($basePath)
    {
        self::$defaultBasePath = $basePath;
    }

    public static final function getDefaultBasePath()
    {
        return self::$defaultBasePath;
    }

    public static final function setDefaultUploadBasePath($uploadBasePath)
    {
        self::$defaultUploadBasePath = $uploadBasePath;
    }

    public static final function getDefaultUploadBasePath()
    {
        return self::$defaultUploadBasePath;
    }

    public final function getBasePath()
    {
        return $this->basePath;
    }

    public final function getBaseFileName()
    {
        return $this->basePath . $this->relativeFileName;
    }

    public final function getRelativeFileName()
    {
        return $this->relativeFileName;
    }

    public final function getRelativeBasePath()
    {
        return $this->relativeBasePath;
    }

    public final function setRelativeBasePath($relativeBasePath)
    {
        $this->relativeBasePath = $relativeBasePath;
    }

    public final function getClassPath()
    {
        return $this->classPath;
    }

    public final function setClassPath($classPath)
    {
        $this->classPath = $classPath;
    }

    public final function isNewObjectRequired()
    {
        return $this->isNewObjectRequired;
    }

    public function autoRename($entity, $fieldName, $copy = false)
    {
        //echo '<b>called auto rename</b><br>';
        if ($this->relativeFileName == null) {
            //echo '<font color="red">relative file name was NULL, nothing to rename</font><br>';
            return $this;
        }

        if ($this->classPath == null) {
            $this->classPath = $this->assembleClassPathFromClassName(get_class($entity));
        }
        $classPath = $this->classPath;

        $directory = DIRECTORY_SEPARATOR . $classPath . DIRECTORY_SEPARATOR . $this->getAutoDirectory($entity->getId());

        if (!is_dir($this->basePath . $this->relativeBasePath . $directory)) {
            mkdir($this->basePath . $this->relativeBasePath . $directory, 0775, true);
        }

        $newFileName = sprintf(self::FILE_NAME_FORMAT, $entity->getId(), $fieldName, StringUtil::urlify($this->getFilename(), array(
            '\.'
        )));

        if ($copy) {
            if ($this->getRealPath() == null) {
                throw new \RuntimeException ('File upload failed!', 500);
            }
            //echo 'trying to copy: ' . $this->getRealPath() .' -to->' . $this->basePath . $this->relativeBasePath . $directory . DIRECTORY_SEPARATOR . $newFileName.'<br>';
            copy($this->getRealPath(), $this->basePath . $this->relativeBasePath . $directory . DIRECTORY_SEPARATOR . $newFileName);
        } else {
            //echo 'trying to rename: ' . $this->getRealPath() .' -to->' . $this->basePath . $this->relativeBasePath . $directory . DIRECTORY_SEPARATOR . $newFileName.'<br>';
            rename($this->getRealPath(), $this->basePath . $this->relativeBasePath . $directory . DIRECTORY_SEPARATOR . $newFileName);
        }
        $this->relativeFileName = $this->relativeBasePath . $directory . DIRECTORY_SEPARATOR . $newFileName;

        $className = get_class($this); // Needed for extending

        $newInstance = new $className($this->relativeFileName, $this->getBasePath(), true);

        return $newInstance;
    }

    public function delete()
    {
        if (!$this->relativeFileName == null) {
            // echo 'trying to unlink: '.$this->getRealPath().'<br>';
            if (file_exists($this->getRealPath())) {
                @unlink($this->getRealPath());
            }
        }
    }

    public function getMimeType()
    {
        return mime_content_type($this->getRealPath());
    }

    public final function setLoaded($isLoaded = true)
    {
        $this->isLoaded = $isLoaded;

        return $this;
    }

    public final function isLoaded()
    {
        return $this->isLoaded;
    }

    public function getThumbnailName($size, $mimeType = null, $extension = null)
    {
        if (self::$thumbnailSizes == null) {
            throw new \RuntimeException (sprintf('Thumbnail sizes not specified.'));
        }
        if (!isset (self::$thumbnailSizes [$size])) {
            throw new \InvalidArgumentException (sprintf('Thumbnail size "%1$s" is not among the available sizes: %2$s.', $size, implode(', ', self::$thumbnailSizes)));
        }
        if (self::$thumbnailNameAssembler == null) {
            throw new \RuntimeException (sprintf('No thumbnail name assembler specified... Can not find thumbnail for %1$s', get_class($this)));
        }

        $func = self::$thumbnailNameAssembler; // FIXME Maybe fixed in new PHP?

        return $func ($size, ($mimeType != null) ? $mimeType : $this->getMimeType(), ($extension != null) ? $extension : $this->getExtension());
    }

    private function getAutoDirectory($id, $directory = 1)
    {
        if ($id <= self::FILES_IN_DIRECTORY * $directory) {
            return $directory;
        } else {
            return $this->getAutoDirectory($id, ++$directory);
        }
    }

    protected function getFilePath($basePath = null)
    {
        if ($basePath == null) {
            $basePath = $this->getBaseUploadPath();
        }

        return $basePath . DIRECTORY_SEPARATOR . $this->relativeFileName;
    }

    protected function getBaseUploadPath()
    {
        if ($this->baseUploadPath == null) {
            $this->baseUploadPath = self::$defaultUploadBasePath;
        }
        if ($this->baseUploadPath == null) {
            $this->baseUploadPath = $this->basePath;
        }

        return $this->baseUploadPath;
    }

    protected function rename($newFileName)
    {
        if ($this->relativeFileName != null && $this->isNewObjectRequired) {
            rename($this->getRealPath(), $this->basePath . $newFileName);
            $className = get_class($this); // Needed for extending
            $newInstance = new $className ($this->relativeFileName, $this->basePath, true);

            return $newInstance;
        }

        return $this;
    }

    protected function assembleClassPathFromClassName($className)
    {
        return str_replace('\\', '_', $className);
    }

    public static function setThumbnailSizes(array $sizes)
    {
        self::$thumbnailSizes = $sizes;
    }

    public static function setThumbnailNameAssembler(\Closure $thumbnailNameAssembler)
    {
        self::$thumbnailNameAssembler = $thumbnailNameAssembler;
    }

    /**
     * @param array $fileData
     * @return static
     * @throws \InvalidArgumentException
     */
    public static function upload(array $fileData)
    {
        if (!is_array($fileData)) {

            throw new \InvalidArgumentException('Invalid fileData for upload');
        }
        if (!isset($fileData['name']) && count($fileData) == 1) {

            return self::upload(array_pop($fileData));
        }
        $renameUpload = new RenameUpload(self::getDefaultUploadBasePath() . DIRECTORY_SEPARATOR . $fileData['name']);
        $renameUpload->filter($fileData);

        return new static($fileData['name']);
    }

    public static function uploadMany($filesData)
    {
        $files = array();
        foreach ($filesData as $fileData) {
            $files[] = self::upload($fileData);
        }

        return $files;
    }

    public static function uploadFromUrl($url)
    {
        $fileStream = fopen($url, 'r');
        if ($fileStream === false) {

            return false;
        }
        $fileBasename = basename($url);

        $success = file_put_contents(File::getDefaultUploadBasePath() . DIRECTORY_SEPARATOR . $fileBasename, $fileStream);
        if (!$success) {

            throw new \RuntimeException(sprintf('File from url %1$s could not be received', $url));
        }

        return new static($fileBasename);
    }

    public static function copy(File $file)
    {
        $path = $file->getPathname();
        $uploadPath = static::getDefaultUploadBasePath();
        if (!file_exists($path)) {

            return false;
        }
        copy($path, $uploadPath . DIRECTORY_SEPARATOR . basename($path));

        return new static(basename($path));
    }

    public static function uploadFromRaw($raw, $name)
    {
        $uploadPath = static::getDefaultUploadBasePath();

        file_put_contents($uploadPath . DIRECTORY_SEPARATOR . basename($name), $raw);

        return new static(basename($name));
    }
}
