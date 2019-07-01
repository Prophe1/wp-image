# Image
This repository contains with image output scripts for WordPress.

## Usage
Add `use Prophe1\Image\Render;`<br>
<br>
Afterwards `Render::html($image_id, $default_size, $media_sizes);`

Or `Prophe1\Image\Render::html($image_id, $default_size, $media_sizes);`

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