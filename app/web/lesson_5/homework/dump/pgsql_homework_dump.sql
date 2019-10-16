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
ALTER TABLE ONLY lesson_5.users DROP CONSTRAINT user_pk;
ALTER TABLE lesson_5.users ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE lesson_5.user_id_seq;
DROP TABLE lesson_5.users;
DROP SCHEMA lesson_5;
--
-- Name: lesson_5; Type: SCHEMA; Schema: -; Owner: admin
--

CREATE SCHEMA lesson_5;


ALTER SCHEMA lesson_5 OWNER TO admin;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: users; Type: TABLE; Schema: lesson_5; Owner: admin
--

CREATE TABLE lesson_5.users (
    id integer NOT NULL,
    name character varying(128) NOT NULL,
    email character varying(128) NOT NULL,
    password character varying(64) NOT NULL
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
-- Name: users id; Type: DEFAULT; Schema: lesson_5; Owner: admin
--

ALTER TABLE ONLY lesson_5.users ALTER COLUMN id SET DEFAULT nextval('lesson_5.user_id_seq'::regclass);


--
-- Data for Name: users; Type: TABLE DATA; Schema: lesson_5; Owner: admin
--

COPY lesson_5.users (id, name, email, password) FROM stdin;
20	kelevra23	kelevra23@gmail.com	$2y$10$/5sT9f9cP6c8T/OrnYOsWeEI85MfJK3L370zTEf8gHMXwt9jaYqKC
26	kelevra24	kelevra24@gmail.com	$2y$10$/xOYH0ThdHRlU7xWw8ou7u72fIB7/HGAm5BAURnug2Iv82tchSC82
\.


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: lesson_5; Owner: admin
--

SELECT pg_catalog.setval('lesson_5.user_id_seq', 26, true);


--
-- Name: users user_pk; Type: CONSTRAINT; Schema: lesson_5; Owner: admin
--

ALTER TABLE ONLY lesson_5.users
    ADD CONSTRAINT user_pk PRIMARY KEY (id);


--
-- Name: user_email_uindex; Type: INDEX; Schema: lesson_5; Owner: admin
--

CREATE UNIQUE INDEX user_email_uindex ON lesson_5.users USING btree (email);


--
-- PostgreSQL database dump complete
--

