/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  rous
 * Created: 6/12/2016
 */
ALTER TABLE `library`.`Lending` 
ADD COLUMN `lending_id` INT NOT NULL AUTO_INCREMENT FIRST,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`lending_id`, `user_id`, `copy_id`);

