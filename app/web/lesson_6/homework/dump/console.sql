-- Файл для импорта триггера
-- Удаляем функцию
DROP FUNCTION update_basket();

-- Создаём функцию для добавления id заказа в корзину и изменения статуса товара в корзине
CREATE OR REPLACE FUNCTION update_basket() RETURNS TRIGGER
              AS
              $$
BEGIN
UPDATE lesson_6.basket SET id_order = NEW.id WHERE id_user = NEW.id_user AND is_in_order = false;
UPDATE lesson_6.basket SET is_in_order = true WHERE id_order = NEW.id;
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Удаляем триггер, если он существует
DROP TRIGGER IF EXISTS tr_update_basket ON lesson_6."order";

-- Создаём триггер на таблице заказа
CREATE TRIGGER tr_update_basket
    AFTER INSERT
    ON lesson_6."order"
    FOR EACH ROW
    EXECUTE PROCEDURE update_basket();

-- Удаляем функцию
DROP FUNCTION add_user_role();

-- Создаём функцию для добавления id пользователя в таблицу user_role ()
CREATE OR REPLACE FUNCTION add_user_role() RETURNS TRIGGER
              AS
              $$
BEGIN
INSERT INTO lesson_6.user_role (id_user, id_role) VALUES (NEW.id, 1);
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Удаляем триггер, если он существует
DROP TRIGGER IF EXISTS tr_add_user_role ON lesson_6.users;

-- Создаём триггер на таблице users
CREATE TRIGGER tr_add_user_role
    AFTER INSERT
    ON lesson_6.users
    FOR EACH ROW
    EXECUTE PROCEDURE add_user_role();

-- Создаём вид order_info
CREATE VIEW lesson_6.order_info AS
SELECT lesson_6.order.id          AS order_id,
       lesson_6.goods.id          AS goods_id,
       lesson_6.order.created,
       lesson_6.basket.price,
       lesson_6.order_status.name AS status,
       lesson_6.goods.name        AS good_name
FROM lesson_6.order
         INNER JOIN lesson_6.basket ON lesson_6.order.id = lesson_6.basket.id_order
         INNER JOIN lesson_6.goods ON lesson_6.basket.id_good = lesson_6.goods.id
         INNER JOIN lesson_6.order_status ON lesson_6.order.id_order_status = lesson_6.order_status.id;

-- Удаляем вид order_info
DROP VIEW lesson_6.order_info;

-- Создаём вид order_list
CREATE VIEW lesson_6.order_list AS
SELECT lesson_6.order.id          AS id,
       users.name                 AS user_name,
       users.email                AS user_email,
       lesson_6.order.created     AS created,
       lesson_6.order.total_price AS total_price,
       order_status.name          AS status
FROM lesson_6.order
         INNER JOIN lesson_6.users ON lesson_6.order.id_user = lesson_6.users.id
         INNER JOIN lesson_6.order_status ON lesson_6.order.id_order_status = lesson_6.order_status.id
ORDER BY lesson_6.order.id DESC;

-- Удаляем вид order_list
DROP VIEW lesson_6.order_list;
