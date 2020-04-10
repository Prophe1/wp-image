# Image
This repository contains with image output scripts for WordPress.

## Usage
Install package with composer, add repository to your composer.json:
```
"repositories": [
    {
      "type": "git",
      "url": "https://github.com/Prophe1/wp-image.git"
    }
],
```
Then:
```
"prophe1/wp-image": "VERSION.dev"
```

Usage:
```
{!! \Prophe1\Wp\Image\Render::output($image_id, $default_size = null, $media_sizes = [], $format) !!}
```
## Parameter meaning
<table>
<tr>
<td><b>Parameter</b></td>
<td><b>Type</b></td>
<td><b>Meaning</b></td>
</tr>
<tr>
<td>$image_id</td>
<td>integer</td>
<td>Attachment post type ID</td>
</tr>
<tr>
<td>$default_size</td>
<td>string</td>
<td>Default image size, for example - thumbnail</td>
</tr>
<tr>
<td>$media_sizes</td>
<td>array</td>
<td>Array of sizes and media rules <br> array('thumbnail' => '(min-width: 551px)')</td>
</tr>
</table>