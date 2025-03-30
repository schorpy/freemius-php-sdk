# Freemius PHP SDK
This SDK is a wrapper for accessing the API. It handles the endpoint's path and authorization signature generation.

As a plugin or theme developer using Freemius, you can access your data via the `developer` scope or `plugin` scope. 
If you only need to access one product, we recommend using the `plugin` scope. You can get the product's credentials in *SETTINGS -> Keys*.
If you need to access multiple products, use the `developer` scope. To get your credentials, click on *My Profile* at the top right menu and you'll find it in the *Keys* section.

```php
  define( 'FS__API_SCOPE', 'developer' );
  define( 'FS__API_ENTITY_ID', 1234 );
  define( 'FS__API_PUBLIC_KEY', 'pk_YOUR_PUBLIC_KEY' );
  define( 'FS__API_SECRET_KEY', 'sk_YOUR_SECRET_KEY' );
  
  // Init SDK.
  $api = new Freemius_Api(FS__API_SCOPE, FS__API_ENTITY_ID, FS__API_PUBLIC_KEY, FS__API_SECRET_KEY);
  
  // Get all products.
  $result = $api->Api('/plugins.json');
  
  // Load 1st product data.
  $first_plugin_id = $result->plugins[0]->id;
  $first_plugin = $api->Api("/plugins/{$first_plugin_id}.json");
  
  // Update title.
  $api->Api("/plugins/{$first_plugin_id}.json", 'PUT', array(
    'title' => 'My New Title',
  ));

```
## Using Freemius API in Laravel  

To integrate **Freemius API** with Laravel, follow these steps:

### 1. Install the SDK  

If the SDK is not installed via Composer, add it manually:  

```sh
composer require freemius/php-sdk
```
### 2. Create a Laravel Controller

Generate a new controller to handle Freemius API interactions:

```sh
php artisan make:controller FreemiusController
```
Now, open app/Http/Controllers/FreemiusController.php and modify it as follows:

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Freemius\Freemius_Api;

class FreemiusController extends Controller
{
    protected $freemius;

    public function __construct()
    {
        $this->freemius = new Freemius_Api(
            env('FREEMIUS_API_SCOPE'),
            env('FREEMIUS_API_ENTITY_ID'),
            env('FREEMIUS_API_PUBLIC_KEY'),
            env('FREEMIUS_API_SECRET_KEY')
        );
    }

    public function getPlugins()
    {
        return response()->json($this->freemius->Api('/plugins.json'));
    }
}
```

# Autoloading & PSR-4 Support

The SDK now follows PSR-4 autoloading for better compatibility with modern PHP applications.