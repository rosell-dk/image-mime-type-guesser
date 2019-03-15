# image-mime-type-guesser
*Detect / guess mime type of an image*

Do you need to determine if a file is an image? And perhaps you also want to know the mime type of the image?

Do you basically want something like `exif_imagetype`, but which also works when PHP is compiled without exif?

&ndash; You come to the right library.

This library uses `exif_imagetype` to determine the mime type. If it can be determined, it is returned. If it can be determined that it is not an image, it returns false. If nothing can be determined, it does the same thing, but this time using `getimagesize`. The pattern repeats through a whole stack of methods.

The final result is:

- The mime type (ie "image/jpeg"), if it is an image, and the mime type can be determined
- *false* if it can be determined that it is not an image
- *null* if nothing can be determined.

## Usage

- Install with composer
- Call ```ImageMimeTypeGuesser::detectMimeTypeImage($filePath);```
