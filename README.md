# Doctor-REST-API

Insert in /etc/apache/sites-available/mladen-api.conf

Add

<VirtualHost *:80>
      ServerName appointment.dev
      ServerAlias www.appointment.dev

        DocumentRoot /home/magi/public_html/mladen-api/

        <Directory /home/magi/public_html/mladen-api/>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride All
                Order allow,deny
                Allow from all
                Require all granted
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/mladen-api-error.log
        CustomLog ${APACHE_LOG_DIR}/mladen-api-access.log combined
</VirtualHost>
