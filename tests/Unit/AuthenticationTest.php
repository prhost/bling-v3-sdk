<?php

namespace Tests\Unit;

use Codeception\Attribute\After;
use Tests\Support\_generated\AcceptanceTesterActions;

class AuthenticationTest extends TestCaseBase
{
    use AcceptanceTesterActions;

    public function testRequestAuthorization()
    {
        global $authorization_code;

        $state = '123456789';

        $redirectUrl = $this->bling->requestAuthorization($state, null, false);

        $this->assertStringContainsString('oauth/authorize', $redirectUrl);
        $this->assertStringContainsString('client_id=' . $_ENV['CLIENT_ID'], $redirectUrl);
        $this->assertStringContainsString('state=' . '123456789', $redirectUrl);

        $phpBrowser = $this->getModule('PhpBrowser');
        $phpBrowser->amOnUrl($redirectUrl);

        $phpBrowser->fillField('login', $_ENV['BLING_LOGIN']);
        $phpBrowser->fillField('password', $_ENV['BLING_PASSWORD']);
        $phpBrowser->click('Entrar');

        $html = $phpBrowser->grabPageSource();

        if (strpos($html, 'Autorizar') !== false) {
            $phpBrowser->click('Autorizar');
        }

        $this->canSeeInCurrentUrl('code=');
        $this->canSeeInCurrentUrl('state=' . $state);
        $urlReturn = $phpBrowser->grabFromCurrentUrl();

        $url_components = parse_url($urlReturn);
        parse_str($url_components['query'], $query_params);
        $authorization_code = $query_params['code'] ?? null;
    }

    #[After('testRequestAuthorization')]
    public function testRequestToken()
    {
        global $authorization_code, $tokenResponse;

        $tokenResponse = $this->bling->requestToken($authorization_code);

        $this->assertObjectHasProperty('access_token', $tokenResponse);
        $this->assertObjectHasProperty('token_type', $tokenResponse);
        $this->assertObjectHasProperty('expires_in', $tokenResponse);
        $this->assertObjectHasProperty('refresh_token', $tokenResponse);
        $this->assertObjectHasProperty('scope', $tokenResponse);
    }

    #[After('testRequestToken')]
    public function testRefreshToken()
    {
        global $tokenResponse;

        $result = $this->bling->refreshToken($tokenResponse->refresh_token);

        $this->assertObjectHasProperty('access_token', $result);
        $this->assertObjectHasProperty('token_type', $result);
        $this->assertObjectHasProperty('expires_in', $result);
        $this->assertObjectHasProperty('refresh_token', $result);
        $this->assertObjectHasProperty('scope', $result);

        $this->assertNotEquals($tokenResponse->access_token, $result->access_token);
    }
}
