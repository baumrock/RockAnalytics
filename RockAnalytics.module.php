<?php

namespace ProcessWire;

/**
 * @author Bernhard Baumrock, 29.06.2022
 * @license Licensed under MIT
 * @link https://www.baumrock.com
 */
class RockAnalytics extends WireData implements Module, ConfigurableModule
{

  const textOptOut = "Anonymous statistics are enabled. Click here to disable.";
  const textOptIn = "Anonymous statistics are disabled. Click here to allow.";

  public static function getModuleInfo()
  {
    return [
      'title' => 'RockAnalytics',
      'version' => '1.0.4',
      'summary' => 'Module to easily include plausible dashboard into the PW backend',
      'autoload' => false,
      'singular' => true,
      'icon' => 'line-chart',
      'installs' => ['ProcessRockAnalytics'],
    ];
  }

  /**
   * Render the tracking tag
   */
  public function render($options = []): string
  {
    $opt = $this->wire(new WireData());
    $opt->setArray([
      'domain' => null,
      'src' => null,
      'defer' => true,
      'onlyGuests' => true,
    ]);
    $opt->setArray($options);

    if ($opt->onlyGuests and $this->wire->user->isLoggedin()) return '';

    return "<script
      id='RockAnalytics' defer
      data-domain='{$opt->domain}'
      data-src='{$opt->src}'
      >
      (function() {
        let enabled = !!parseInt(localStorage.getItem('RockAnalyticsTracking'));
        let el = document.getElementById('RockAnalytics');
        let script = document.createElement('script');
        script.setAttribute('defer', 'defer');
        script.setAttribute('data-domain', el.getAttribute('data-domain'));
        script.setAttribute('src', el.getAttribute('data-src'));
        document.head.appendChild(script);
      })()
      </script>";
  }

  public function textOptIn(): string
  {
    $lang = $this->wire->user->language;
    return $this->get("textOptIn__$lang|textOptIn") ?: self::textOptIn;
  }

  public function textOptOut(): string
  {
    $lang = $this->wire->user->language;
    return $this->get("textOptOut__$lang|textOptOut") ?: self::textOptOut;
  }

  /**
   * Config inputfields
   * @param InputfieldWrapper $inputfields
   */
  public function getModuleConfigInputfields($inputfields)
  {
    $inputfields->add([
      'type' => 'text',
      'name' => 'shareUrl',
      'label' => 'Share-URL',
      'value' => $this->shareUrl,
      'notes' => 'You can add &theme=light to your plausible share url!',
    ]);
    $inputfields->add([
      'type' => 'textarea',
      'name' => 'textOptOut',
      'notes' => "Default: " . self::textOptOut,
      'label' => 'Text for Tracking Opt-Out',
      'value' => $this->textOptOut,
      'useLanguages' => true,
    ]);
    $inputfields->add([
      'type' => 'textarea',
      'name' => 'textOptIn',
      'notes' => "Default: " . self::textOptIn,
      'label' => 'Text for Tracking Opt-In',
      'value' => $this->textOptIn,
      'useLanguages' => true,
    ]);
    return $inputfields;
  }
}
