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

ALTER TABLE ONLY lesson_6.user_role DROP CONSTRAINT user_role_users_id_fk;
ALTER TABLE ONLY lesson_6.user_role DROP CONSTRAINT user_role_role_id_fk;
ALTER TABLE ONLY lesson_6."order" DROP CONSTRAINT order_users_id_fk;
ALTER TABLE ONLY lesson_6."order" DROP CONSTRAINT order_order_status_id_fk;
ALTER TABLE ONLY lesson_6.goods DROP CONSTRAINT goods_categories_id_fk;
ALTER TABLE ONLY lesson_6.basket DROP CONSTRAINT basket_users_id_fk;
ALTER TABLE ONLY lesson_6.basket DROP CONSTRAINT basket_order_id_fk;
ALTER TABLE ONLY lesson_6.basket DROP CONSTRAINT basket_goods_id_fk;
DROP TRIGGER tr_update_basket ON lesson_6."order";
DROP TRIGGER tr_add_user_role ON lesson_6.users;
DROP INDEX lesson_6.users_id_uindex;
DROP INDEX lesson_6.users_email_uindex;
DROP INDEX lesson_6.user_role_id_uindex;
DROP INDEX lesson_6.role_role_name_uindex;
DROP INDEX lesson_6.role_id_uindex;
DROP INDEX lesson_6.order_status_id_uindex;
DROP INDEX lesson_6.order_id_uindex;
DROP INDEX lesson_6.goods_id_uindex;
DROP INDEX lesson_6.categories_id_uindex;
DROP INDEX lesson_6.basket_id_uindex;
ALTER TABLE ONLY lesson_6.users DROP CONSTRAINT users_pk;
ALTER TABLE ONLY lesson_6.user_role DROP CONSTRAINT user_role_pk;
ALTER TABLE ONLY lesson_6.role DROP CONSTRAINT role_pk;
ALTER TABLE ONLY lesson_6.order_status DROP CONSTRAINT order_status_pk;
ALTER TABLE ONLY lesson_6."order" DROP CONSTRAINT order_pk;
ALTER TABLE ONLY lesson_6.goods DROP CONSTRAINT goods_pk;
ALTER TABLE ONLY lesson_6.categories DROP CONSTRAINT categories_pk;
ALTER TABLE ONLY lesson_6.basket DROP CONSTRAINT basket_pk;
ALTER TABLE lesson_6.users ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_6.user_role ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_6.role ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_6.order_status ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_6."order" ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_6.goods ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_6.categories ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_6.basket ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE lesson_6.users_id_seq;
DROP SEQUENCE lesson_6.user_role_id_seq;
DROP TABLE lesson_6.user_role;
DROP SEQUENCE lesson_6.role_id_seq;
DROP TABLE lesson_6.role;
DROP SEQUENCE lesson_6.order_status_id_seq;
DROP VIEW lesson_6.order_list;
DROP TABLE lesson_6.users;
DROP VIEW lesson_6.order_info;
DROP TABLE lesson_6.order_status;
DROP SEQUENCE lesson_6.order_id_seq;
DROP TABLE lesson_6."order";
DROP SEQUENCE lesson_6.goods_id_seq;
DROP TABLE lesson_6.goods;
DROP SEQUENCE lesson_6.categories_id_seq;
DROP TABLE lesson_6.categories;
DROP SEQUENCE lesson_6.basket_id_seq;
DROP TABLE lesson_6.basket;
DROP FUNCTION lesson_6.update_basket();
DROP FUNCTION lesson_6.add_user_role();
DROP SCHEMA lesson_6;
--
-- Name: lesson_6; Type: SCHEMA; Schema: -; Owner: admin
--

CREATE SCHEMA lesson_6;


ALTER SCHEMA lesson_6 OWNER TO admin;

--
-- Name: add_user_role(); Type: FUNCTION; Schema: lesson_6; Owner: admin
--

CREATE FUNCTION lesson_6.add_user_role() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    INSERT INTO lesson_6.user_role (id_user, id_role) VALUES (NEW.id, 1);
    RETURN NEW;
END;
$$;


