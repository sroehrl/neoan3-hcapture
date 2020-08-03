<?php

require_once '../Hcapture.php';

\Neoan3\Apps\Hcapture::setEnvironment([
    'siteKey' => '10000000-ffff-ffff-ffff-000000000001',
    'secret' => '0x0000000000000000000000000000000000000000',
]);

if (isset($_POST['test-me'])) {
    echo "h-captcha-response from client:" . $_POST['h-captcha-response'] . "<br>";
    echo "Is human:" . (\Neoan3\Apps\Hcapture::isHuman() ? 'yes' : 'no');
}