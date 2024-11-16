ARG PHP_VERSION
ARG PROJECT_NAME
FROM ${PROJECT_NAME}/php:latest

RUN apt-get update && apt-get install -y cron
ADD schedule /etc/cron.d/schedule
RUN crontab /etc/cron.d/schedule
