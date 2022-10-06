<img src=https://github.com/baumrock/RockAnalytics/raw/main/RockAnalytics.svg height=100>

### Integrate plausible analytics or umami into your ProcessWire backend

<img src=https://i.imgur.com/q7IIR5V.png>

<br>

Quickstart:

1. Install the module
1. Setup plausible analytics (either self hosted or paid cloud)
1. Copy the tracking code into your site's markup
1. Copy the share URL to your module's config

<img src=https://github.com/baumrock/RockAnalytics/raw/main/hr.svg>

## Support

https://processwire.com/talk/topic/27322-rockanalytics-integrate-plausible-analytics-into-your-processwire-backend/

<img src=https://github.com/baumrock/RockAnalytics/raw/main/hr.svg>

## Donations

[![img](https://github.com/baumrock/RockFinder3/raw/master/donate.svg)](https://paypal.me/baumrock)

😎🤗👍

<img src=https://github.com/baumrock/RockAnalytics/raw/main/hr.svg>

## About plausible analytics

Plausible is a "simple and privacy-friendly Google Analytics alternative". It is [open source](https://plausible.io/open-source-website-analytics) and you can either [self host it](https://plausible.io/self-hosted-web-analytics) or [buy one of their hosted services](https://plausible.io/#pricing). A live demo of their dashboard and its features can be found here: https://plausible.io/plausible.io

<img src=https://github.com/baumrock/RockAnalytics/raw/main/hr.svg>

## Tracking Snippet

### Tracking Snippet with Opt-Out Feature

GDPR allows collecting anonymous usage data without consent, but you need to provide an opt-out link on your privacy page. RockAnalytics comes with `TextformatterRockAnalytics` that will automatically render the necessary JS code to toggle tracking by the user (saved in localstorage).

It will turn this:

`[rockanalytics-toggle]`

...into that:

<img src=https://i.imgur.com/FYssLFA.gif>

Simply add `[rockanalytics-toggle]` to any textfield and apply the `TextformatterRockAnalytics` Textformatter. You can customise the rendered text (in every installed language) in the module's settings.

If you render the plausible script via the dedicated render() method RockAnalytics will only load the tracking script if the user did not opt out from tracking:

```php
// in your main markup file
echo $modules->get('RockAnalytics')->render([
  'domain' => $config->httpHost, // see description on next section
  'src' => 'https://plausible.yourdomain.com/js/plausible.js',
  'onlyGuests' => true, // only load script for guest users
]);
```

### Manual Snippet

**The recommended way is to use the dynamic snippet above! This section is kept for reference**

When you add a website to your plausible dashboard it will show you a tracking code that you can paste into your site that you want to track. This is what I use to make sure that we only track users on the live site (not on local development) and only logged in users:

```php
if(!$user->isLoggedin()) {
  $src = "https://--yourplausibleinstance--.com/js/plausible.js";
  echo "<script defer data-domain='{$config->httpHost}' src='$src'></script>";
}
```

Providing a dynamic domain is handy because during development you can add a second website to your dashboard and see if everything works without messing up data of your live site account.

Example: We want to track the site "example.com", so we add this site to our plausible dashboard. Then we add the snippet with the dynamic domain attribute. On local development we have the host "example.com.ddev.site" so all visits will not show up in the plausible dashboard for example.com; Now we add another website to plausible with the domain "example.com.ddev.site" and voila - we will see our dev-websites' visitors in realtime.

<img src=https://github.com/baumrock/RockAnalytics/raw/main/hr.svg>

## Backend Menu Item

By default RockAnalytics will create a menu item at the top level of your backend menu, but you can move that page to any place you like. For example you could move the analytics page under the "setup" page at the top of the screenshot. You can also rename the page if you don't like the label "Analytics".

<img src=https://i.imgur.com/WjkRU1Q.png width=300>