ALTER FUNCTION lesson_6.add_user_role() OWNER TO admin;

--
-- Name: update_basket(); Type: FUNCTION; Schema: lesson_6; Owner: admin
--

CREATE FUNCTION lesson_6.update_basket() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    UPDATE lesson_6.basket SET id_order = NEW.id WHERE id_user = NEW.id_user AND is_in_order = false;
    UPDATE lesson_6.basket SET is_in_order = true WHERE id_order = NEW.id;
    RETURN NEW;
END;
$$;


ALTER FUNCTION lesson_6.update_basket() OWNER TO admin;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: basket; Type: TABLE; Schema: lesson_6; Owner: admin
--

CREATE TABLE lesson_6.basket (
    id integer NOT NULL,
    id_user integer NOT NULL,
    id_good integer NOT NULL,
    price real NOT NULL,
    is_in_order boolean DEFAULT false NOT NULL,
    id_order integer
);


ALTER TABLE lesson_6.basket OWNER TO admin;

--
-- Name: basket_id_seq; Type: SEQUENCE; Schema: lesson_6; Owner: admin
--

CREATE SEQUENCE lesson_6.basket_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_6.basket_id_seq OWNER TO admin;

--
-- Name: basket_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_6; Owner: admin
--

ALTER SEQUENCE lesson_6.basket_id_seq OWNED BY lesson_6.basket.id;


--
-- Name: categories; Type: TABLE; Schema: lesson_6; Owner: admin
--

CREATE TABLE lesson_6.categories (
    id integer NOT NULL,
    status integer,
    name character varying NOT NULL
);


ALTER TABLE lesson_6.categories OWNER TO admin;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: lesson_6; Owner: admin
--

CREATE SEQUENCE lesson_6.categories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_6.categories_id_seq OWNER TO admin;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_6; Owner: admin
--

ALTER SEQUENCE lesson_6.categories_id_seq OWNED BY lesson_6.categories.id;


--
-- Name: goods; Type: TABLE; Schema: lesson_6; Owner: admin
--

CREATE TABLE lesson_6.goods (
    id integer NOT NULL,
    name character varying NOT NULL,
    price double precision NOT NULL,
    id_category integer NOT NULL,
    status integer,
    description character varying(256)
);


ALTER TABLE lesson_6.goods OWNER TO admin;

--
-- Name: goods_id_seq; Type: SEQUENCE; Schema: lesson_6; Owner: admin
--

CREATE SEQUENCE lesson_6.goods_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_6.goods_id_seq OWNER TO admin;

--
-- Name: goods_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_6; Owner: admin
--

ALTER SEQUENCE lesson_6.goods_id_seq OWNED BY lesson_6.goods.id;


--
-- Name: order; Type: TABLE; Schema: lesson_6; Owner: admin
--

CREATE TABLE lesson_6."order" (
    id integer NOT NULL,
    id_user integer NOT NULL,
    created timestamp without time zone NOT NULL,
    id_order_status integer DEFAULT 1 NOT NULL,
    total_price double precision NOT NULL
);


ALTER TABLE lesson_6."order" OWNER TO admin;

--
-- Name: order_id_seq; Type: SEQUENCE; Schema: lesson_6; Owner: admin
--

CREATE SEQUENCE lesson_6.order_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_6.order_id_seq OWNER TO admin;

--
-- Name: order_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_6; Owner: admin
--

ALTER SEQUENCE lesson_6.order_id_seq OWNED BY lesson_6."order".id;


--
-- Name: order_status; Type: TABLE; Schema: lesson_6; Owner: admin
--

CREATE TABLE lesson_6.order_status (
    id integer NOT NULL,
    name character varying(50) NOT NULL
);


ALTER TABLE lesson_6.order_status OWNER TO admin;

--
-- Name: order_info; Type: VIEW; Schema: lesson_6; Owner: admin
--

CREATE VIEW lesson_6.order_info AS
 SELECT "order".id AS order_id,
    goods.id AS goods_id,
    "order".created,
    basket.price,
    order_status.name AS status,
    goods.name AS good_name
   FROM (((lesson_6."order"
     JOIN lesson_6.basket ON (("order".id = basket.id_order)))
     JOIN lesson_6.goods ON ((basket.id_good = goods.id)))
     JOIN lesson_6.order_status ON (("order".id_order_status = order_status.id)));


