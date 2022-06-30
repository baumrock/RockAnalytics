<?php namespace ProcessWire;
/**
 * @author Bernhard Baumrock, 29.06.2022
 * @license Licensed under MIT
 * @link https://www.baumrock.com
 */
class RockAnalytics extends WireData implements Module, ConfigurableModule {

  public static function getModuleInfo() {
    return [
      'title' => 'RockAnalytics',
      'version' => '1.0.0',
      'summary' => 'Module to easily include plausible dashboard into the PW backend',
      'autoload' => false,
      'singular' => true,
      'icon' => 'bar-chart',
      'installs' => ['ProcessRockAnalytics'],
    ];
  }

  /**
  * Config inputfields
  * @param InputfieldWrapper $inputfields
  */
  public function getModuleConfigInputfields($inputfields) {
    $inputfields->add([
      'type' => 'text',
      'name' => 'shareUrl',
      'label' => 'Share-URL',
      'value' => $this->shareUrl,
    ]);
    return $inputfields;
  }

}
