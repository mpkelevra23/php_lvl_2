-- Файл для импорта триггеров и видов
-- Удаляем функцию
DROP FUNCTION update_basket();

-- Создаём функцию для добавления id заказа в корзину и изменения статуса товара в корзине
CREATE OR REPLACE FUNCTION update_basket() RETURNS TRIGGER
              AS
              $$
BEGIN
UPDATE lesson_7.basket SET id_order = NEW.id WHERE id_user = NEW.id_user AND is_in_order = false;
UPDATE lesson_7.basket SET is_in_order = true WHERE id_order = NEW.id;
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Удаляем триггер, если он существует
DROP TRIGGER IF EXISTS tr_update_basket ON lesson_7."order";

-- Создаём триггер на таблице заказа
CREATE TRIGGER tr_update_basket
    AFTER INSERT
    ON lesson_7."order"
    FOR EACH ROW
    EXECUTE PROCEDURE update_basket();

-- Удаляем функцию
DROP FUNCTION add_user_role();

-- Создаём функцию для добавления id пользователя в таблицу user_role ()
CREATE OR REPLACE FUNCTION add_user_role() RETURNS TRIGGER
              AS
              $$
BEGIN
INSERT INTO lesson_7.user_role (id_user, id_role) VALUES (NEW.id, 1);
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Удаляем триггер, если он существует
DROP TRIGGER IF EXISTS tr_add_user_role ON lesson_7.users;

-- Создаём триггер на таблице users
CREATE TRIGGER tr_add_user_role
    AFTER INSERT
    ON lesson_7.users
    FOR EACH ROW
    EXECUTE PROCEDURE add_user_role();

-- Создаём вид order_info
CREATE VIEW lesson_7.order_info AS
SELECT lesson_7.order.id_user     AS user_id,
       lesson_7.order.id          AS order_id,
       lesson_7.goods.id          AS goods_id,
       lesson_7.order_status.id   AS status_id,
       lesson_7.order.created,
       lesson_7.basket.price,
       lesson_7.order_status.name AS status,
       lesson_7.goods.name        AS good_name
FROM lesson_7.order
         INNER JOIN lesson_7.basket ON lesson_7.order.id = lesson_7.basket.id_order
         INNER JOIN lesson_7.goods ON lesson_7.basket.id_good = lesson_7.goods.id
         INNER JOIN lesson_7.order_status ON lesson_7.order.id_order_status = lesson_7.order_status.id;

-- Удаляем вид order_info
DROP VIEW lesson_7.order_info;

-- Создаём вид order_list
CREATE VIEW lesson_7.order_list AS
SELECT lesson_7.order.id          AS id,
       lesson_7.users.id          AS user_id,
       lesson_7.users.name        AS user_name,
       lesson_7.users.email       AS user_email,
       lesson_7.order.created     AS created,
       lesson_7.order.total_price AS total_price,
       lesson_7.order_status.id   AS status_id,
       lesson_7.order_status.name AS status
FROM lesson_7.order
         INNER JOIN lesson_7.users ON lesson_7.order.id_user = lesson_7.users.id
         INNER JOIN lesson_7.order_status ON lesson_7.order.id_order_status = lesson_7.order_status.id
ORDER BY lesson_7.order.id DESC;

-- Удаляем вид order_list
DROP VIEW lesson_7.order_list;

-- Создаём вид goods_list
CREATE VIEW lesson_7.goods_list AS
SELECT lesson_7.goods.id                AS id,
       lesson_7.goods.name              AS name,
       lesson_7.goods.price             AS price,
       lesson_7.goods.img_thumb_address AS img_thumb_address,
       lesson_7.goods.img_address       AS img_address,
       lesson_7.categories.name         AS category,
       lesson_7.goods.status            AS status,
       lesson_7.goods.description       AS description
FROM lesson_7.goods
         INNER JOIN lesson_7.categories ON lesson_7.goods.id_category = lesson_7.categories.id
ORDER BY lesson_7.goods.id;

-- Удаляем вид goods_list
DROP VIEW lesson_7.goods_list;
