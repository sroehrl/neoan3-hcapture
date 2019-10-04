# PHP hcaptcha 

![hcaptcha header](https://hcaptcha.com/static/img/hcaptcha-og_img.png)

---

:warning: I'm not affiliated in any way with hCaptcha :warning:

---

Easy integration of [hCaptcha](https://hcaptcha.com), a service that 

- Keeps bots out;
- Earns you money;
- Is privacy conscious.

## Quick start

1. Sign up at [hCaptcha](https://hcaptcha.com).

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
    
## Advanced setup

You can have more details about advanced setup on [the configuration page](https://docs.hcaptcha.com/configuration) of the documentation.
