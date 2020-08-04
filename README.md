# PHP hcaptcha 

[![Build Status](https://travis-ci.com/sroehrl/neoan3-hcapture.svg?branch=master)](https://travis-ci.com/sroehrl/neoan3-hcapture)
[![Maintainability](https://api.codeclimate.com/v1/badges/fd8425ca4b8d2d8cb2ca/maintainability)](https://codeclimate.com/github/sroehrl/neoan3-hcapture/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/fd8425ca4b8d2d8cb2ca/test_coverage)](https://codeclimate.com/github/sroehrl/neoan3-hcapture/test_coverage)

![hcaptcha header](https://assets-global.website-files.com/5c73e7ea3f8bb2a85d2781db/5c76851156b74e53ab8b2a27_hcaptha-logo-white.svg)

---

:warning: I'm not affiliated in any way with hCaptcha :warning:

---

Easy integration of [hCaptcha](https://hCaptcha.com/?r=20737c4f354f), a service that 

- Keeps bots out;
- Earns you money;
- Is privacy conscious.

## Quick start

1. Sign up at [hCaptcha](https://hCaptcha.com/?r=20737c4f354f).

2. Fetch your public key and site key from the [settings](https://dashboard.hcaptcha.com/settings) tab.

3. Get this package `composer require neoan3-apps/hcaptcha`

4. Set up your **front end** as:

```html
    <head>
        <script src="https://hcaptcha.com/1/api.js" async defer></script>
        ...
    </head>
    <body>
    
    <form action="endpoint.php" method="post">
        ...
        <div class="h-captcha" data-sitekey="your-sitekey"></div>
        <input type="submit" value="send">
    </form>
    
    </body>
```

5. Now in your PHP **back end**:

```php
   \Neoan3\Apps\Hcapture::setEnvironment([
       'siteKey' => 'your-sitekey',
       'secret' => 'your-secret',
       'apiKey' => 'your-api-key'
   ]); 
   if(isset($_POST['my-form']) && \Neoan3\Apps\Hcapture::isHuman())
   {
       ... do stuff
   }
```

## hCapture neoan3 API

Here are some methods for you to use and setup hCaptcha in your project.

### Environment setup

For your global environment setup, please use the following methods:

```php
// Set your own secret key
setSecret(string $value);

// API Key of hCaptcha linked to your account
setApiKey(string $value);

// Secret site key linked to your site
// See: https://docs.hcaptcha.com/api#addnewsitekey
setSiteKey(string $value);

// With an array of environment variables provided, set all of them
// This is a 'shortcut' for all three previous methods
setEnvironment(array $environmentVariables);
```

### hCaptcha utils

To retrieve hCaptcha information, here are the methods you will need:

```php
// Check if the hCaptcha verification was successful
isHuman();

// Retrieve all statitics of the site corresponding to the 
// provided variables (an error value is returned in case of
// invalid credentials)
stats();
```
    
## Advanced setup

You can have more details about advanced setup on [the configuration page](https://docs.hcaptcha.com/configuration) of the documentation.
