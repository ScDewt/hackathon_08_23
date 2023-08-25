# Цель
Игровой тимбилдинг в виде хакатона

# Задача
## Интерактивная карта команды  
Каждый член команды подключает себе телеграмм бота Х, указывает кодовое название команды, дает разрешение на опеределение местоположения, на выходе получает уникальную ссылку на карту, где показано расположение всех членов команды.

# Server
Ubuntu 22 LTS




# Server install
```bash
apt update
cd /etc/apt
# uncommented deb-src
nano sources.list 

sudo apt-get update
apt-get install htop vim
sudo sysctl vm.swappiness=10
echo 'vm.swappiness=10' | sudo tee -a /etc/sysctl.conf
sudo apt-get install nginx
sudo apt install -y lsb-release gnupg2 ca-certificates apt-transport-https software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php8.2-bcmath php8.2-bz2 php8.2-cli php8.2-common php8.2-curl php8.2-dba php8.2-dev php8.2-fpm php8.2-imagick php8.2-mbstring php8.2-mcrypt php8.2-memcached php8.2-mysql php8.2-opcache php8.2-pgsql php8.2-tidy php8.2-xdebug php8.2-xhprof php8.2-yaml php8.2-zip
sudo apt-get install mysql-server
# create user/set passwd
sudo mysql


mkdir -p /home/dev/
git clone https://github.com/ScDewt/hackathon_08_23.git
chmod -R 0775 /home/dev

# change config with new dir
vim /etc/nginx/sites-enabled/default
service nginx restart

adduser hackathon
```


- создать бота + прописать вебхук ( с флагами ssl_insecure)
- бекенд обработка запросов от бота (2 php файла)
- некоторое хранилизе в БД
- контроллер на отдачу данных из БД
- фронтовая часть подключение и отрисовка точек
- через что рисуем карту? OSM / Yandex


- OSM - Алексей смотрит
- Yandex - Галя + Анастасия
- Завести бота + прописать - Дима К
- файл по сохранениею координат - Дима Г
- Сделать файл по отдаче координат - Дима Ж

