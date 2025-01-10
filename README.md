# ClassLink OpenID Connect (OIDC) Provider for Laravel Socialite

![Laravel Support: v9, v10, v11](https://img.shields.io/badge/Laravel%20Support-v9%2C%20v10%2C%20v11-blue) ![PHP Support: 8.1, 8.2, 8.3](https://img.shields.io/badge/PHP%20Support-8.1%2C%208.2%2C%208.3-blue)

## Installation & Basic Usage

Please see the [Base Installation Guide](https://socialiteproviders.com/usage/), then follow the provider specific instructions below.

### Add configuration to `config/services.php`

```php
'classlink' => [
    'client_id' => env('CLASSLINK_CLIENT_ID'),
    'client_secret' => env('CLASSLINK_CLIENT_SECRET'),
    'redirect' => env('CLASSLINK_REDIRECT_URI'),
],
```

### Add provider event listener

Configure the package's listener to listen for `SocialiteWasCalled` events.

#### Laravel 11+

In Laravel 11, the default `EventServiceProvider` provider was removed. Instead, add the listener using the `listen` method on the `Event` facade, in your `AppServiceProvider` `boot` method.

```php
Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
    $event->extendSocialite('auth0', \SocialiteProviders\Auth0\Provider::class);
});
```

#### Laravel 10 or below

Add the event to your listen[] array in `app/Providers/EventServiceProvider`. See the [Base Installation Guide](https://socialiteproviders.com/usage/) for detailed instructions.

```php
protected $listen = [
    \SocialiteProviders\Manager\SocialiteWasCalled::class => [
        // ... other providers
        \SocialiteProviders\ClassLink\ClassLinkExtendSocialite::class.'@handle',
    ],
];
```

### Usage

You should now be able to use the provider like you would regularly use Socialite (assuming you have the facade
installed):

```php
return Socialite::driver('classlink')->redirect();
```

### Returned User fields

- `id`
- `name`
- `email`

More fields are available under the `user` subkey:

```php
$user = Socialite::driver('classlink')->user();

$locale = $user->user['locale'];
$email_verified = $user->user['email_verified'];
```

### Customizing the scopes

You may extend the default scopes (`openid email profile`) by adding a `scopes` option to your ClassLink service configuration and separate multiple scopes with a space:

```php
'classlink' => [
    'client_id' => env('CLASSLINK_CLIENT_ID'),
    'client_secret' => env('CLASSLINK_CLIENT_SECRET'),
    'redirect' => env('CLASSLINK_REDIRECT_URI'),
    
    'scopes' => 'groups roles',
    // or
    'scopes' => env('CLASSLINK_SCOPES'),
],
```

---

Based on the work of [jp-gauthier](https://github.com/jp-gauthier)
