FROM nginx:alpine

COPY docker/nginx/laravel.conf /etc/nginx/conf.d/default.conf

RUN apk update \
    && apk upgrade \
    && apk --update add logrotate \
    && apk add --no-cache openssl \
    && apk add --no-cache bash

WORKDIR /var/www/html

EXPOSE 80

