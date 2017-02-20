<?php
namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class LinkPreviewsTwigExtension extends \Twig_Extension
{
    private function checkValues($value) {
      $value = trim($value);
      if (get_magic_quotes_gpc())
      {
        $value = stripslashes($value);
      }
      $value = strtr($value, array_flip(get_html_translation_table(HTML_ENTITIES)));
      $value = strip_tags($value);
      $value = htmlspecialchars($value);
      return $value;
    }

    private function fetch_record($path) {
      $file = fopen($path, "r");
      if (!$file)
      {
        exit("fopen failed");
      }
      $data = '';
      while (!feof($file))
      {
        $data .= fgets($file, 1024);
      }
      return $data;
    }

    public function getName()
    {
        return 'LinkPreviews';
    }

    public function getFilters()
    {
        return array(
            'linkPreview' => new Twig_Filter_Method($this, 'linkPreview'),
        );
    }

    public function linkPreview($url)
    {





      $url = $this->checkValues($url);
      $string = $this->fetch_record($url);
/// fecth title
// $title_regex = "/<title>(.+)<\/title>/i";
// preg_match_all($title_regex, $string, $title, PREG_PATTERN_ORDER);
// $url_title = $title[1];

/// fecth decription
// $tags = get_meta_tags($url);

// fetch images
      $image_regex = '/<img[^>]*'.'src=[\"|\'](.*)[\"|\']/Ui';
      preg_match_all($image_regex, $string, $img, PREG_PATTERN_ORDER);
      $images_array = $img[1];

      $k=1;
      for ($i=0;$i<=sizeof($images_array);$i++)
      {
        if(@$images_array[$i])
        {
          if(@getimagesize(@$images_array[$i]))
          {
            list($width, $height, $type, $attr) = getimagesize(@$images_array[$i]);
            if($width >= 250 && $height >= 250 ){
              return @$images_array[$i];
              $k++;
            }
          }
        }
      }
        // $output = array();
        //
        // foreach (str_split(intval($number)) as $digit) {
        //     $output[] = $this->digitToWord[$digit];
        // }
        //
        // return implode(' ', $output);
    }
}