--
-- PostgreSQL database dump
--

-- Dumped from database version 10.10 (Ubuntu 10.10-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 10.10 (Ubuntu 10.10-0ubuntu0.18.04.1)

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

DROP INDEX lesson_5.user_email_uindex;
ALTER TABLE ONLY public.product DROP CONSTRAINT product_pk;
ALTER TABLE ONLY lesson_5.users DROP CONSTRAINT user_pk;
ALTER TABLE public.product ALTER COLUMN id DROP DEFAULT;
ALTER TABLE lesson_5.users ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.product_id_seq;
DROP TABLE public.product;
DROP SEQUENCE lesson_5.user_id_seq;
DROP TABLE lesson_5.users;
DROP EXTENSION plpgsql;
DROP SCHEMA public;
DROP SCHEMA lesson_5;
--
-- Name: lesson_5; Type: SCHEMA; Schema: -; Owner: admin
--

CREATE SCHEMA lesson_5;


ALTER SCHEMA lesson_5 OWNER TO admin;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: users; Type: TABLE; Schema: lesson_5; Owner: admin
--

CREATE TABLE lesson_5.users (
    id integer NOT NULL,
    name character varying(128) NOT NULL,
    email character varying(128) NOT NULL,
    password character varying(64) NOT NULL,
    last_actions character varying(256)
);


ALTER TABLE lesson_5.users OWNER TO admin;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: lesson_5; Owner: admin
--

CREATE SEQUENCE lesson_5.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE lesson_5.user_id_seq OWNER TO admin;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: lesson_5; Owner: admin
--

ALTER SEQUENCE lesson_5.user_id_seq OWNED BY lesson_5.users.id;


--
-- Name: product; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.product (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    price integer NOT NULL,
    count integer,
    add_date date
);


ALTER TABLE public.product OWNER TO admin;

--
-- Name: product_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.product_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_id_seq OWNER TO admin;

--
-- Name: product_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.product_id_seq OWNED BY public.product.id;


--
-- Name: users id; Type: DEFAULT; Schema: lesson_5; Owner: admin
--

ALTER TABLE ONLY lesson_5.users ALTER COLUMN id SET DEFAULT nextval('lesson_5.user_id_seq'::regclass);


--
-- Name: product id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.product ALTER COLUMN id SET DEFAULT nextval('public.product_id_seq'::regclass);


--
-- Data for Name: users; Type: TABLE DATA; Schema: lesson_5; Owner: admin
--

COPY lesson_5.users (id, name, email, password, last_actions) FROM stdin;
26	kelevra24	kelevra24@gmail.com	$2y$10$/xOYH0ThdHRlU7xWw8ou7u72fIB7/HGAm5BAURnug2Iv82tchSC82	
20	kelevra23	kelevra23@gmail.com	$2y$10$/5sT9f9cP6c8T/OrnYOsWeEI85MfJK3L370zTEf8gHMXwt9jaYqKC	a:5:{i:0;s:11:"user/logout";i:1;s:0:"";i:2;s:7:"cabinet";i:3;s:7:"cabinet";i:4;s:11:"user/logout";}
\.


--
-- Data for Name: product; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.product (id, name, price, count, add_date) FROM stdin;
1	Nike	999	25	2019-09-30
2	Adidas	799	37	2019-09-30
3	NB	1099	84	2019-09-30
4	Puma	699	13	2019-09-30
5	UMBRO	1599	6	2019-09-30
6	Jack&Jones	999	66	2019-09-30
7	Nike	999	25	2019-09-30
8	Adidas	799	37	2019-09-30
9	NB	1099	84	2019-09-30
10	Puma	699	13	2019-09-30
11	UMBRO	1599	6	2019-09-30
12	Jack&Jones	999	66	2019-09-30
13	Nike	999	25	2019-09-30
14	Adidas	799	37	2019-09-30
15	NB	1099	84	2019-09-30
16	Puma	699	13	2019-09-30
17	UMBRO	1599	6	2019-09-30
18	Jack&Jones	999	66	2019-09-30
19	Nike	999	25	2019-09-30
20	Adidas	799	37	2019-09-30
21	NB	1099	84	2019-09-30
22	Puma	699	13	2019-09-30
23	UMBRO	1599	6	2019-09-30
24	Jack&Jones	999	66	2019-09-30
\.


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: lesson_5; Owner: admin
--

SELECT pg_catalog.setval('lesson_5.user_id_seq', 27, true);


--
-- Name: product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.product_id_seq', 24, true);


--
-- Name: users user_pk; Type: CONSTRAINT; Schema: lesson_5; Owner: admin
--

ALTER TABLE ONLY lesson_5.users
    ADD CONSTRAINT user_pk PRIMARY KEY (id);


--
-- Name: product product_pk; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pk PRIMARY KEY (id);


--
-- Name: user_email_uindex; Type: INDEX; Schema: lesson_5; Owner: admin
--

CREATE UNIQUE INDEX user_email_uindex ON lesson_5.users USING btree (email);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