ALTER TABLE lesson_6.order_info OWNER TO admin;

--
-- Name: users; Type: TABLE; Schema: lesson_6; Owner: admin
--

CREATE TABLE lesson_6.users (
    id integer NOT NULL,
    name character varying(128) NOT NULL,
    email character varying(128) NOT NULL,
    password character varying(64) NOT NULL,
    last_actions character varying(256)
);


ALTER TABLE lesson_6.users OWNER TO admin;

--
-- Name: order_list; Type: VIEW; Schema: lesson_6; Owner: admin
--

CREATE VIEW lesson_6.order_list AS
 SELECT "order".id,
    users.name AS user_name,
    users.email AS user_email,
    "order".created,
    "order".total_price,
    order_status.name AS status
   FROM ((lesson_6."order"
     JOIN lesson_6.users ON (("order".id_user = users.id)))
     JOIN lesson_6.order_status ON (("order".id_order_status = order_status.id)))
  ORDER BY "order".id DESC;


ALTER TABLE lesson_6.order_list OWNER TO admin;

--
-- Name: order_status_id_seq; Type: SEQUENCE; Schema: lesson_6; Owner: admin
--

CREATE SEQUENCE lesson_6.order_status_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_6.order_status_id_seq OWNER TO admin;

--
-- Name: order_status_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_6; Owner: admin
--

ALTER SEQUENCE lesson_6.order_status_id_seq OWNED BY lesson_6.order_status.id;


--
-- Name: role; Type: TABLE; Schema: lesson_6; Owner: admin
--

CREATE TABLE lesson_6.role (
    id integer NOT NULL,
    role_name character varying NOT NULL
);


ALTER TABLE lesson_6.role OWNER TO admin;

--
-- Name: role_id_seq; Type: SEQUENCE; Schema: lesson_6; Owner: admin
--

CREATE SEQUENCE lesson_6.role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_6.role_id_seq OWNER TO admin;

--
-- Name: role_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_6; Owner: admin
--

ALTER SEQUENCE lesson_6.role_id_seq OWNED BY lesson_6.role.id;


--
-- Name: user_role; Type: TABLE; Schema: lesson_6; Owner: admin
--

CREATE TABLE lesson_6.user_role (
    id integer NOT NULL,
    id_user integer NOT NULL,
    id_role integer NOT NULL
);


ALTER TABLE lesson_6.user_role OWNER TO admin;

--
-- Name: user_role_id_seq; Type: SEQUENCE; Schema: lesson_6; Owner: admin
--

CREATE SEQUENCE lesson_6.user_role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_6.user_role_id_seq OWNER TO admin;

--
-- Name: user_role_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_6; Owner: admin
--

ALTER SEQUENCE lesson_6.user_role_id_seq OWNED BY lesson_6.user_role.id;


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: lesson_6; Owner: admin
--

CREATE SEQUENCE lesson_6.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_6.users_id_seq OWNER TO admin;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_6; Owner: admin
--

ALTER SEQUENCE lesson_6.users_id_seq OWNED BY lesson_6.users.id;


--
-- Name: basket id; Type: DEFAULT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.basket ALTER COLUMN id SET DEFAULT nextval('lesson_6.basket_id_seq'::regclass);


--
-- Name: categories id; Type: DEFAULT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.categories ALTER COLUMN id SET DEFAULT nextval('lesson_6.categories_id_seq'::regclass);


--
-- Name: goods id; Type: DEFAULT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.goods ALTER COLUMN id SET DEFAULT nextval('lesson_6.goods_id_seq'::regclass);


--
-- Name: order id; Type: DEFAULT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6."order" ALTER COLUMN id SET DEFAULT nextval('lesson_6.order_id_seq'::regclass);


--
-- Name: order_status id; Type: DEFAULT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.order_status ALTER COLUMN id SET DEFAULT nextval('lesson_6.order_status_id_seq'::regclass);


