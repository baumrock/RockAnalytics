<?php

namespace ProcessWire;

/**
 * @author Bernhard Baumrock, 04.10.2022
 * @license Licensed under MIT
 * @link https://www.baumrock.com
 */
class TextformatterRockAnalytics extends Textformatter
{
  public static function getModuleInfo()
  {
    return [
      'title' => 'RockAnalytics',
      'version' => '1.0.0',
      'summary' => 'Textformatter to render opt-out-link',
    ];
  }

  public function format(&$str)
  {
    $str = str_replace(
      "[rockanalytics-opt-out]",
      $this->wire->files->render(__DIR__ . "/TrackingToggle.php", [
        'rockanalytics' => $this->wire->modules->get('RockAnalytics'),
      ]),
      $str
    );
  }
}
