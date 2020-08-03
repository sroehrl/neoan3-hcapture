<?php

require_once dirname(__DIR__).'/Hcapture.php';

use Neoan3\Apps\Hcapture;
use PHPUnit\Framework\TestCase;

class HcaptureTest extends TestCase
{

    public function testIsHuman() : void
    {
        $this->fakeResponse();
        $this->assertTrue(Hcapture::isHuman());
    }

    public function testFailedIsHuman()
    {
        $this->fakeResponse(false);
        $this->assertFalse(Hcapture::isHuman());
    }

    private function fakeResponse($valid = true)
    {
        Hcapture::setEnvironment([
            'apiKey' => 'fake-will-always-fail',
            'secret' => '0x0000000000000000000000000000000000000000',
            'siteKey' => '10000000-ffff-ffff-ffff-000000000001'
        ]);
        $_POST['h-captcha-response'] = $valid ? '10000000-aaaa-bbbb-cccc-000000000001' : '10000000-aaaa-bbbb-cccc-000000000002';
    }
}
