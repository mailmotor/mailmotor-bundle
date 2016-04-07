# MailMotorBundle

> This Symfony bundle is a smart and fast way to connect with the mail engine of your choice.

Features:
* **Subscribing/Unsubscribing**
    - Subscribe email to your mailing list.
    - Unsubscribe email from your mailing list.

Available mail engines:
* [MailChimp](https://github.com/mailmotor/mailchimp-bundle)

Available integrations:
* [Fork CMS MailMotor module](https://github.com/mailmotor/fork-cms-module-mailmotor)

## Installation example for MailChimp

*Open your `terminal` and type*
```bash
composer require mailmotor/mailchimp-bundle
```

*In `app/AppKernel.php`*
```php
public function registerBundles()
{
    $bundles = array(
        // ...
        new MailMotor\Bundle\MailMotorBundle\MailMotorMailMotorBundle(),
        new MailMotor\Bundle\MailChimpBundle\MailMotorMailChimpBundle(),
    );
```

*In app/config/parameters.yml*
```yaml
    mailmotor.mail_engine:  'mailchimp'
    mailmotor.api_key:      xxx # enter your mailchimp api_key here
    mailmotor.list_id:      xxx # enter the mailchimp default list_id here
```

> And you're ready to go.

## Examples

### Subscribing/Unsubscribing

*Possible methods*
```php
# Check if email "is subscribed"?
$this->get('mailmotor.subscriber')->isSubscribed($email);

# Subscribe email (when email was unsubscribed, subscribe it again without complaining)
$this->get('mailmotor.subscriber')->subscribe(
    $email,
    $listId,
    $mergeFields,
    $language
);

# Unsubscribe email
$this->get('mailmotor.subscriber')->unsubscribe(
    $email,
    $listId
);
```

*Example variables*
```php
// Define email (required)
$email = 'info@jeroendesloovere.be';

// Define listId (optional), if null, your mailmotor.list_id will be used
$listId = null;

// Define merge fields (optional)
$mergeFields = array(
    'FNAME' => 'Jeroen',
    'LNAME' => 'Desloovere',
);

// Define language (optional)
$language = 'en';
```

>If you didn't fill in the required fields (mailmotor.mail_engine, mailmotor.api_key and mailmotor.list_id) a `NotImplementedException` is being thrown. So you can try/catch that error and integrate your custom integration. For more integration details, checkout the integration in the Fork CMS MailMotor module - [Subscribe example](https://github.com/mailmotor/fork-cms-module-mailmotor/blob/master/src/Frontend/Modules/MailMotor/Actions/Subscribe.php#L108-L152), [Unsubscribe example](https://github.com/mailmotor/fork-cms-module-mailmotor/blob/master/src/Frontend/Modules/MailMotor/Actions/Unsubscribe.php#L112-L158)

## Creating your own bundle for a mail engine

> You can contribute to the community by creating your own bundles for mail engines that we haven't covered yet. For example: CampaignMonitor, Sendy, Yoursendingprovider, ...

*In `app/AppKernel.php`*
```php
public function registerBundles()
{
    $bundles = array(
        // ...
        new MailMotor\Bundle\MailMotorBundle\MailMotorMailMotorBundle(),
        new MailMotor\Bundle\CrazyBundle\MailMotorCrazyBundle(),
    );
```

*In `app/config/parameters.yml`*
```yaml
    mailmotor.mail_engine:  'crazy'
    mailmotor.api_key:      xxx # enter your crazy api_key here
    mailmotor.list_id:      xxx # enter the crazy default list_id here
```

*Creating the code for the bundle*

1. Copy/paste the latest [mailmotor/mailchimp-bundle](https://github.com/mailmotor/mailchimp-bundle)
2. Change the namespace everywhere to represent the mail engine "crazy", f.e.: MailMotor\Bundle\CrazyBundle\MailMotorCrazyBundle
3. Rename the files `/Component/Gateway/MailChimpSubscriberGateway.php`, `/Component/MailChimpMailMotor.php`
4. In `/Resources/config/services.yml` change the *MailChimp* to *Crazy* and *mailchimp* to *crazy*
5. Find an open source API and integrate it. First load it in like f.e. `composer install pacely/mailchimp-apiv3` and then add it in the services.yml define mailmotor.crazy.api and add the classname to the external API
6. Change some code in `Component/CrazyMailMotor` to let it accept the external API and change the code in `Component/Gateway/CrazySubscriberGateway` to let every required method in it work.

### Tests

``` bash
$ phpunit
```

## Documentation

The class is well documented inline. If you use a decent IDE you'll see that each method is documented with PHPDoc.

## Contributing

Contributions are **welcome** and will be fully **credited**.

### Pull Requests

> To add or update code

- **Coding Syntax** - Please keep the code syntax consistent with the rest of the package.
- **Add unit tests!** - Your patch won't be accepted if it doesn't have tests.
- **Document any change in behavior** - Make sure the README and any other relevant documentation are kept up-to-date.
- **Consider our release cycle** - We try to follow [semver](http://semver.org/). Randomly breaking public APIs is not an option.
- **Create topic branches** - Don't ask us to pull from your master branch.
- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.
- **Send coherent history** - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please squash them before submitting.

### Issues

> For bug reporting or code discussions.

More info on how to work with GitHub on help.github.com.

## Credits

- [Jeroen Desloovere](https://github.com/jeroendesloovere)
- [All Contributors](https://github.com/mailmotor/mailmotor-bundle/contributors)

## License

The module is licensed under [MIT](./LICENSE.md). In short, this license allows you to do everything as long as the copyright statement stays present.
