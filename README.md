# MailMotorBundle

> Subscribing/Unsubscribing to your own mailinglist has never been this easy! Thanks to this Symfony2 bundle.

## Examples

### Configure (MailChimp)

```bash
composer require mailmotor/mailchimp-bundle
```

```php
public function registerBundles()
{
    $bundles = array(
        // ...
        new MailMotor\Bundle\MailMotorBundle\MailMotorMailMotorBundle(),
        new MailMotor\Bundle\MailChimpBundle\MailMotorMailChimpBundle(),
    );
```

```yaml
mailmotor.mail_engine:  'mailchimp'
mailmotor.api_key:      xxx # enter your mailchimp api_key here
mailmotor.list_id:      xxx # enter the mailchimp default list_id here
```

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
    $listId // OPTIONAL, default listId is in your config parameters
);
```

### Exists

```php
$this->get('mailmotor.subscriber')->exists(
    $email,
    $listId // OPTIONAL, default listId is in your config parameters
);
```

### Is subscribed

```php
$this->get('mailmotor.subscriber')->isSubscribed(
    $email,
    $listId // OPTIONAL, default listId is in your config parameters
);
```

## Extending

### Creating a bundle for another mail engine.

F.e.: You want to use a mail engine called "Crazy".

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

Then you just need to duplicate all files from another mail engine, like f.e.: "mailmotor/mailchimp-bundle" and replace all the logic for your own mail engine.
