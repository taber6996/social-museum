CREATE USER 'social-museum'@'%' IDENTIFIED BY 'social-museum';
GRANT ALL PRIVILEGES ON `social-museum`.* TO 'social-museum'@'%';

CREATE USER 'social-museum'@'localhost' IDENTIFIED BY 'social-museum';
GRANT ALL PRIVILEGES ON `social-museum`.* TO 'social-museum'@'localhost';