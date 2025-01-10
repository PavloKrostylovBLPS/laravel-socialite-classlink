<?php

namespace SocialiteProviders\ClassLink;

use SocialiteProviders\Manager\SocialiteWasCalled;

class ClassLinkExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled): void
    {
        $socialiteWasCalled->extendSocialite('classlink', Provider::class);
    }
}
