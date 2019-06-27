Yii2 Action Log
=======================
Automatically logs user actions like create, update, delete.
In addition, you can manually apply the method ```ActionLog::add('Save sample message')```, where you will need.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

 ```php
php composer.phar require --prefer-dist dmsylvio/actionlog "dev-master"
 ```

or add

 ```php
"dmsylvio/actionlog": "*"
 ```

to the require section of your `composer.json` file.

Database Migration
------------

Check your database settings and run migration from your console:

    php yii migrate --migrationPath=@vendor/dmsylvio/actionlog/migrations

For more informations see [Database Migration Documentation](http://www.yiiframework.com/doc-2.0/guide-console-migrate.html#applying-migrations)

Configuration
------------

To access the module, you need to add this to your application configuration:

 ```php
    'modules' => [
        'actionlog' => [
            'class' => 'app\vendor\dmsylvio\actionlog\Module',
        ],
    ],
 ```

Add the new menu item to your navbar:

 ```php
    ['label' => 'Log', 'url' => ['/actionlog/log/index']],
 ```

You may have to customize the user rights for the access log view. You could do it by editing ```controllers/LogController.php```.


Example manual usage
------------

This is an example in the login method from the module dmsylvio/yii2-accounts.

    use app\vendor\dmsylvio\actionlog\model\Log;

 ```php
    public function login()
    {
        $user = $this->getUser();
        if ($this->validate()) {
            Log::add('success', $user->id); //log message for success

            return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            Log::add('error', $user->id); //log message for error

            return false;
        }
    }
  ```
    
 To use ActionLogBehavior, simply insert the following code to your ActiveRecord class:
  
    use app\vendor\dmsylvio\actionlog\behaviors\ActionLogBehavior;
  
 ```php
  public function behaviors()
  {
      return [
           'actionlog' => [
               'class' => ActionLogBehavior::class,
           ],
      ];
  }
  ```
