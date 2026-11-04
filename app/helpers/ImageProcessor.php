<?php
/**
 * ImageProcessor - Обработка и оптимизация изображений
 */

class ImageProcessor
{
    private $uploadDir;
    private $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/gif'];
    private $maxSize = 26214400; // 25MB

    public function __construct()
    {
        $this->uploadDir = __DIR__ . '/../../public/uploads/';
    }

    /**
     * Загрузить и обработать изображение
     */
    public function upload($file)
    {
        // Проверка на ошибки
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Ошибка загрузки файла');
        }

        // Проверка типа файла
        if (!in_array($file['type'], $this->allowedTypes)) {
            throw new Exception('Недопустимый тип файла. Разрешены только JPEG и PNG');
        }

        // Проверка размера
        if ($file['size'] > $this->maxSize) {
            throw new Exception('Файл слишком большой. Максимальный размер 5MB');
        }

        // Генерируем уникальное имя
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '_' . time() . '.' . $extension;

        // Сохраняем оригинал
        $originalPath = $this->uploadDir . 'original/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $originalPath)) {
            throw new Exception('Ошибка сохранения файла');
        }

        // Создаем размеры
        $this->createThumbnail($originalPath, $this->uploadDir . 'large/' . $filename, 800, 600);
        $this->createThumbnail($originalPath, $this->uploadDir . 'medium/' . $filename, 400, 300);
        $this->createThumbnail($originalPath, $this->uploadDir . 'thumbnail/' . $filename, 100, 100);

        return $filename;
    }

    /**
     * Создать миниатюру изображения
     */
    private function createThumbnail($source, $destination, $width, $height)
    {
        list($origWidth, $origHeight, $type) = getimagesize($source);

        // Создаем изображение из источника
        switch ($type) {
            case IMAGETYPE_JPEG:
                $srcImage = imagecreatefromjpeg($source);
                break;
            case IMAGETYPE_PNG:
                $srcImage = imagecreatefrompng($source);
                break;
            case IMAGETYPE_WEBP:
                $srcImage = function_exists('imagecreatefromwebp') ? imagecreatefromwebp($source) : null;
                break;
            case IMAGETYPE_GIF:
                $srcImage = imagecreatefromgif($source);
                break;
            default:
                $srcImage = @imagecreatefromstring(file_get_contents($source));
                if (!$srcImage) {
                    throw new Exception('Неподдерживаемый тип изображения');
                }
        }

        // Вычисляем пропорции
        $ratio = min($width / $origWidth, $height / $origHeight);
        $newWidth = max(1, (int) ($origWidth * $ratio));
        $newHeight = max(1, (int) ($origHeight * $ratio));

        // Создаем новое изображение
        $dstImage = imagecreatetruecolor($newWidth, $newHeight);

        // Сохраняем прозрачность для PNG и WEBP
        if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_WEBP || $type == IMAGETYPE_GIF) {
            imagealphablending($dstImage, false);
            imagesavealpha($dstImage, true);
        }

        // Копируем и изменяем размер
        imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

        // Сохраняем
        switch ($type) {
            case IMAGETYPE_JPEG:
                imagejpeg($dstImage, $destination, 85);
                break;
            case IMAGETYPE_PNG:
                imagepng($dstImage, $destination, 8);
                break;
            case IMAGETYPE_WEBP:
                if (function_exists('imagewebp')) {
                    imagewebp($dstImage, $destination, 85);
                } else {
                    imagejpeg($dstImage, $destination, 85);
                }
                break;
            default:
                imagejpeg($dstImage, $destination, 85);
                break;
        }

        return true;
    }

    /**
     * Удалить изображение и все его версии
     */
    public function delete($filename)
    {
        $sizes = ['original', 'large', 'medium', 'thumbnail'];

        foreach ($sizes as $size) {
            $path = $this->uploadDir . $size . '/' . $filename;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        return true;
    }
}
