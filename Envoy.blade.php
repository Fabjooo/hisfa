@servers(['hisfa' => ['hisfa5@139.162.181.121']])

@task('deploy_hisfa', ['on' => 'hisfa'])
    cd /var/www/html/hisfa5
    php artisan down
    git reset --hard HEAD
    git pull origin develop
    composer update
    composer dump-autoload
    php artisan migrate --force
    php artisan up
@endtask
