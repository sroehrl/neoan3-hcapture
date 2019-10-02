# PHP hcaptcha

Easy integration of [hcaptcha](https://hcaptcha.com), a service that 
- keeps bots out
- earns you money
- is privacy conscious

## Quick start

1. Sign up at [hcaptcha](https://hcaptcha.com) and get your secret & site key.

2. Get this package `composer require neoan3-apps/hcaptcha`

3. Frontend:

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
4. Backend
    ```PHP
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
    
## methods

### setEnvironment(array $environmentVariables)
### setSecret(string $value)
### setApiKey(string $value)
### setSiteKey(string $value)
### isHuman()
### stats()