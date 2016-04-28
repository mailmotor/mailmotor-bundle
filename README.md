# MailMotorBundle

This Symfony2 bundle loads in [MailMotor](https://github.com/mailmotor/mailmotor) as a service. So you can subscribe/unsubscribe members to any mailinglist managing API. F.e.: [MailChimp](https://github.com/mailmotor/mailmotor-mailchimp), CampaignMonitor, ...

Read more about:
* [Examples](#examples)
* [Installation for MailChimp](#installation-for-mailchimp)
* [Installation for CustomBundle](#installation-for-custombundle)

## Examples

> Examples for Symfony, but can be used in any framework.

### Subscribing

```php
// Subscribing has never been this easy!!!
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
// Unsubscribing an email is very easy
$this->get('mailmotor.subscriber')->unsubscribe(
    $email,
    $listId // Optional, default listId is in your config parameters
);
```

## Installation for MailChimp

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

## Installation for CustomBundle

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
