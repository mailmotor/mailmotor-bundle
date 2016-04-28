# MailMotorBundle

>Subscribing/Unsubscribing to your own mailinglist has never been this easy! Thanks to this Symfony2 bundle.

Current Mail Engines:
* [MailChimp](https://github.com/mailmotor/mailmotor-mailchimp)
* [CampaignMonitor](https://github.com/mailmotor/mailmotor-campaignmonitor) - work in progress

Read more about:
* [Examples](#examples)
* [Installation](#installation)
* [Extending](#extending)

## Examples

> Examples for Symfony, but can be used in any framework.

### Subscribing

```php
$this->get('mailmotor.subscriber')->subscribe(
    $email,         // f.e.: 'jeroen@siesqo.be'
    $mergeFields,   // f.e.: ['FNAME' => 'Jeroen', 'LNAME' => 'Desloovere']
    $language,      // f.e.: 'nl'
    $doubleOptin,   // OPTIONAL, default = true
    $listId         // OPTIONAL, default listId is in your config parameters
);
```

### Unsubscribing

```php
$this->get('mailmotor.subscriber')->unsubscribe(
    $email,
    $listId // Optional, default listId is in your config parameters
);
```

## Installation

### For MailChimp

Open your **terminal** and type:
```
composer require mailmotor/mailchimp-bundle
```

In **app/AppKernel.php**

```php
public function registerBundles()
{
    $bundles = array(
        // ...
        new MailMotor\Bundle\MailMotorBundle\MailMotorMailMotorBundle(),
        new MailMotor\Bundle\MailChimpBundle\MailMotorMailChimpBundle(),
    );
```

In **app/config/parameters.yml**

```yaml
    mailmotor.mail_engine:  'mailchimp'
    mailmotor.api_key:      xxx # enter your mailchimp api_key here
    mailmotor.list_id:      xxx # enter the mailchimp default list_id here
```

## Extending

### Installation for CustomBundle

> You can always create your own MailEngineBundle

F.e.: You want to use a (fake) mail engine called "Crazy".

```php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Crazy\Bundle\MailMotorBundle\CrazyMailMotorBundle(),
    );
```

In **app/config/parameters.yml**

```yaml
    mailmotor.mail_engine:  'crazy'
    mailmotor.api_key:      xxx # enter your crazy api_key here
    mailmotor.list_id:      xxx # enter the crazy default list_id here
```

Then you just need to recreate the files like in "mailmotor/mailchimp-bundle".
