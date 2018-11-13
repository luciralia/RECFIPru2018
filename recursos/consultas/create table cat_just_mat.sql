--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: cat_just_mat; Type: TABLE; Schema: public; Owner: sieldi_user; Tablespace: 
--

CREATE TABLE cat_just_mat (
    id integer NOT NULL,
    descripcion character varying(300)
);


ALTER TABLE public.cat_just_mat OWNER TO sieldi_user;

--
-- Name: cat_just_mat_id_seq; Type: SEQUENCE; Schema: public; Owner: sieldi_user
--

CREATE SEQUENCE cat_just_mat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.cat_just_mat_id_seq OWNER TO sieldi_user;

--
-- Name: cat_just_mat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sieldi_user
--

ALTER SEQUENCE cat_just_mat_id_seq OWNED BY cat_just_mat.id;


--
-- Name: cat_just_mat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sieldi_user
--

SELECT pg_catalog.setval('cat_just_mat_id_seq', 7, true);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: sieldi_user
--

ALTER TABLE cat_just_mat ALTER COLUMN id SET DEFAULT nextval('cat_just_mat_id_seq'::regclass);


--
-- Data for Name: cat_just_mat; Type: TABLE DATA; Schema: public; Owner: sieldi_user
--

INSERT INTO cat_just_mat VALUES (4, 'Necesidades de equipo por insuficiencia');
INSERT INTO cat_just_mat VALUES (6, 'Actualización de equipo');
INSERT INTO cat_just_mat VALUES (7, 'Otro');
INSERT INTO cat_just_mat VALUES (5, 'Sustitución de equipo que se encuentra en mantenimiento');
INSERT INTO cat_just_mat VALUES (1, 'Cambio de equipo porque el actual pone en riesgo a los usuarios');
INSERT INTO cat_just_mat VALUES (2, 'A falta de este no se puede realizar una práctica');
INSERT INTO cat_just_mat VALUES (3, 'Atender las recomendaciones para la acreditación de la carrera');


--
-- Name: cat_just_mat_pkey; Type: CONSTRAINT; Schema: public; Owner: sieldi_user; Tablespace: 
--

ALTER TABLE ONLY cat_just_mat
    ADD CONSTRAINT cat_just_mat_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--
