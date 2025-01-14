FROM dunglas/frankenphp

# Copy your app
WORKDIR /go/src/app/dist/app
COPY . .

# Remove the tests and other unneeded files to save space
# Alternatively, add these files to a .dockerignore file
RUN rm -Rf tests/

# Copy .env file
RUN cp .env.example .env
# Change APP_ENV and APP_DEBUG to be production ready
RUN sed -i'' -e 's/^APP_ENV=.*/APP_ENV=production/' -e 's/^APP_DEBUG=.*/APP_DEBUG=false/' .env

# Make other changes to your .env file if needed

RUN apk add icu-dev libzip-dev oniguruma-dev zip nano
RUN install-php-extensions pdo pdo_mysql intl zip exif mbstring gd

# Install the dependencies
RUN composer install --ignore-platform-reqs --no-dev -a

# Build the static binary
WORKDIR /go/src/app/
RUN EMBED=dist/app/ ./build-static.sh
