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

ALTER TABLE ONLY public.product DROP CONSTRAINT product_pk;
ALTER TABLE public.product ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.product_id_seq;
DROP TABLE public.product;
DROP EXTENSION plpgsql;
DROP SCHEMA public;
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
-- Name: product id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.product ALTER COLUMN id SET DEFAULT nextval('public.product_id_seq'::regclass);


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
-- Name: product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.product_id_seq', 24, true);


--
-- Name: product product_pk; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pk PRIMARY KEY (id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

