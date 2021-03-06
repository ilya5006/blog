<?php
    session_start();
    require_once "./database.php";

    $postName = $_POST['postName'];
    $postText = $_POST['postText'];
    $postTags = $_POST['postTags'];
    $postDate = date('Y-m-d H:i:s');

    // Возьмём id последнего на данный момент поста
    $lastPostId = Database::query("SELECT id_post FROM posts ORDER BY id_post DESC");
    $lastPostId = (int)$lastPostId['id_post'];

    $newPostId = ++$lastPostId;

    $isPostWithImage = is_uploaded_file($_FILES['postImage']['tmp_name']);
    
    if ($isPostWithImage)
    {
        // Перезапишем переменные для удобства
        $filePath  = $_FILES['postImage']['tmp_name'];
        $errorCode = $_FILES['postImage']['error'];

        // Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK)
        {
            // Массив с названиями ошибок
            $errorMessages = 
            [
                UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
                UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
                UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
            ];
            
            // Зададим неизвестную ошибку
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;

            // Выведем название ошибки
            die($outputMessage);
        }

        // Создадим ресурс FileInfo
        $fi = finfo_open(FILEINFO_MIME_TYPE);

        // Получим MIME-тип
        $mime = (string) finfo_file($fi, $filePath);

        // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
        if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

        // Результат функции запишем в переменную
        $image = getimagesize($filePath);

        $imageWidth = $image[0];
        $imageHeight = $image[1];

        // Зададим ограничения для картинок в 5 MB
        $limitBytes  = 1024 * 1024 * 5;
                    // KB     MB
        $limitWidth  = 1280;
        $limitHeight = 768;

        // Проверим нужные параметры
        if (filesize($filePath) > $limitBytes) die('Размер изображения не должен превышать 5 Мбайт.');
        if ($imageHeight > $limitHeight)       die('Высота изображения не должна превышать 768 точек.');
        if ($imageWidth > $limitWidth)         die('Ширина изображения не должна превышать 1280 точек.');

        // Сгенерируем новое имя файла на основе MD5-хеша
        $name = md5_file($filePath);

        // Сгенерируем расширение файла на основе типа картинки
        $extension = image_type_to_extension($image[2]);

        // Сократим .jpeg до .jpg
        $format = str_replace('jpeg', 'jpg', $extension);

        $folderForPostImage = '../../post_images/' . $newPostId;
        mkdir($folderForPostImage);

        // Переместим картинку с новым именем и расширением в папку /post_images
        if (!move_uploaded_file($filePath, '../../post_images/' . $newPostId . '/' . $name . $format)) 
        {
            die('При записи изображения на диск произошла ошибка.');
        }

        $postImage = $name . $format;

        Database::queryExecute("INSERT INTO posts VALUES ($newPostId, '$postName', '$postTags', '$postText', '$postDate', '$postImage')");
    }
    else
    {
        Database::queryExecute("INSERT INTO posts VALUES ($newPostId, '$postName', '$postTags', '$postText', '$postDate', NULL)");
    }

    header("Location: ../../blog.php");
?>