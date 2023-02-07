<p align="center"><img src="./art/socialcard.png" alt="Social Card of Laravel Media Library"></p>

# OTP Authenticator

![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/mahdi-alikhani/otp-authenticator?style=flat-square)
![Packagist Downloads](https://img.shields.io/packagist/dt/mahdialikhani/otp-authenticator)

The <strong>OTP Authenticator</strong> package provides a simple and efficient solution for ensuring the security of your users' accounts. With the OTP (One-Time Password) method, users can securely log in to their accounts without the fear of their credentials being compromised. The package is easy to install and integrates seamlessly with your Laravel application, making it a hassle-free experience for developers.

<br/>

# Installation
### Requirements
- **PHP 8.0+**
- **Laravel 8+**

You can install the package via composer:
``` bash
composer require mahdialikhani/otp-authenticator
```

and add the **OTPAuthenticatorServiceProvider** service provider to **config/app.php**

and then run:

``` bash
php artisan vendor:publish --tag=otpauthenticator

php artisan otp:install
```

Our default support includes two text message service provider, Ghasedak and Kavenegar, with plans to expand our support to additional services. To use any of these services, simply follow the instructions provided.

## Kavenegar:
To utilize the Kavenegar service, first follow the installation instructions for the Kavenegar package as outlined in the service provider's official documentation. Then, specify the SMS sender number in the **config/otpauthenticator.php** file.

```php
'kavenegar' => [
    'line_number' => ''
]
```

and then:

You can edit the toSms function in the **\App\Notifications\VerificationNotification** class as follows:

```php
return (new KavenegarMessage)
            ->to('09301111111')
            ->message('Hi dear, your verification code is:123456');
```

and done!

## Ghasedak:

To utilize the ghasedak service, first follow the installation instructions for the ghasedak package provided in the official service provider's documentation. If you opt to use a pre-made text message template from the Ghasedak service, indicate the name of your selected template in the **config/otpauthenticator.php** file.

```php
'ghasedak' => [
    'template_name' => ''
]
```

and then:

You can edit the toSms function in the **\App\Notifications\VerificationNotification** class as follows:

```php
return (new GhasedakMessage)
            ->to('09301111111')
            ->message('123456');
```

and done!

<br/>

To integrate alternative text messaging services, create a custom class in **\App\Notifications\Messages** and implement the **"Messageable"** interface. In your class, define the send method for sending your text message. Then, use it in the **\App\Notifications\VerificationNotification** file just like other services. For convenience, you can extend your class from the **"SimpleMessage"** class to access the recipient and message text.

for example:
```php
<?php

namespace App\Notifications\Messages;

use Mahdialikhani\OtpAuthenticator\Contracts\Messageable;
use Mahdialikhani\OtpAuthenticator\Notifications\Messages\SimpleMessage;

class SmsirMessage extends SimpleMessage implements Messageable
{
    public function send()
    {
        // Code here
    }
}

```

```php
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Mahdialikhani\OtpAuthenticator\Notifications\Channels\SmsChannel;

class VerificationNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSms($notifiable)
    {
        return (new SmsirMessage)
            ->to('09301111111')
            ->message('123456');
    }
}
```

Also, if you don't want the verification code to be sent to the user via text message, you can apply the email settings in your **.env** file and make the following changes in the file **\App\Notifications\VerificationNotification** to send the validation code via email.

```php
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerificationNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }
}
```
<br/>

# Testing
Run the tests with:

```php
composer test
```
<br/>

# Credits

- [Mahdi alikhani](https://github.com/mahdi-alikhani)

# License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
