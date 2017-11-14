# Docker Setup

## Ubuntu

- Install Docker and Docker-Compose
  - curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
  - add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
  - apt-get update
  - apt-cache policy docker-ce
  - apt-get install -y docker-ce
  - curl -o /usr/local/bin/docker-compose -L "https://github.com/docker/compose/releases/download/1.11.2/docker-compose-$(uname -s)-$(uname -m)"
  - chmod +x /usr/local/bin/docker-compose
- Code in /var/www/trackerpal-rest-api
- apt-get install dos2unix
- dos2unix /var/www/trackerpal-rest-api/trackerpal-docker/trackerpal_app/data/entrypoint.sh
- cd /var/www/trackerpal-rest-api/trackerpal-docker and docker-compose up -d
- make sure webserver proxy is enabled (a2enmod proxy)