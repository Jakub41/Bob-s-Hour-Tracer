--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.1
-- Dumped by pg_dump version 9.6.1

-- Started on 2016-11-28 03:33:25 CET

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12655)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2456 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 194 (class 1259 OID 16579)
-- Name: project_details; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE project_details (
    id integer NOT NULL,
    name character varying(75) NOT NULL,
    deadline date NOT NULL,
    status integer DEFAULT 1 NOT NULL,
    total_time time without time zone
);


ALTER TABLE project_details OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 16565)
-- Name: project_details_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE project_details_id_seq
    START WITH 4
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE project_details_id_seq OWNER TO postgres;

--
-- TOC entry 2457 (class 0 OID 0)
-- Dependencies: 187
-- Name: project_details_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE project_details_id_seq OWNED BY project_details.id;


--
-- TOC entry 188 (class 1259 OID 16567)
-- Name: project_details_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE project_details_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE project_details_seq OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 16569)
-- Name: project_status_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE project_status_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE project_status_seq OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 16584)
-- Name: project_status; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE project_status (
    id integer DEFAULT nextval('project_status_seq'::regclass) NOT NULL,
    name character varying(75) NOT NULL
);


ALTER TABLE project_status OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 16478)
-- Name: project_task_details; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE project_task_details (
    id integer NOT NULL,
    name character varying(75) NOT NULL,
    description character varying(255) NOT NULL,
    parent_id integer DEFAULT 0 NOT NULL,
    status_id integer DEFAULT 1 NOT NULL,
    start_date timestamp(0) without time zone DEFAULT NULL::timestamp without time zone NOT NULL,
    end_date timestamp(0) without time zone DEFAULT NULL::timestamp without time zone NOT NULL,
    deadline_date date NOT NULL,
    create_user integer NOT NULL,
    create_date date NOT NULL
);


ALTER TABLE project_task_details OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 16571)
-- Name: project_task_details_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE project_task_details_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE project_task_details_seq OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 16588)
-- Name: project_time; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE project_time (
    id integer NOT NULL,
    project_id integer,
    start timestamp(6) without time zone NOT NULL,
    finish timestamp(6) without time zone
);


ALTER TABLE project_time OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 16573)
-- Name: project_time_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE project_time_id_seq
    START WITH 8
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE project_time_id_seq OWNER TO postgres;

--
-- TOC entry 2458 (class 0 OID 0)
-- Dependencies: 191
-- Name: project_time_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE project_time_id_seq OWNED BY project_time.id;


--
-- TOC entry 192 (class 1259 OID 16575)
-- Name: project_time_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE project_time_seq
    START WITH 11
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE project_time_seq OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 16453)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE users (
    id integer NOT NULL,
    name character varying(255) DEFAULT NULL::character varying,
    birth_date timestamp(0) without time zone DEFAULT NULL::timestamp without time zone NOT NULL,
    email character varying(255) DEFAULT NULL::character varying,
    password character varying(255) DEFAULT NULL::character varying,
    profile_img character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE users OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 16577)
-- Name: users_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_seq OWNER TO postgres;

--
-- TOC entry 2305 (class 2604 OID 16582)
-- Name: project_details id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY project_details ALTER COLUMN id SET DEFAULT nextval('project_details_id_seq'::regclass);


--
-- TOC entry 2308 (class 2604 OID 16591)
-- Name: project_time id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY project_time ALTER COLUMN id SET DEFAULT nextval('project_time_id_seq'::regclass);


--
-- TOC entry 2447 (class 0 OID 16579)
-- Dependencies: 194
-- Data for Name: project_details; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY project_details (id, name, deadline, status, total_time) FROM stdin;
\.


--
-- TOC entry 2459 (class 0 OID 0)
-- Dependencies: 187
-- Name: project_details_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('project_details_id_seq', 8, true);


--
-- TOC entry 2460 (class 0 OID 0)
-- Dependencies: 188
-- Name: project_details_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('project_details_seq', 1, false);


--
-- TOC entry 2448 (class 0 OID 16584)
-- Dependencies: 195
-- Data for Name: project_status; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY project_status (id, name) FROM stdin;
1	Start
2	In progress
3	Closed
\.


--
-- TOC entry 2461 (class 0 OID 0)
-- Dependencies: 189
-- Name: project_status_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('project_status_seq', 1, false);


--
-- TOC entry 2439 (class 0 OID 16478)
-- Dependencies: 186
-- Data for Name: project_task_details; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY project_task_details (id, name, description, parent_id, status_id, start_date, end_date, deadline_date, create_user, create_date) FROM stdin;
\.


--
-- TOC entry 2462 (class 0 OID 0)
-- Dependencies: 190
-- Name: project_task_details_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('project_task_details_seq', 1, false);


--
-- TOC entry 2449 (class 0 OID 16588)
-- Dependencies: 196
-- Data for Name: project_time; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY project_time (id, project_id, start, finish) FROM stdin;
2	1	2016-11-27 22:35:09.674352	2016-11-27 23:35:14.794362
7	1	2016-11-27 23:42:08.643218	2016-11-27 23:42:15.394858
9	5	2016-11-28 01:43:16.634745	2016-11-28 01:43:37.338918
10	5	2016-11-28 01:45:00.69156	2016-11-28 01:46:01.968595
11	7	2016-11-28 02:36:42.816591	2016-11-28 02:36:53.401935
12	7	2016-11-28 02:44:56.267834	2016-11-28 02:45:01.718919
\.


--
-- TOC entry 2463 (class 0 OID 0)
-- Dependencies: 191
-- Name: project_time_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('project_time_id_seq', 12, true);


--
-- TOC entry 2464 (class 0 OID 0)
-- Dependencies: 192
-- Name: project_time_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('project_time_seq', 11, true);


--
-- TOC entry 2438 (class 0 OID 16453)
-- Dependencies: 185
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (id, name, birth_date, email, password, profile_img) FROM stdin;
\.


--
-- TOC entry 2465 (class 0 OID 0)
-- Dependencies: 193
-- Name: users_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_seq', 1, false);


--
-- TOC entry 2316 (class 2606 OID 16593)
-- Name: project_details project_details_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY project_details
    ADD CONSTRAINT project_details_pkey PRIMARY KEY (id);


--
-- TOC entry 2318 (class 2606 OID 16595)
-- Name: project_status project_status_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY project_status
    ADD CONSTRAINT project_status_pkey PRIMARY KEY (id);


--
-- TOC entry 2313 (class 2606 OID 16487)
-- Name: project_task_details project_task_details_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY project_task_details
    ADD CONSTRAINT project_task_details_pkey PRIMARY KEY (id);


--
-- TOC entry 2320 (class 2606 OID 16597)
-- Name: project_time project_time_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY project_time
    ADD CONSTRAINT project_time_pkey PRIMARY KEY (id);


--
-- TOC entry 2310 (class 2606 OID 16466)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 2311 (class 1259 OID 16488)
-- Name: parent_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX parent_id ON project_task_details USING btree (parent_id);


--
-- TOC entry 2314 (class 1259 OID 16489)
-- Name: status_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX status_id ON project_task_details USING btree (status_id);


-- Completed on 2016-11-28 03:33:26 CET

--
-- PostgreSQL database dump complete
--

