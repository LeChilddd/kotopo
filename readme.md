Getting Started
If not already done, install Docker Compose <br>
Run USER_ID=$(id -u) GROUP_ID=$(id -g) docker-compose up to build fresh php-apache image and pull mysql image <br>
Open https://localhost in your favorite web browser and accept the auto-generated TLS certificate <br>
Run docker-compose down --remove-orphans to stop the Docker containers.<br>

To connect to phpmyadmin, in server add 'database', and enter your login.