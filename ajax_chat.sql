--
-- PostgreSQL database dump
--

-- Dumped from database version 14.5
-- Dumped by pg_dump version 14.5

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: messages; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.messages (
    id integer NOT NULL,
    message text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at timestamp without time zone
);


ALTER TABLE public.messages OWNER TO root;

--
-- Name: messages_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

ALTER TABLE public.messages ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: phinxlog; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.phinxlog (
    version bigint NOT NULL,
    migration_name character varying(100),
    start_time timestamp without time zone,
    end_time timestamp without time zone,
    breakpoint boolean DEFAULT false NOT NULL
);


ALTER TABLE public.phinxlog OWNER TO root;

--
-- Name: users; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.users (
    id integer NOT NULL,
    name character varying(255),
    password character varying(255)
);


ALTER TABLE public.users OWNER TO root;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

ALTER TABLE public.users ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: users_messages; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.users_messages (
    id integer NOT NULL,
    user_id integer,
    message_id integer
);


ALTER TABLE public.users_messages OWNER TO root;

--
-- Name: users_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

ALTER TABLE public.users_messages ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.users_messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Data for Name: messages; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.messages (id, message, created_at, updated_at) FROM stdin;
42	salut	2023-07-19 19:32:16.266142	\N
43	je vais biens	2023-07-19 19:32:53.878622	\N
44	ok	2023-07-19 19:33:08.745136	\N
45	ok	2023-08-01 17:43:36.025482	\N
46	salut doe	2023-08-03 09:36:39.565157	\N
\.


--
-- Data for Name: phinxlog; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.phinxlog (version, migration_name, start_time, end_time, breakpoint) FROM stdin;
20230707173534	MessageTable	2023-07-07 17:58:19	2023-07-07 17:58:19	f
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.users (id, name, password) FROM stdin;
8	gautier	$2y$10$90QcLdz/O/LcgYtAH7VBaulXqRUtTRsFsZfTYWCXZIUOz/0hdlL6K
9	doe	$2y$10$JyvZfEq7LuNhNsFyffA/l.jX5SvUQEw4S5iWU08Rrf53mC7idmjl6
10	gaut	$2y$10$IpmBIEAPKVtQOujF.xlqwu47yTxDzImdkcPeviMDE1sa4UX3S24Te
\.


--
-- Data for Name: users_messages; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.users_messages (id, user_id, message_id) FROM stdin;
32	8	42
33	9	43
34	9	44
35	9	45
36	10	46
\.


--
-- Name: messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.messages_id_seq', 46, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.users_id_seq', 10, true);


--
-- Name: users_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.users_messages_id_seq', 36, true);


--
-- Name: messages messages_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.messages
    ADD CONSTRAINT messages_pkey PRIMARY KEY (id);


--
-- Name: phinxlog phinxlog_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.phinxlog
    ADD CONSTRAINT phinxlog_pkey PRIMARY KEY (version);


--
-- Name: users_messages users_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.users_messages
    ADD CONSTRAINT users_messages_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

