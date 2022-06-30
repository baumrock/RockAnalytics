<?php namespace ProcessWire;
/**
 * @author Bernhard Baumrock, 30.06.2022
 * @license Licensed under MIT
 * @link https://www.baumrock.com
 */
class ProcessRockAnalytics extends Process {

  const permission_dashboard = "rockanalytics-dashboard";

  public static function getModuleInfo() {
    return [
      'title' => 'RockAnalytics Dashboard',
      'version' => '1.0.0',
      'summary' => 'Dasboard for RockAnalytics',
      'icon' => '',
      'requires' => ['RockAnalytics'],
      'installs' => [],

      'permission' => self::permission_dashboard,
      'permissions' => [
        self::permission_dashboard => 'May visit the RockAnalytics Dashboard',
      ],

      // page that you want created to execute this module
      'page' => [
        'name' => 'rockanalytics',
        'parent' => 2,
        'title' => 'Analytics'
      ],
    ];
  }

  public function init() {
    parent::init(); // always remember to call the parent init
  }

  public function execute() {
    $this->headline(' ');
    $this->browserTitle('Analytics');
    $url = $this->wire->modules->get('RockAnalytics')->shareUrl."&embed=true";
    $parts = explode("/", $url);
    $host = $parts[2];
    return '<iframe plausible-embed src="'.$url.'" scrolling="no" frameborder="0"
      loading="lazy" style="width: 1px; min-width: 100%; height: 1600px;"></iframe>
      <script async src="https://'.$host.'/js/embed.host.js"></script>
      ';
  }
}
