@servers(['kelompoktiga' => 'cybxcom@103.76.129.70'])

@task('deploy-on-production', ['on' => 'kelompoktiga'])
if [ ! -d /home/cybxcom/psikotes ]; then
    cd /home/cybxcom/
    if ssh-keygen -F gitlab.com; then echo ''; else ssh-keyscan -H gitlab.com >> ~/.ssh/known_hosts && chmod 644 ~/.ssh/known_hosts; fi
    git clone git@gitlab.com:pbl-2024/pbl-psikotes.git psikotes
    cd psikotes
    cp .env.example .env
    /usr/local/php83/bin/php83 /usr/local/bin/composer install
    /usr/local/php83/bin/php83 artisan key:generate
    /usr/local/php83/bin/php83 artisan storage:link
    ln -s /home/cybxcom/psikotes/public /home/cybxcom/domains/kelompoktiga.my.id/public_html
else
    echo "Directory already exists"
    cd /home/cybxcom/psikotes
    git pull origin master
    /usr/local/php83/bin/php83 /usr/local/bin/composer install
    /usr/local/php83/bin/php83 artisan clear
fi
@endtask

@task('deploy-on-staging', ['on' => 'kelompoktiga'])
    if [ ! -d /home/cybxcom/psikotes-staging ]; then
        cd /home/cybxcom/
        if ssh-keygen -F gitlab.com; then echo ''; else ssh-keyscan -H gitlab.com >> ~/.ssh/known_hosts && chmod 644 ~/.ssh/known_hosts; fi
        git clone --branch dev git@gitlab.com:pbl-2024/pbl-psikotes.git psikotes-staging
        cd psikotes-staging
        cp .env.example .env
        /usr/local/php83/bin/php83 /usr/local/bin/composer install
        /usr/local/php83/bin/php83 artisan key:generate
        /usr/local/php83/bin/php83 artisan storage:link
        ln -s /home/cybxcom/psikotes-staging/public /home/cybxcom/domains/staging.kelompoktiga.my.id/public_html
    else
        echo "Directory already exists"
        cd /home/cybxcom/psikotes-staging
        git pull origin dev
        /usr/local/php83/bin/php83 /usr/local/bin/composer install
        /usr/local/php83/bin/php83 artisan clear
    fi
@endtask
