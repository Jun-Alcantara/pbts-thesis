## About BasaMuna

PBTS Thesis

## How to install?

Install the following:
- **[Composer](https://getcomposer.org/download/)**
- **[XAMPP 7.3.27 / PHP 7.3.27](https://www.apachefriends.org/download.html )**
- **[Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git )**
- Clone this repository and navigate to the root directory ```cd pbts-thesis```
- Run ```composer install``` to install dependencies
- In the root directory, rename the file ```.env.example``` to ```.env```. This file contains your environment configuration.
- Run ```php artisan key:generate``` to generate unique key for your app.
- And finally, run ```php artisan serve``` to start the app.
- In your browser, visit localhost:8000

## License

The app is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
