# Tracking Snippet

When you add a website to your plausible dashboard it will show you a tracking code that you can paste into your site that you want to track. This is what I use to make sure that we only track users on the live site (not on local development) and only logged in users:

```php
if(!$user->isLoggedin()) {
  echo '<script defer data-domain="'.$config->httpHost
    .'" src="https://plausible.verdino.com/js/plausible.js"></script>';
}
```

Providing a dynamic domain is handy because during development you can add a second website to your dashboard and see if everything works without messing up data of your live site account.

Example: We want to track the site "example.com", so we add this site to our plausible dashboard. Then we add the snippet with the dynamic domain attribute. On local development we have the host "example.com.ddev.site" so all visits will not show up in the plausible dashboard for example.com; Now we add another website to plausible with the domain "example.com.ddev.site" and voila - we will see our websites' visitors in realtime.