--
-- Name: role id; Type: DEFAULT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.role ALTER COLUMN id SET DEFAULT nextval('lesson_6.role_id_seq'::regclass);


--
-- Name: user_role id; Type: DEFAULT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.user_role ALTER COLUMN id SET DEFAULT nextval('lesson_6.user_role_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.users ALTER COLUMN id SET DEFAULT nextval('lesson_6.users_id_seq'::regclass);


--
-- Data for Name: basket; Type: TABLE DATA; Schema: lesson_6; Owner: admin
--

COPY lesson_6.basket (id, id_user, id_good, price, is_in_order, id_order) FROM stdin;
79	20	1	9999	t	49
80	20	2	7999	t	50
81	20	5	21999	t	50
82	21	5	21999	t	51
83	21	4	11999	t	52
84	21	2	7999	t	53
85	21	7	15999	t	53
86	20	2	7999	t	54
87	20	1	9999	t	55
88	21	5	21999	f	\N
89	21	7	15999	f	\N
90	20	2	7999	f	\N
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: lesson_6; Owner: admin
--

COPY lesson_6.categories (id, status, name) FROM stdin;
1	1	phones
2	1	laptops
\.


--
-- Data for Name: goods; Type: TABLE DATA; Schema: lesson_6; Owner: admin
--

COPY lesson_6.goods (id, name, price, id_category, status, description) FROM stdin;
2	miphone	7999	1	1	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolores fuga fugit incidunt ipsum iure iusto, laborum libero magnam maxime natus, nesciunt numquam porro possimus quisquam ratione rem repudiandae sed.
1	iphone	9999	1	1	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolores fuga fugit incidunt ipsum iure iusto, laborum libero magnam maxime natus, nesciunt numquam porro possimus quisquam ratione rem repudiandae sed.
3	nokia	4999	1	0	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolores fuga fugit incidunt ipsum iure iusto, laborum libero magnam maxime natus, nesciunt numquam porro possimus quisquam ratione rem repudiandae sed.
4	pixel	11999	1	1	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolores fuga fugit incidunt ipsum iure iusto, laborum libero magnam maxime natus, nesciunt numquam porro possimus quisquam ratione rem repudiandae sed.
5	macbook	21999	2	1	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolores fuga fugit incidunt ipsum iure iusto, laborum libero magnam maxime natus, nesciunt numquam porro possimus quisquam ratione rem repudiandae sed.
6	surface	11999	2	0	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolores fuga fugit incidunt ipsum iure iusto, laborum libero magnam maxime natus, nesciunt numquam porro possimus quisquam ratione rem repudiandae sed.
7	minotebook	15999	2	1	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolores fuga fugit incidunt ipsum iure iusto, laborum libero magnam maxime natus, nesciunt numquam porro possimus quisquam ratione rem repudiandae sed.
\.


--
-- Data for Name: order; Type: TABLE DATA; Schema: lesson_6; Owner: admin
--

COPY lesson_6."order" (id, id_user, created, id_order_status, total_price) FROM stdin;
50	20	2019-11-28 19:34:02	3	29998
55	20	2019-12-11 21:27:19	1	9999
52	21	2019-11-28 20:01:16	3	11999
54	20	2019-11-29 20:46:19	1	7999
53	21	2019-11-28 20:01:35	3	23998
49	20	2019-11-28 19:31:58	1	9999
51	21	2019-11-28 20:01:05	1	21999
\.


--
-- Data for Name: order_status; Type: TABLE DATA; Schema: lesson_6; Owner: admin
--

COPY lesson_6.order_status (id, name) FROM stdin;
1	В работе
2	Отгружен со склада
3	В пути
4	Доставлен
\.


--
-- Data for Name: role; Type: TABLE DATA; Schema: lesson_6; Owner: admin
--

COPY lesson_6.role (id, role_name) FROM stdin;
2	admin
1	user
\.


--
-- Data for Name: user_role; Type: TABLE DATA; Schema: lesson_6; Owner: admin
--

COPY lesson_6.user_role (id, id_user, id_role) FROM stdin;
18	20	1
19	21	1
20	22	1
22	20	2
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: lesson_6; Owner: admin
--

COPY lesson_6.users (id, name, email, password, last_actions) FROM stdin;
22	kelevra25	kelevra25@gmail.com	$2y$10$Xy8aFAN6HY.T4Q24x6pZy.HrlrTuOEOCe3W3fzRWluNSAeqhNnFFK	a:4:{i:0;s:7:"cabinet";i:1;s:0:"";i:2;s:12:"goods/view/2";i:3;s:11:"user/logout";}
21	kelevra24	kelevra24@gmail.com	$2y$10$ZmIL8HOajn3aQqJCDf.XnuNlsv9c0OLOepaqS/bdYzigyp1fBxGOi	a:5:{i:0;s:12:"goods/view/7";i:1;s:6:"basket";i:2;s:12:"order/create";i:3;s:0:"";i:4;s:11:"user/logout";}
20	kelevra23	kelevra23@gmail.com	$2y$10$fMLS8ii2qdHlsssyQ/.SEuI/T6UTXhkf6kZFTdNswybpMO5I7yhXy	a:5:{i:0;s:7:"cabinet";i:1;s:5:"admin";i:2;s:11:"admin/order";i:3;s:0:"";i:4;s:11:"user/logout";}
\.


--
-- Name: basket_id_seq; Type: SEQUENCE SET; Schema: lesson_6; Owner: admin
--

SELECT pg_catalog.setval('lesson_6.basket_id_seq', 90, true);


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: lesson_6; Owner: admin
--

SELECT pg_catalog.setval('lesson_6.categories_id_seq', 2, true);


--
-- Name: goods_id_seq; Type: SEQUENCE SET; Schema: lesson_6; Owner: admin
--

SELECT pg_catalog.setval('lesson_6.goods_id_seq', 7, true);


--
-- Name: order_id_seq; Type: SEQUENCE SET; Schema: lesson_6; Owner: admin
--

SELECT pg_catalog.setval('lesson_6.order_id_seq', 55, true);


--
-- Name: order_status_id_seq; Type: SEQUENCE SET; Schema: lesson_6; Owner: admin
--

SELECT pg_catalog.setval('lesson_6.order_status_id_seq', 4, true);


--
-- Name: role_id_seq; Type: SEQUENCE SET; Schema: lesson_6; Owner: admin
--

SELECT pg_catalog.setval('lesson_6.role_id_seq', 2, true);


--
-- Name: user_role_id_seq; Type: SEQUENCE SET; Schema: lesson_6; Owner: admin
--

SELECT pg_catalog.setval('lesson_6.user_role_id_seq', 28, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: lesson_6; Owner: admin
--

SELECT pg_catalog.setval('lesson_6.users_id_seq', 22, true);


--
-- Name: basket basket_pk; Type: CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.basket
    ADD CONSTRAINT basket_pk PRIMARY KEY (id);


--
-- Name: categories categories_pk; Type: CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.categories
    ADD CONSTRAINT categories_pk PRIMARY KEY (id);


--
-- Name: goods goods_pk; Type: CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.goods
    ADD CONSTRAINT goods_pk PRIMARY KEY (id);


--
-- Name: order order_pk; Type: CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6."order"
    ADD CONSTRAINT order_pk PRIMARY KEY (id);


--
-- Name: order_status order_status_pk; Type: CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.order_status
    ADD CONSTRAINT order_status_pk PRIMARY KEY (id);


--
-- Name: role role_pk; Type: CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.role
    ADD CONSTRAINT role_pk PRIMARY KEY (id);


--
-- Name: user_role user_role_pk; Type: CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.user_role
    ADD CONSTRAINT user_role_pk PRIMARY KEY (id);


--
-- Name: users users_pk; Type: CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.users
    ADD CONSTRAINT users_pk PRIMARY KEY (id);


--
-- Name: basket_id_uindex; Type: INDEX; Schema: lesson_6; Owner: admin
--

CREATE UNIQUE INDEX basket_id_uindex ON lesson_6.basket USING btree (id);


--
-- Name: categories_id_uindex; Type: INDEX; Schema: lesson_6; Owner: admin
--

CREATE UNIQUE INDEX categories_id_uindex ON lesson_6.categories USING btree (id);


--
-- Name: goods_id_uindex; Type: INDEX; Schema: lesson_6; Owner: admin
--

CREATE UNIQUE INDEX goods_id_uindex ON lesson_6.goods USING btree (id);


--
-- Name: order_id_uindex; Type: INDEX; Schema: lesson_6; Owner: admin
--

CREATE UNIQUE INDEX order_id_uindex ON lesson_6."order" USING btree (id);


--
-- Name: order_status_id_uindex; Type: INDEX; Schema: lesson_6; Owner: admin
--

CREATE UNIQUE INDEX order_status_id_uindex ON lesson_6.order_status USING btree (id);


--
-- Name: role_id_uindex; Type: INDEX; Schema: lesson_6; Owner: admin
--

CREATE UNIQUE INDEX role_id_uindex ON lesson_6.role USING btree (id);


--
-- Name: role_role_name_uindex; Type: INDEX; Schema: lesson_6; Owner: admin
--

CREATE UNIQUE INDEX role_role_name_uindex ON lesson_6.role USING btree (role_name);


--
-- Name: user_role_id_uindex; Type: INDEX; Schema: lesson_6; Owner: admin
--

CREATE UNIQUE INDEX user_role_id_uindex ON lesson_6.user_role USING btree (id);


--
-- Name: users_email_uindex; Type: INDEX; Schema: lesson_6; Owner: admin
--

CREATE UNIQUE INDEX users_email_uindex ON lesson_6.users USING btree (email);


--
-- Name: users_id_uindex; Type: INDEX; Schema: lesson_6; Owner: admin
--

CREATE UNIQUE INDEX users_id_uindex ON lesson_6.users USING btree (id);


--
-- Name: users tr_add_user_role; Type: TRIGGER; Schema: lesson_6; Owner: admin
--

CREATE TRIGGER tr_add_user_role AFTER INSERT ON lesson_6.users FOR EACH ROW EXECUTE PROCEDURE lesson_6.add_user_role();


--
-- Name: order tr_update_basket; Type: TRIGGER; Schema: lesson_6; Owner: admin
--

CREATE TRIGGER tr_update_basket AFTER INSERT ON lesson_6."order" FOR EACH ROW EXECUTE PROCEDURE lesson_6.update_basket();


--
-- Name: basket basket_goods_id_fk; Type: FK CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.basket
    ADD CONSTRAINT basket_goods_id_fk FOREIGN KEY (id_good) REFERENCES lesson_6.goods(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: basket basket_order_id_fk; Type: FK CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.basket
    ADD CONSTRAINT basket_order_id_fk FOREIGN KEY (id_order) REFERENCES lesson_6."order"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: basket basket_users_id_fk; Type: FK CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.basket
    ADD CONSTRAINT basket_users_id_fk FOREIGN KEY (id_user) REFERENCES lesson_6.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: goods goods_categories_id_fk; Type: FK CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.goods
    ADD CONSTRAINT goods_categories_id_fk FOREIGN KEY (id_category) REFERENCES lesson_6.categories(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: order order_order_status_id_fk; Type: FK CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6."order"
    ADD CONSTRAINT order_order_status_id_fk FOREIGN KEY (id_order_status) REFERENCES lesson_6.order_status(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: order order_users_id_fk; Type: FK CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6."order"
    ADD CONSTRAINT order_users_id_fk FOREIGN KEY (id_user) REFERENCES lesson_6.users(id);


--
-- Name: user_role user_role_role_id_fk; Type: FK CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.user_role
    ADD CONSTRAINT user_role_role_id_fk FOREIGN KEY (id_role) REFERENCES lesson_6.role(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: user_role user_role_users_id_fk; Type: FK CONSTRAINT; Schema: lesson_6; Owner: admin
--

ALTER TABLE ONLY lesson_6.user_role
    ADD CONSTRAINT user_role_users_id_fk FOREIGN KEY (id_user) REFERENCES lesson_6.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

