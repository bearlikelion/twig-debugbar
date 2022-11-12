# Twig Debug Bar

A simple twig extension to provide rendering functions for the [PHP Debug Bar](http://github.com/maximebf/php-debugbar).  This extension loads the StandardDebugBar and provides the functions *dbg_message*, *dbg_renderHead*, and *dbg_render* for Twig.

**Requirements:**

* [Twig](https://github.com/fabpot/Twig)
* [PHP Debug Bar](http://github.com/maximebf/php-debugbar)

## Installation
```
"require": {
	"bearlikelion/twig-debugbar": "dev-master",
}
```

## Example

```PHP
$twig = new Twig_Environment(new Twig_Loader_Filesystem('Views'));
$twig->addExtension(new Bearlikelion\TwigDebugBar\Extension('/Path')); // Relative assets path to your web directory e.g. /assets/debug/
```

```html
<html>
	<head>
		{{ dbg_renderHead() }}
	</head>
	<body>
        <!-- Array dump -->
        {{ dbg_message(array) }}
        <!-- Labeled Message -->
        {{ dbg_message('Something Wrong', 'error') }}
		{{ dbg_render() }}
	</body>
</html>
```

## Debug Bar Assets
I use nginx, and on the dev enviornment load the Debug Bar assets directly from the /vendor/ folder.  This is because by default, Debug Bar's renderHead function returns the assets pointing to /vendor/maximebf...

Using a simple nginx location I forward all requests to the propery directory, if there's a demand I will provide an option to set the asset path in the constructor.

```nginx
location ~* ^/vendor/(.+\.(jpg|jpeg|gif|css|png|js|ico|html|xml|txt))$ {
	root /var/www/app; # /var/www/app/vendor
}
```

### 1.1 change
Allows the asset directory to be defined in the constructor relative to the web root.
