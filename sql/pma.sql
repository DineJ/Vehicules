CREATE DATABASE IF NOT EXISTS phpmyadmin;

DROP USER IF EXISTS 'pma'@'%';
CREATE USER 'pma'@'%' IDENTIFIED BY 'pmapass';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, ALTER, INDEX
  ON phpmyadmin.* TO 'pma'@'%';
FLUSH PRIVILEGES;

-- docker exec phpmyadmin cat /var/www/html/sql/create_tables.sql   | docker exec -i mariadb mariadb -u root -proot phpmyadmin

