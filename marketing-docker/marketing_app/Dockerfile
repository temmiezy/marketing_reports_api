FROM ubuntu:16.04
MAINTAINER LEO XU <lxu@etech360.com>

# Update distribution
COPY data/sources.list /etc/apt/sources.list
RUN apt-get update
RUN apt-get upgrade -y

# Install tools
RUN apt-get install nginx vim cron wget git -y

# Install php and extensions
RUN apt-get install -y software-properties-common python-software-properties
RUN LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php
RUN apt-get update
RUN apt-get install -y php7.1 php7.1-fpm php7.1-cli php7.1-mcrypt php7.1-mysql php7.1-curl php7.1-intl php7.1-zip php7.1-mbstring php7.1-xml php7.1-common php7.1-redis php7.1-gd php7.1-gmp

# Install composer globally
RUN mkdir /usr/local/bin/composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=/usr/local/bin/composer
RUN php -r "unlink('composer-setup.php');"
RUN chmod +x /usr/local/bin/composer

# Copy php-fpm conf
COPY data/www.conf /etc/php/7.1/fpm/pool.d/www.conf

# Copy startup script
COPY data/entrypoint.sh /root/entrypoint.sh
RUN chown root:root /root/entrypoint.sh
RUN chmod +x /root/entrypoint.sh

COPY data/deploy_setup.sh /root/deploy_setup.sh
RUN chown root:root /root/deploy_setup.sh
RUN chmod +x /root/deploy_setup.sh

WORKDIR /var/www
VOLUME /var/www
EXPOSE 80

# Run startup script
ENTRYPOINT ["/root/entrypoint.sh"]