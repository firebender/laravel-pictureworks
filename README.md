# laravel-pictureworks #

Laravel PictureWorks package

### What is this repository for? ###

Very simple legacy work. Wrapped in a neat Laravel ready package.

Source legacy files in /legacy.

### How do I get set up? ###

1. Set up your Laravel website.

        laravel new <your_website>

2. Ideally, this package should be in its own Composer package repository. If you want to keep your packages private, you can use packagist.com. But because this particular package wouldn't be useful for the general public anyway, we can set things up locally.

    Clone the package repo.

        git clone https://github.com:firebender/laravel-pictureworks.git

3. cd into laravel-pictureworks, then run

        composer install

4. In the new Laravel website's composer.json, add the following:

        "repositories": [
            {
                "type": "path",
                "url": "<path_to_this_package>"
            }
        ]

5. Pull the package into your Laravel app.

        composer require firebender/laravel-pictureworks:dev-master

6. Create your database and update your .env.

        DB_DATABASE=your_database_name
        DB_USERNAME=your_database_username
        DB_PASSWORD=your_database_password

7. Migrate

        artisan migrate

8. Optional. Seed the database with either:

    This way:

        artisan db:seed --class=FireBender\\Laravel\\PictureWorks\\Database\\Seeders\\UserSeeder

    Or this way:

        artisan z:seed N // where N is the number of records you wish to seed

9. Check that the web middleware group is availabe in your middleware groups in your App/Http/Kernel.php file. In particular, ensure that the following middleware classes are activated:

        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,

### Notes ###

# Routes #

List of users

    users/{page?}

View specific user

    user/{id}

Edit/Modify a user entry

    user/edit/{id}

# Commands #

Shows users in paged format

    artisan z:users:get {--page=} {--per-page=} {--seed=}

Seeds users table

    artisan z:seed <count>

Displays a user by specified user id

    artisan z:user:get <id>

Modifies a user entry

    artisan z:user:modify <id> {--name=} {--comments=}

Adds a user entry. Interactive

    artisan z:user:add

Modifies comments on a user entry

    artisan z:comments:modify <id> <password> <comments>

### Contribution guidelines ###

Write tests. Write code. Pull request. 

Everybody happy? We celebrate. We drink :)

Problems? We talk. We still drink :D

### Who do I talk to? ###

@firebender
