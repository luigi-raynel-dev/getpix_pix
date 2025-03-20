FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
  git \
  unzip \
  curl \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  zip \
  librdkafka-dev \
  libbrotli-dev \
  protobuf-compiler \
  clang \
  build-essential \
  autoconf \
  libtool \
  pkg-config \
  && docker-php-ext-install pdo mbstring exif pcntl bcmath gd

RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN pecl install rdkafka && docker-php-ext-enable rdkafka
RUN pecl install swoole --configure-options="--enable-brotli=no" && docker-php-ext-enable swoole
RUN pecl install redis && docker-php-ext-enable redis
RUN pecl install protobuf && docker-php-ext-enable protobuf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN git clone --recursive -b v1.27.x https://github.com/grpc/grpc \
  && cd grpc \
  && cd third_party/protobuf \
  && ./autogen.sh \
  && ./configure CC=clang CXX=clang++ \
  && make \
  && make install \
  && cd ../.. \
  && make \
  && make grpc_php_plugin

WORKDIR /var/www/html

COPY html /var/www/html

EXPOSE 9501

CMD ["php", "bin/hyperf.php", "start"]
