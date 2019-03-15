# image-mime-type-guesser
Detect / guess mime type of an image

This library is for you, if you need to determine if a file is of a given mime-type.

It first tries to determine this using `exif_imagetype`. If that fails, it tries `getimagesize`, and keep going through a stack of methods.

