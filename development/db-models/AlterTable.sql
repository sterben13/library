/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  rous
 * Created: 22/11/2016
 */

/**
*Se altero la longitud de los siguientes campos:
    book_isbn,
    book_title,
    book_title
    book_author
    book_editorial
*/
ALTER TABLE `library`.`Book` 
CHANGE COLUMN `book_isbn` `book_isbn` VARCHAR(11) NOT NULL ,
CHANGE COLUMN `book_title` `book_title` VARCHAR(250) NOT NULL ,
CHANGE COLUMN `book_author` `book_author` VARCHAR(150) NULL DEFAULT NULL ,
CHANGE COLUMN `book_editorial` `book_editorial` VARCHAR(100) NULL DEFAULT NULL ;

ALTER TABLE `library`.`Lending` 
CHANGE COLUMN `copy_id` `copy_id` VARCHAR(15) NOT NULL ;

ALTER TABLE `library`.`Copy` 
CHANGE COLUMN `copy_id` `copy_id` VARCHAR(15) NOT NULL ;