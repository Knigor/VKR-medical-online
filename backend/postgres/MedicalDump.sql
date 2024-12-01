--
-- PostgreSQL database dump
--

-- Dumped from database version 15.3
-- Dumped by pg_dump version 15.3

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
-- Name: chats; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.chats (
    chats_id integer NOT NULL,
    user_id integer,
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    status_chats boolean
);


ALTER TABLE public.chats OWNER TO "user";

--
-- Name: chats_chats_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.chats_chats_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.chats_chats_id_seq OWNER TO "user";

--
-- Name: chats_chats_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.chats_chats_id_seq OWNED BY public.chats.chats_id;


--
-- Name: diseases; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.diseases (
    diseases_id integer NOT NULL,
    doctor_id integer,
    type_diseases character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public.diseases OWNER TO "user";

--
-- Name: diseases_diseases_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.diseases_diseases_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.diseases_diseases_id_seq OWNER TO "user";

--
-- Name: diseases_diseases_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.diseases_diseases_id_seq OWNED BY public.diseases.diseases_id;


--
-- Name: doctors; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.doctors (
    doctor_id integer NOT NULL,
    user_id integer,
    bio character varying(255) DEFAULT NULL::character varying NOT NULL,
    education character varying(200) DEFAULT NULL::character varying NOT NULL,
    complete_consultation integer DEFAULT 0 NOT NULL,
    qualification character varying(200) DEFAULT NULL::character varying NOT NULL
);


ALTER TABLE public.doctors OWNER TO "user";

--
-- Name: doctors_doctor_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.doctors_doctor_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.doctors_doctor_id_seq OWNER TO "user";

--
-- Name: doctors_doctor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.doctors_doctor_id_seq OWNED BY public.doctors.doctor_id;


--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO "user";

--
-- Name: messages; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.messages (
    messages_id integer NOT NULL,
    chats_id integer,
    user_id integer,
    message character varying(255) DEFAULT NULL::character varying,
    "timestamp" timestamp(0) without time zone NOT NULL,
    messages_image character varying(200) DEFAULT NULL::character varying
);


ALTER TABLE public.messages OWNER TO "user";

--
-- Name: messages_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.messages_messages_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.messages_messages_id_seq OWNER TO "user";

--
-- Name: messages_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.messages_messages_id_seq OWNED BY public.messages.messages_id;


--
-- Name: pacient; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.pacient (
    patient_id integer NOT NULL,
    user_id integer,
    policy_number character varying(200) DEFAULT NULL::character varying NOT NULL,
    blood_type character varying(200) DEFAULT NULL::character varying NOT NULL,
    allergies character varying(200) DEFAULT NULL::character varying NOT NULL,
    chronic_conditions character varying(200) DEFAULT NULL::character varying NOT NULL
);


ALTER TABLE public.pacient OWNER TO "user";

--
-- Name: pacient_patient_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.pacient_patient_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pacient_patient_id_seq OWNER TO "user";

--
-- Name: pacient_patient_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.pacient_patient_id_seq OWNED BY public.pacient.patient_id;


--
-- Name: reviews; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.reviews (
    reviews_id integer NOT NULL,
    doctor_id integer,
    patient_id integer,
    rating integer NOT NULL
);


ALTER TABLE public.reviews OWNER TO "user";

--
-- Name: reviews_reviews_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.reviews_reviews_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reviews_reviews_id_seq OWNER TO "user";

--
-- Name: reviews_reviews_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.reviews_reviews_id_seq OWNED BY public.reviews.reviews_id;


--
-- Name: scheduledoctors; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.scheduledoctors (
    schedule_doctors_id integer NOT NULL,
    doctor_id integer,
    time_schedule timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.scheduledoctors OWNER TO "user";

--
-- Name: scheduledoctors_schedule_doctors_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.scheduledoctors_schedule_doctors_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scheduledoctors_schedule_doctors_id_seq OWNER TO "user";

--
-- Name: scheduledoctors_schedule_doctors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.scheduledoctors_schedule_doctors_id_seq OWNED BY public.scheduledoctors.schedule_doctors_id;


--
-- Name: specializations; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.specializations (
    specialization_id integer NOT NULL,
    name_specialization character varying(255) NOT NULL,
    experience integer NOT NULL,
    doctor_id integer
);


ALTER TABLE public.specializations OWNER TO "user";

--
-- Name: specializations_specialization_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.specializations_specialization_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.specializations_specialization_id_seq OWNER TO "user";

--
-- Name: specializations_specialization_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.specializations_specialization_id_seq OWNED BY public.specializations.specialization_id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.users (
    user_id integer NOT NULL,
    fio character varying(200) NOT NULL,
    username character varying(200) NOT NULL,
    email character varying(200) NOT NULL,
    password character varying(255) NOT NULL,
    role json,
    gender character varying(200) NOT NULL
);


ALTER TABLE public.users OWNER TO "user";

--
-- Name: users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_user_id_seq OWNER TO "user";

--
-- Name: users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;


--
-- Name: chats chats_id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.chats ALTER COLUMN chats_id SET DEFAULT nextval('public.chats_chats_id_seq'::regclass);


--
-- Name: diseases diseases_id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.diseases ALTER COLUMN diseases_id SET DEFAULT nextval('public.diseases_diseases_id_seq'::regclass);


--
-- Name: doctors doctor_id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.doctors ALTER COLUMN doctor_id SET DEFAULT nextval('public.doctors_doctor_id_seq'::regclass);


--
-- Name: messages messages_id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.messages ALTER COLUMN messages_id SET DEFAULT nextval('public.messages_messages_id_seq'::regclass);


--
-- Name: pacient patient_id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.pacient ALTER COLUMN patient_id SET DEFAULT nextval('public.pacient_patient_id_seq'::regclass);


--
-- Name: reviews reviews_id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.reviews ALTER COLUMN reviews_id SET DEFAULT nextval('public.reviews_reviews_id_seq'::regclass);


--
-- Name: scheduledoctors schedule_doctors_id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.scheduledoctors ALTER COLUMN schedule_doctors_id SET DEFAULT nextval('public.scheduledoctors_schedule_doctors_id_seq'::regclass);


--
-- Name: specializations specialization_id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.specializations ALTER COLUMN specialization_id SET DEFAULT nextval('public.specializations_specialization_id_seq'::regclass);


--
-- Name: users user_id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);


--
-- Data for Name: chats; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.chats (chats_id, user_id, created_at, updated_at, status_chats) FROM stdin;
\.


--
-- Data for Name: diseases; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.diseases (diseases_id, doctor_id, type_diseases) FROM stdin;
\.


--
-- Data for Name: doctors; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.doctors (doctor_id, user_id, bio, education, complete_consultation, qualification) FROM stdin;
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20241126070503	2024-11-26 07:14:58	305
DoctrineMigrations\\Version20241126073109	2024-11-26 07:31:57	143
DoctrineMigrations\\Version20241129112104	2024-11-29 11:21:52	46
DoctrineMigrations\\Version20241129114328	2024-11-29 11:43:44	53
DoctrineMigrations\\Version20241129121404	2024-11-29 12:14:19	80
DoctrineMigrations\\Version20241129122629	2024-11-29 12:26:39	56
DoctrineMigrations\\Version20241129124207	2024-11-29 12:42:35	35
DoctrineMigrations\\Version20241201102825	2024-12-01 10:30:46	44
DoctrineMigrations\\Version20241201104503	2024-12-01 10:46:38	23
DoctrineMigrations\\Version20241201105249	2024-12-01 10:53:24	42
\.


--
-- Data for Name: messages; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.messages (messages_id, chats_id, user_id, message, "timestamp", messages_image) FROM stdin;
\.


--
-- Data for Name: pacient; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.pacient (patient_id, user_id, policy_number, blood_type, allergies, chronic_conditions) FROM stdin;
1	11	1111155	111	1111	1111
\.


--
-- Data for Name: reviews; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.reviews (reviews_id, doctor_id, patient_id, rating) FROM stdin;
\.


--
-- Data for Name: scheduledoctors; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.scheduledoctors (schedule_doctors_id, doctor_id, time_schedule) FROM stdin;
1	\N	2024-11-29 12:45:30
\.


--
-- Data for Name: specializations; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.specializations (specialization_id, name_specialization, experience, doctor_id) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.users (user_id, fio, username, email, password, role, gender) FROM stdin;
11	Igor Kretov	test	test@mail.ru	$2y$13$suPIXEzuHSPWRT.u2.YBdeebjDVP9zc.xQwqKnDIbiWcei74LlXD2	["ROLE_USER"]	male
\.


--
-- Name: chats_chats_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.chats_chats_id_seq', 1, false);


--
-- Name: diseases_diseases_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.diseases_diseases_id_seq', 1, false);


--
-- Name: doctors_doctor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.doctors_doctor_id_seq', 3, true);


--
-- Name: messages_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.messages_messages_id_seq', 1, false);


--
-- Name: pacient_patient_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.pacient_patient_id_seq', 1, true);


--
-- Name: reviews_reviews_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.reviews_reviews_id_seq', 1, false);


--
-- Name: scheduledoctors_schedule_doctors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.scheduledoctors_schedule_doctors_id_seq', 1, true);


--
-- Name: specializations_specialization_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.specializations_specialization_id_seq', 1, false);


--
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.users_user_id_seq', 11, true);


--
-- Name: chats chats_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.chats
    ADD CONSTRAINT chats_pkey PRIMARY KEY (chats_id);


--
-- Name: diseases diseases_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.diseases
    ADD CONSTRAINT diseases_pkey PRIMARY KEY (diseases_id);


--
-- Name: doctors doctors_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.doctors
    ADD CONSTRAINT doctors_pkey PRIMARY KEY (doctor_id);


--
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- Name: messages messages_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.messages
    ADD CONSTRAINT messages_pkey PRIMARY KEY (messages_id);


--
-- Name: pacient pacient_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.pacient
    ADD CONSTRAINT pacient_pkey PRIMARY KEY (patient_id);


--
-- Name: reviews reviews_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT reviews_pkey PRIMARY KEY (reviews_id);


--
-- Name: scheduledoctors scheduledoctors_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.scheduledoctors
    ADD CONSTRAINT scheduledoctors_pkey PRIMARY KEY (schedule_doctors_id);


--
-- Name: specializations specializations_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.specializations
    ADD CONSTRAINT specializations_pkey PRIMARY KEY (specialization_id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);


--
-- Name: idx_2d68180fa76ed395; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX idx_2d68180fa76ed395 ON public.chats USING btree (user_id);


--
-- Name: idx_6970eb0f6b899279; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX idx_6970eb0f6b899279 ON public.reviews USING btree (patient_id);


--
-- Name: idx_6970eb0f87f4fb17; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX idx_6970eb0f87f4fb17 ON public.reviews USING btree (doctor_id);


--
-- Name: idx_6a1c232087f4fb17; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX idx_6a1c232087f4fb17 ON public.scheduledoctors USING btree (doctor_id);


--
-- Name: idx_b67687bea76ed395; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX idx_b67687bea76ed395 ON public.doctors USING btree (user_id);


--
-- Name: idx_b6f79ebf87f4fb17; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX idx_b6f79ebf87f4fb17 ON public.specializations USING btree (doctor_id);


--
-- Name: idx_c81a9c79a76ed395; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX idx_c81a9c79a76ed395 ON public.pacient USING btree (user_id);


--
-- Name: idx_db021e96a76ed395; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX idx_db021e96a76ed395 ON public.messages USING btree (user_id);


--
-- Name: idx_db021e96ac6ff313; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX idx_db021e96ac6ff313 ON public.messages USING btree (chats_id);


--
-- Name: idx_f762064787f4fb17; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX idx_f762064787f4fb17 ON public.diseases USING btree (doctor_id);


--
-- Name: uniq_1483a5e9f85e0677; Type: INDEX; Schema: public; Owner: user
--

CREATE UNIQUE INDEX uniq_1483a5e9f85e0677 ON public.users USING btree (username);


--
-- Name: chats fk_2d68180fa76ed395; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.chats
    ADD CONSTRAINT fk_2d68180fa76ed395 FOREIGN KEY (user_id) REFERENCES public.users(user_id);


--
-- Name: reviews fk_6970eb0f6b899279; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT fk_6970eb0f6b899279 FOREIGN KEY (patient_id) REFERENCES public.pacient(patient_id) ON DELETE SET NULL;


--
-- Name: reviews fk_6970eb0f87f4fb17; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT fk_6970eb0f87f4fb17 FOREIGN KEY (doctor_id) REFERENCES public.doctors(doctor_id) ON DELETE SET NULL;


--
-- Name: scheduledoctors fk_6a1c232087f4fb17; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.scheduledoctors
    ADD CONSTRAINT fk_6a1c232087f4fb17 FOREIGN KEY (doctor_id) REFERENCES public.doctors(doctor_id) ON DELETE SET NULL;


--
-- Name: doctors fk_b67687bea76ed395; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.doctors
    ADD CONSTRAINT fk_b67687bea76ed395 FOREIGN KEY (user_id) REFERENCES public.users(user_id);


--
-- Name: specializations fk_b6f79ebf87f4fb17; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.specializations
    ADD CONSTRAINT fk_b6f79ebf87f4fb17 FOREIGN KEY (doctor_id) REFERENCES public.doctors(doctor_id) ON DELETE SET NULL;


--
-- Name: pacient fk_c81a9c79a76ed395; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.pacient
    ADD CONSTRAINT fk_c81a9c79a76ed395 FOREIGN KEY (user_id) REFERENCES public.users(user_id);


--
-- Name: messages fk_db021e96a76ed395; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.messages
    ADD CONSTRAINT fk_db021e96a76ed395 FOREIGN KEY (user_id) REFERENCES public.users(user_id);


--
-- Name: messages fk_db021e96ac6ff313; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.messages
    ADD CONSTRAINT fk_db021e96ac6ff313 FOREIGN KEY (chats_id) REFERENCES public.chats(chats_id);


--
-- Name: diseases fk_f762064787f4fb17; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.diseases
    ADD CONSTRAINT fk_f762064787f4fb17 FOREIGN KEY (doctor_id) REFERENCES public.doctors(doctor_id) ON DELETE SET NULL;


--
-- PostgreSQL database dump complete
--

