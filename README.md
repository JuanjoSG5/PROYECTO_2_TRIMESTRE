# Launching the project

In  order to launch the API of the project, you need to use `docker-compose up -d --build` to launch the docker.

After it finishes the build process, enter the laravel-docker container using `docker exec -it laravel-docker bash`

Inside the container head into this folder:

```bash
    cd /etc/apache2/sites-available
```

Install vim or any other text editor and modify the file **000-default.conf**, so that the file looks like this:

```bash
    <VirtualHost *:80>
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/html/public
        <Directory /var/www/html/public>
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>
```

After saving the changes, head into the `/var/www/html/public` folder

```bash
    cd /var/www/html/public
```

And change the permissions of the files using this commands:

```bash
    chmod -R 775 storage
    chown -R www-data:www-data storage
```

After that, we just need to relaunch the apache server and then the API should be functional

# Launching the frontend

To launch the front end you have to go to the folder in the command terminal

` cd frontend `

Then run this commands

```bash
npm install
npm run build
npm run preview

```

After that you should be able to access the app from the link provided in the terminal
