# Simple Phinx demo

* [Documentation](http://docs.phinx.org/en/latest/migrations.html)

## Installation

```
composer require robmorgan/phinx
```
or global
```
composer global require robmorgan/phinx
```

## create phynx configuration file (phynx.yml)

```
vendor/bin/phinx init
```

## Create a migration file in db/migrations directory
```
phinx create CreatePostsTable
```



## Migrate
```
phynx migrate
```


Alternative configurations:

* change migrations directory (db/migrations by default)

Example with database\migrations

```
paths:
    migrations: %%PHINX_CONFIG_DIR%%/database/migrations
    seeds: %%PHINX_CONFIG_DIR%%/database/seeds
```

* with a Migration **base class**

Example with Eloquent

```php
use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration
{
    /** @var \Illuminate\Database\Capsule\Manager $capsule */
    public $capsule;

    /** @var \Illuminate\Database\Schema\Builder $capsule */
    public $schema;

    public function init()
    {
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'port'      => 3306,
            'database'  => 'test',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);

        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema();
    }
}
```

Change in "phynx.yml"

```
migration_base_class: App\Database\Migrations\Migration
```

* With **Migration Stub**

```php
use $useClassName;
use Illuminate\Database\Schema\Blueprint;

class $className extends $baseClassName
{

    public function up(){

    }

    public function down(){

    }
}
```


Add in "phynx.yml"

```
templates:
    file:
      'App\Database\Migrations\MigrationStub.php'
```


Migration example with Eloquent

```php
use App\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostTable extends Migration
{

    public function up(){
        $this->schema->create('posts', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('content');
            $table->timestamps();
        });
    }

    public function down(){
        $this->schema->drop('posts');
    }
}
```





