# image-mime-type-guesser

[![Build Status](https://travis-ci.org/rosell-dk/image-mime-type-guesser.png?branch=master)](https://travis-ci.org/rosell-dk/image-mime-type-guesser)

*Detect / guess mime type of an image*

Do you need to determine if a file is an image? And perhaps you also want to know the mime type of the image?

Do you basically want something like `exif_imagetype`, but which also works when PHP is compiled without exif?

&ndash; You come to the right library.

This library uses `exif_imagetype` to determine the mime type. If it can be determined, it is returned. If it can be determined that it is not an image, it returns false. If nothing can be determined, it does the same thing, but this time using `getimagesize`. And then using `finfo`, and finally using `mime_content_type`.

Note that these methods all uses the mime type mapping on the server. Not all servers for example detects `image/webp`.


## Installation

Install with composer


## Usage

Use `ImageMimeTypeGuesser::detect` if you do not want the library to make a wild guess, but accept that the library may not be able to determine mime type.

Example:
```php
$result = ImageMimeTypeGuesser::detect($filePath);
if (is_null($result)) {
    // the mime type could not be determined
} elseif ($result === false) {
    // it is NOT an image
} else {
    // it is an image, and we know its mime type - for sure!
    $mimeType = $result;
}
```

If you are ok with wild guessing from extension, use `ImageMimeTypeGuesser::guess`.
It will either return the mime type of the image, or *false* if it is not an image.

*Warning*: Only a limited set of image extensions is recognized by the extension to mimetype mapper - namely the following: { bmp, gif, ico, jpg, jpeg, png, tif, tiff, webp, svg }. If you need some other specifically, feel free to add a PR, or ask me to do it by creating an issue.

Example:
```php
$result = ImageMimeTypeGuesser::guess($filePath);
if ($result !== false) {
    // it is an image, and we know its mime type (well, we don't really know, because we allowed guessing from extension)
    $mimeType = $result;
} else {
    // not an image
}
```

For convenience, you can use the following to test against allowed types, using `ImageMimeTypeGuesser::detectIsIn` and `ImageMimeTypeGuesser::guessIsIn`

Example:

```php
if (ImageMimeTypeGuesser::guessIsIn($filePath, ['image/jpeg','image/png']) {
    // Image is either a jpeg or a png (probably)
}
```
