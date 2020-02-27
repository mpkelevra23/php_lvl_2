--
-- PostgreSQL database dump
--

-- Dumped from database version 10.12 (Ubuntu 10.12-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 10.12 (Ubuntu 10.12-0ubuntu0.18.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

ALTER TABLE ONLY lesson_7.user_role DROP CONSTRAINT user_role_users_id_fk;
ALTER TABLE ONLY lesson_7.user_role DROP CONSTRAINT user_role_role_id_fk;
ALTER TABLE ONLY lesson_7."order" DROP CONSTRAINT order_users_id_fk;
ALTER TABLE ONLY lesson_7."order" DROP CONSTRAINT order_order_status_id_fk;
ALTER TABLE ONLY lesson_7.goods DROP CONSTRAINT goods_categories_id_fk;
ALTER TABLE ONLY lesson_7.basket DROP CONSTRAINT basket_users_id_fk;
ALTER TABLE ONLY lesson_7.basket DROP CONSTRAINT basket_order_id_fk;
ALTER TABLE ONLY lesson_7.basket DROP CONSTRAINT basket_goods_id_fk;
DROP TRIGGER tr_update_basket ON lesson_7."order";
DROP TRIGGER tr_add_user_role ON lesson_7.users;
DROP INDEX lesson_7.users_id_uindex;
DROP INDEX lesson_7.users_email_uindex;
DROP INDEX lesson_7.user_role_id_uindex;
DROP INDEX lesson_7.role_role_name_uindex;
DROP INDEX lesson_7.role_id_uindex;
DROP INDEX lesson_7.order_status_id_uindex;
DROP INDEX lesson_7.order_id_uindex;
DROP INDEX lesson_7.goods_id_uindex;
DROP INDEX lesson_7.categories_id_uindex;
DROP INDEX lesson_7.basket_id_uindex;
ALTER TABLE ONLY lesson_7.users DROP CONSTRAINT users_pk;
ALTER TABLE ONLY lesson_7.user_role DROP CONSTRAINT user_role_pk;
ALTER TABLE ONLY lesson_7.role DROP CONSTRAINT role_pk;
ALTER TABLE ONLY lesson_7.order_status DROP CONSTRAINT order_status_pk;
ALTER TABLE ONLY lesson_7."order" DROP CONSTRAINT order_pk;
ALTER TABLE ONLY lesson_7.goods DROP CONSTRAINT goods_pk;
ALTER TABLE ONLY lesson_7.categories DROP CONSTRAINT categories_pk;
ALTER TABLE ONLY lesson_7.basket DROP CONSTRAINT basket_pk;
ALTER TABLE lesson_7.users ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_7.user_role ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_7.role ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_7.order_status ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_7."order" ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_7.goods ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_7.categories ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_7.basket ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE lesson_7.users_id_seq;
DROP SEQUENCE lesson_7.user_role_id_seq;
DROP TABLE lesson_7.user_role;
DROP SEQUENCE lesson_7.role_id_seq;
DROP TABLE lesson_7.role;
DROP SEQUENCE lesson_7.order_status_id_seq;
DROP VIEW lesson_7.order_list;
DROP TABLE lesson_7.users;
DROP VIEW lesson_7.order_info;
DROP TABLE lesson_7.order_status;
DROP SEQUENCE lesson_7.order_id_seq;
DROP TABLE lesson_7."order";
DROP VIEW lesson_7.goods_list;
DROP SEQUENCE lesson_7.goods_id_seq;
DROP TABLE lesson_7.goods;
DROP SEQUENCE lesson_7.categories_id_seq;
DROP TABLE lesson_7.categories;
DROP SEQUENCE lesson_7.basket_id_seq;
DROP TABLE lesson_7.basket;
DROP FUNCTION lesson_7.update_basket();
DROP FUNCTION lesson_7.add_user_role();
DROP SCHEMA lesson_7;
--
-- Name: lesson_7; Type: SCHEMA; Schema: -; Owner: admin
--

CREATE SCHEMA lesson_7;


ALTER SCHEMA lesson_7 OWNER TO admin;

--
-- Name: add_user_role(); Type: FUNCTION; Schema: lesson_7; Owner: admin
--

CREATE FUNCTION lesson_7.add_user_role() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    INSERT INTO lesson_7.user_role (id_user, id_role) VALUES (NEW.id, 1);
    RETURN NEW;
END;
$$;


ALTER FUNCTION lesson_7.add_user_role() OWNER TO admin;

--
-- Name: update_basket(); Type: FUNCTION; Schema: lesson_7; Owner: admin
--

CREATE FUNCTION lesson_7.update_basket() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    UPDATE lesson_7.basket SET id_order = NEW.id WHERE id_user = NEW.id_user AND is_in_order = false;
    UPDATE lesson_7.basket SET is_in_order = true WHERE id_order = NEW.id;
    RETURN NEW;
END;
$$;


ALTER FUNCTION lesson_7.update_basket() OWNER TO admin;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: basket; Type: TABLE; Schema: lesson_7; Owner: admin
--

CREATE TABLE lesson_7.basket (
    id integer NOT NULL,
    id_user integer NOT NULL,
    id_good integer NOT NULL,
    price numeric(10,2) NOT NULL,
    is_in_order boolean DEFAULT false NOT NULL,
    id_order integer
);


ALTER TABLE lesson_7.basket OWNER TO admin;

--
-- Name: basket_id_seq; Type: SEQUENCE; Schema: lesson_7; Owner: admin
--

CREATE SEQUENCE lesson_7.basket_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_7.basket_id_seq OWNER TO admin;

--
-- Name: basket_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_7; Owner: admin
--

ALTER SEQUENCE lesson_7.basket_id_seq OWNED BY lesson_7.basket.id;


--
-- Name: categories; Type: TABLE; Schema: lesson_7; Owner: admin
--

CREATE TABLE lesson_7.categories (
    id integer NOT NULL,
    status integer,
    name character varying NOT NULL
);


ALTER TABLE lesson_7.categories OWNER TO admin;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: lesson_7; Owner: admin
--

CREATE SEQUENCE lesson_7.categories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_7.categories_id_seq OWNER TO admin;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_7; Owner: admin
--

ALTER SEQUENCE lesson_7.categories_id_seq OWNED BY lesson_7.categories.id;


--
-- Name: goods; Type: TABLE; Schema: lesson_7; Owner: admin
--

CREATE TABLE lesson_7.goods (
    id integer NOT NULL,
    name character varying NOT NULL,
    price numeric(10,2) NOT NULL,
    id_category integer NOT NULL,
    description character varying(2056),
    img_address character varying(256) NOT NULL,
    img_thumb_address character varying(256) NOT NULL,
    status boolean DEFAULT true NOT NULL
);


ALTER TABLE lesson_7.goods OWNER TO admin;

--
-- Name: goods_id_seq; Type: SEQUENCE; Schema: lesson_7; Owner: admin
--

CREATE SEQUENCE lesson_7.goods_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_7.goods_id_seq OWNER TO admin;

--
-- Name: goods_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_7; Owner: admin
--

ALTER SEQUENCE lesson_7.goods_id_seq OWNED BY lesson_7.goods.id;


--
-- Name: goods_list; Type: VIEW; Schema: lesson_7; Owner: admin
--

CREATE VIEW lesson_7.goods_list AS
 SELECT goods.id,
    goods.name,
    goods.price,
    goods.img_thumb_address,
    goods.img_address,
    categories.name AS category,
    goods.status,
    goods.description
   FROM (lesson_7.goods
     JOIN lesson_7.categories ON ((goods.id_category = categories.id)))
  ORDER BY goods.id;


ALTER TABLE lesson_7.goods_list OWNER TO admin;

--
-- Name: order; Type: TABLE; Schema: lesson_7; Owner: admin
--

CREATE TABLE lesson_7."order" (
    id integer NOT NULL,
    id_user integer NOT NULL,
    created timestamp without time zone NOT NULL,
    id_order_status integer DEFAULT 1 NOT NULL,
    total_price numeric(10,2) NOT NULL
);


ALTER TABLE lesson_7."order" OWNER TO admin;

--
-- Name: order_id_seq; Type: SEQUENCE; Schema: lesson_7; Owner: admin
--

CREATE SEQUENCE lesson_7.order_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_7.order_id_seq OWNER TO admin;

--
-- Name: order_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_7; Owner: admin
--

ALTER SEQUENCE lesson_7.order_id_seq OWNED BY lesson_7."order".id;


--
-- Name: order_status; Type: TABLE; Schema: lesson_7; Owner: admin
--

CREATE TABLE lesson_7.order_status (
    id integer NOT NULL,
    name character varying(50) NOT NULL
);


ALTER TABLE lesson_7.order_status OWNER TO admin;

--
-- Name: order_info; Type: VIEW; Schema: lesson_7; Owner: admin
--

CREATE VIEW lesson_7.order_info AS
 SELECT "order".id_user AS user_id,
    "order".id AS order_id,
    goods.id AS goods_id,
    order_status.id AS status_id,
    "order".created,
    basket.price,
    order_status.name AS status,
    goods.name AS good_name
   FROM (((lesson_7."order"
     JOIN lesson_7.basket ON (("order".id = basket.id_order)))
     JOIN lesson_7.goods ON ((basket.id_good = goods.id)))
     JOIN lesson_7.order_status ON (("order".id_order_status = order_status.id)));


ALTER TABLE lesson_7.order_info OWNER TO admin;

--
-- Name: users; Type: TABLE; Schema: lesson_7; Owner: admin
--

CREATE TABLE lesson_7.users (
    id integer NOT NULL,
    name character varying(128) NOT NULL,
    email character varying(128) NOT NULL,
    password character varying(64) NOT NULL,
    last_actions character varying(256)
);


ALTER TABLE lesson_7.users OWNER TO admin;

--
-- Name: order_list; Type: VIEW; Schema: lesson_7; Owner: admin
--

CREATE VIEW lesson_7.order_list AS
 SELECT "order".id,
    users.id AS user_id,
    users.name AS user_name,
    users.email AS user_email,
    "order".created,
    "order".total_price,
    order_status.id AS status_id,
    order_status.name AS status
   FROM ((lesson_7."order"
     JOIN lesson_7.users ON (("order".id_user = users.id)))
     JOIN lesson_7.order_status ON (("order".id_order_status = order_status.id)))
  ORDER BY "order".id DESC;


ALTER TABLE lesson_7.order_list OWNER TO admin;

--
-- Name: order_status_id_seq; Type: SEQUENCE; Schema: lesson_7; Owner: admin
--

CREATE SEQUENCE lesson_7.order_status_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_7.order_status_id_seq OWNER TO admin;

--
-- Name: order_status_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_7; Owner: admin
--

ALTER SEQUENCE lesson_7.order_status_id_seq OWNED BY lesson_7.order_status.id;


--
-- Name: role; Type: TABLE; Schema: lesson_7; Owner: admin
--

CREATE TABLE lesson_7.role (
    id integer NOT NULL,
    role_name character varying NOT NULL
);


ALTER TABLE lesson_7.role OWNER TO admin;

--
-- Name: role_id_seq; Type: SEQUENCE; Schema: lesson_7; Owner: admin
--

CREATE SEQUENCE lesson_7.role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_7.role_id_seq OWNER TO admin;

--
-- Name: role_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_7; Owner: admin
--

ALTER SEQUENCE lesson_7.role_id_seq OWNED BY lesson_7.role.id;


--
-- Name: user_role; Type: TABLE; Schema: lesson_7; Owner: admin
--

CREATE TABLE lesson_7.user_role (
    id integer NOT NULL,
    id_user integer NOT NULL,
    id_role integer NOT NULL
);


ALTER TABLE lesson_7.user_role OWNER TO admin;

--
-- Name: user_role_id_seq; Type: SEQUENCE; Schema: lesson_7; Owner: admin
--

CREATE SEQUENCE lesson_7.user_role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_7.user_role_id_seq OWNER TO admin;

--
-- Name: user_role_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_7; Owner: admin
--

ALTER SEQUENCE lesson_7.user_role_id_seq OWNED BY lesson_7.user_role.id;


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: lesson_7; Owner: admin
--

CREATE SEQUENCE lesson_7.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_7.users_id_seq OWNER TO admin;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_7; Owner: admin
--

ALTER SEQUENCE lesson_7.users_id_seq OWNED BY lesson_7.users.id;


--
-- Name: basket id; Type: DEFAULT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.basket ALTER COLUMN id SET DEFAULT nextval('lesson_7.basket_id_seq'::regclass);


--
-- Name: categories id; Type: DEFAULT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.categories ALTER COLUMN id SET DEFAULT nextval('lesson_7.categories_id_seq'::regclass);


--
-- Name: goods id; Type: DEFAULT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.goods ALTER COLUMN id SET DEFAULT nextval('lesson_7.goods_id_seq'::regclass);


--
-- Name: order id; Type: DEFAULT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7."order" ALTER COLUMN id SET DEFAULT nextval('lesson_7.order_id_seq'::regclass);


--
-- Name: order_status id; Type: DEFAULT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.order_status ALTER COLUMN id SET DEFAULT nextval('lesson_7.order_status_id_seq'::regclass);


--
-- Name: role id; Type: DEFAULT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.role ALTER COLUMN id SET DEFAULT nextval('lesson_7.role_id_seq'::regclass);


--
-- Name: user_role id; Type: DEFAULT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.user_role ALTER COLUMN id SET DEFAULT nextval('lesson_7.user_role_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.users ALTER COLUMN id SET DEFAULT nextval('lesson_7.users_id_seq'::regclass);


--
-- Name: basket basket_pk; Type: CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.basket
    ADD CONSTRAINT basket_pk PRIMARY KEY (id);


--
-- Name: categories categories_pk; Type: CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.categories
    ADD CONSTRAINT categories_pk PRIMARY KEY (id);


--
-- Name: goods goods_pk; Type: CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.goods
    ADD CONSTRAINT goods_pk PRIMARY KEY (id);


--
-- Name: order order_pk; Type: CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7."order"
    ADD CONSTRAINT order_pk PRIMARY KEY (id);


--
-- Name: order_status order_status_pk; Type: CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.order_status
    ADD CONSTRAINT order_status_pk PRIMARY KEY (id);


--
-- Name: role role_pk; Type: CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.role
    ADD CONSTRAINT role_pk PRIMARY KEY (id);


--
-- Name: user_role user_role_pk; Type: CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.user_role
    ADD CONSTRAINT user_role_pk PRIMARY KEY (id);


--
-- Name: users users_pk; Type: CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.users
    ADD CONSTRAINT users_pk PRIMARY KEY (id);


--
-- Name: basket_id_uindex; Type: INDEX; Schema: lesson_7; Owner: admin
--

CREATE UNIQUE INDEX basket_id_uindex ON lesson_7.basket USING btree (id);


--
-- Name: categories_id_uindex; Type: INDEX; Schema: lesson_7; Owner: admin
--

CREATE UNIQUE INDEX categories_id_uindex ON lesson_7.categories USING btree (id);


--
-- Name: goods_id_uindex; Type: INDEX; Schema: lesson_7; Owner: admin
--

CREATE UNIQUE INDEX goods_id_uindex ON lesson_7.goods USING btree (id);


--
-- Name: order_id_uindex; Type: INDEX; Schema: lesson_7; Owner: admin
--

CREATE UNIQUE INDEX order_id_uindex ON lesson_7."order" USING btree (id);


--
-- Name: order_status_id_uindex; Type: INDEX; Schema: lesson_7; Owner: admin
--

CREATE UNIQUE INDEX order_status_id_uindex ON lesson_7.order_status USING btree (id);


--
-- Name: role_id_uindex; Type: INDEX; Schema: lesson_7; Owner: admin
--

CREATE UNIQUE INDEX role_id_uindex ON lesson_7.role USING btree (id);


--
-- Name: role_role_name_uindex; Type: INDEX; Schema: lesson_7; Owner: admin
--

CREATE UNIQUE INDEX role_role_name_uindex ON lesson_7.role USING btree (role_name);


--
-- Name: user_role_id_uindex; Type: INDEX; Schema: lesson_7; Owner: admin
--

CREATE UNIQUE INDEX user_role_id_uindex ON lesson_7.user_role USING btree (id);


--
-- Name: users_email_uindex; Type: INDEX; Schema: lesson_7; Owner: admin
--

CREATE UNIQUE INDEX users_email_uindex ON lesson_7.users USING btree (email);


--
-- Name: users_id_uindex; Type: INDEX; Schema: lesson_7; Owner: admin
--

CREATE UNIQUE INDEX users_id_uindex ON lesson_7.users USING btree (id);


--
-- Name: users tr_add_user_role; Type: TRIGGER; Schema: lesson_7; Owner: admin
--

CREATE TRIGGER tr_add_user_role AFTER INSERT ON lesson_7.users FOR EACH ROW EXECUTE PROCEDURE lesson_7.add_user_role();


--
-- Name: order tr_update_basket; Type: TRIGGER; Schema: lesson_7; Owner: admin
--

CREATE TRIGGER tr_update_basket AFTER INSERT ON lesson_7."order" FOR EACH ROW EXECUTE PROCEDURE lesson_7.update_basket();


--
-- Name: basket basket_goods_id_fk; Type: FK CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.basket
    ADD CONSTRAINT basket_goods_id_fk FOREIGN KEY (id_good) REFERENCES lesson_7.goods(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: basket basket_order_id_fk; Type: FK CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.basket
    ADD CONSTRAINT basket_order_id_fk FOREIGN KEY (id_order) REFERENCES lesson_7."order"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: basket basket_users_id_fk; Type: FK CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.basket
    ADD CONSTRAINT basket_users_id_fk FOREIGN KEY (id_user) REFERENCES lesson_7.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: goods goods_categories_id_fk; Type: FK CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.goods
    ADD CONSTRAINT goods_categories_id_fk FOREIGN KEY (id_category) REFERENCES lesson_7.categories(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: order order_order_status_id_fk; Type: FK CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7."order"
    ADD CONSTRAINT order_order_status_id_fk FOREIGN KEY (id_order_status) REFERENCES lesson_7.order_status(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: order order_users_id_fk; Type: FK CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7."order"
    ADD CONSTRAINT order_users_id_fk FOREIGN KEY (id_user) REFERENCES lesson_7.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: user_role user_role_role_id_fk; Type: FK CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.user_role
    ADD CONSTRAINT user_role_role_id_fk FOREIGN KEY (id_role) REFERENCES lesson_7.role(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: user_role user_role_users_id_fk; Type: FK CONSTRAINT; Schema: lesson_7; Owner: admin
--

ALTER TABLE ONLY lesson_7.user_role
    ADD CONSTRAINT user_role_users_id_fk FOREIGN KEY (id_user) REFERENCES lesson_7.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

