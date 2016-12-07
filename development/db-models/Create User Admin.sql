/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  rous
 * Created: 15/11/2016
 */
CREATE USER 'Admin'@'localhost' IDENTIFIED BY 'Yiilibrary';
GRANT ALL PRIVILEGES ON library.* TO 'Admin'@'localhost';
FLUSH PRIVILEGES;

ALTER TABLE `library`.`Copy` 
CHANGE COLUMN `copy_available` `copy_available` ENUM('Disponible', 'Ocupado') NULL ;
