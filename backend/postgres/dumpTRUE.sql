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
    created_at timestamp(0) without time zone NOT NULL,
    updated_at timestamp(0) without time zone NOT NULL,
    status_chats boolean,
    patient_id integer NOT NULL,
    doctor_id integer NOT NULL
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
    bio text DEFAULT NULL::character varying,
    education text DEFAULT NULL::character varying,
    complete_consultation integer DEFAULT 0 NOT NULL,
    qualification text DEFAULT NULL::character varying,
    experience integer DEFAULT 0 NOT NULL
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
-- Name: messageschat; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.messageschat (
    id integer NOT NULL,
    chat_id integer NOT NULL,
    sender_username character varying(255) NOT NULL,
    message text,
    image text,
    "timestamp" timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    receiver_username character varying(255)
);


ALTER TABLE public.messageschat OWNER TO "user";

--
-- Name: messageschat_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.messageschat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.messageschat_id_seq OWNER TO "user";

--
-- Name: messageschat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.messageschat_id_seq OWNED BY public.messageschat.id;


--
-- Name: pacient; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.pacient (
    patient_id integer NOT NULL,
    user_id integer,
    policy_number character varying(200) DEFAULT NULL::character varying,
    blood_type character varying(200) DEFAULT NULL::character varying,
    allergies character varying(200) DEFAULT NULL::character varying,
    chronic_conditions character varying(200) DEFAULT NULL::character varying
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
    gender character varying(200) NOT NULL,
    photo_user character varying(200),
    birthdate timestamp(0) without time zone
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
-- Name: messageschat id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.messageschat ALTER COLUMN id SET DEFAULT nextval('public.messageschat_id_seq'::regclass);


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

COPY public.chats (chats_id, created_at, updated_at, status_chats, patient_id, doctor_id) FROM stdin;
17	2025-03-17 11:31:43	2025-03-17 11:31:43	t	6	43
20	2025-03-17 13:30:16	2025-03-17 13:30:16	t	6	45
18	2025-03-17 12:04:15	2025-03-17 12:04:15	t	6	44
21	2025-03-23 10:13:52	2025-03-23 10:13:52	t	6	6
23	2025-03-23 11:11:12	2025-03-23 11:11:12	t	10	6
24	2025-03-23 11:15:18	2025-03-23 11:15:18	f	10	46
\.


--
-- Data for Name: diseases; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.diseases (diseases_id, doctor_id, type_diseases) FROM stdin;
1	6	Тяжесть в животе
2	6	Больной живот
3	6	Боль в животе
\.


--
-- Data for Name: doctors; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.doctors (doctor_id, user_id, bio, education, complete_consultation, qualification, experience) FROM stdin;
6	12	Абоба	ес	1	123	5
10	26	\N	\N	0	\N	0
44	60	2022 г. - АНО ДПО "Национальный исследовательский институт дополнительного образования и профессионального обучения" г. Москва, повышение квалификации по программе: "Психологическое консультирование и психодиагностика",\r\n2022 г. - АНО ДПО "Национальный исследовательский институт дополнительного образования и профессионального обучения" г. Москва, повышение квалификации по программе: "Детская психология. Практическая психологическая помощь детям и подросткам",\r\n2022 г. - АНО ДПО "Национальный исследовательский институт дополнительного образования и профессионального обучения" г. Москва, повышение квалификации по программе: "Методы психокоррекционной работы с паническими атаками",\r\n2022 г. - АНО ДПО "Национальный исследовательский институт дополнительного образования и профессионального обучения" г. Москва, повышение квалификации по программе: "Сексология и психологическое консультирование",\r\n2024 г. - АНО ДПО "Национальный исследовательский институт дополнительного образования и профессионального обучения" г. Москва, повышение квалификации по программе: "Перинатальный психолог. Социально-психологическое сопровождение беременности, родов и послеродового периода, женщин со сложностями в репродуктивной сфере".	2016 г. - ФГАОУ ВО "Национальный исследовательский ядерный университет "МИФИ"" г. Москва, высшее образование по специальности "Лечебное дело".	0	Консультирую клиентов с первых минут жизни. Беременных женщин и супружеские пары в процессе подготовки к родительству.\r\n\r\nМогу помочь Вам в решении вопросов, касающихся:\r\n- личностного роста,\r\n- неуверенности в себе,\r\n- трудностях на работе,\r\n- проблемах профессионального выгорания,\r\n- проблем выбора,\r\n- депрессии и стресса, повышенном уровне тревоги,\r\n- страхов,\r\n- панических атак,\r\n- травм и потерь,\r\n- супружеских или семейных проблем,\r\n- детско-родительских конфликтов.\r\n\r\nДля Вас и Вашего ребенка я могу быть полезной в качестве детского психолога:\r\n- нарушения развития речи (ЗПРР),\r\n- синдроме дефицита внимания и гиперактивностью (СДВГ),\r\n- логоневрозе, тиках,\r\n- проблемах саморегуляции,\r\n- буллинга в коллективе,\r\n- нарушениях в коммуникации среди сверстников.\r\n\r\nДля детей раннего возраста владею такими методиками, как: сказкотерапия, арт-терапия, работа с МА картами.\r\n\r\nПсихолог сопровождающий семью в процессе подготовки к зачатию, беременности, в работе с травмой потери:\r\n- организация социально-психологическое сопровождения гестационного и послеродового периода,\r\n- методы работы с тревожными и фобическими состояниями у беременных,\r\n- психосоматика в вопросах зачатия и деторождения,\r\n- методы оказания психологической помощи женщинам с бесплодием.	4
45	61	\N	\N	0	\N	0
43	59	2016 г. - Санкт-Петербурский ГБУ "Городской центр социальных программ и профилактики асоциальных явлений среди молодежи "КОНТАКТ"", повышение квалификации по программе "Профессиональная ориентация подростков и молодежи",\r\n2021 г. - ООО "Институт психотерапии и медицинской психологии РПА им. Б.Д. Карвасарского", профессиональная переподготовка по программе "Логопедия. Диагностика и коррекция речевой патологии",\r\n2022 г. - ООО "Институт психотерапии и медицинской психологии РПА им. Б.Д. Карвасарского", повышение квалификации "Логопед" по программе "Логопедия. Диагностика и коррекция речевой патологии".	2013 г. - ГБОУ ВПО "Санкт-Петербургский государственный педиатрический медицинский университет" Министерства здравоохранения Российской Федерации г. Санкт-Петербург, высшее образование по специальности "Психолог. Клинический психолог. Преподаватель психологии",\r\n2020 г. - ФГБО УВО «Российский государственный педагогический университет им. А. И. Герцена», магистратура по специальности "Педагогическое образование".	0	Консультирую клиентов с первых минут жизни. Беременных женщин и супружеские пары в процессе подготовки к родительству.\r\n\r\nМогу помочь Вам в решении вопросов, касающихся:\r\n- личностного роста,\r\n- неуверенности в себе,\r\n- трудностях на работе,\r\n- проблемах профессионального выгорания,\r\n- проблем выбора,\r\n- депрессии и стресса, повышенном уровне тревоги,\r\n- страхов,\r\n- панических атак,\r\n- травм и потерь,\r\n- супружеских или семейных проблем,\r\n- детско-родительских конфликтов.\r\n\r\nДля Вас и Вашего ребенка я могу быть полезной в качестве детского психолога:\r\n- нарушения развития речи (ЗПРР),\r\n- синдроме дефицита внимания и гиперактивностью (СДВГ),\r\n- логоневрозе, тиках,\r\n- проблемах саморегуляции,\r\n- буллинга в коллективе,\r\n- нарушениях в коммуникации среди сверстников.\r\n\r\nДля детей раннего возраста владею такими методиками, как: сказкотерапия, арт-терапия, работа с МА картами.\r\n\r\nПсихолог сопровождающий семью в процессе подготовки к зачатию, беременности, в работе с травмой потери:\r\n- организация социально-психологическое сопровождения гестационного и послеродового периода,\r\n- методы работы с тревожными и фобическими состояниями у беременных,\r\n- психосоматика в вопросах зачатия и деторождения,\r\n- методы оказания психологической помощи женщинам с бесплодием.	12
46	63	123	dsadas	0	asda	4
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20241203063944	2024-12-03 06:58:03	142
DoctrineMigrations\\Version20250311093123	2025-03-11 09:31:57	131
DoctrineMigrations\\Version20250313121932	2025-03-13 12:20:51	73
DoctrineMigrations\\Version20250313145530	2025-03-13 14:56:07	56
DoctrineMigrations\\Version20250317084648	2025-03-17 08:47:13	79
\.


--
-- Data for Name: messages; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.messages (messages_id, chats_id, user_id, message, "timestamp", messages_image) FROM stdin;
\.


--
-- Data for Name: messageschat; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.messageschat (id, chat_id, sender_username, message, image, "timestamp", receiver_username) FROM stdin;
\.


--
-- Data for Name: pacient; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.pacient (patient_id, user_id, policy_number, blood_type, allergies, chronic_conditions) FROM stdin;
4	16	\N	\N	\N	\N
5	17	\N	\N	\N	\N
7	19	\N	\N	\N	\N
2	11	228	AB-	абоба	123
8	20	228 1337 6666	AB+	болит живот	не могу дышать
9	22	\N	\N	\N	\N
6	18	1337	A+	нету	нету
10	62	123	O+	нет	нет
\.


--
-- Data for Name: reviews; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.reviews (reviews_id, doctor_id, patient_id, rating) FROM stdin;
1	6	2	5
2	6	2	5
\.


--
-- Data for Name: scheduledoctors; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.scheduledoctors (schedule_doctors_id, doctor_id, time_schedule) FROM stdin;
24	6	2025-03-11 10:00:00
25	6	2025-03-11 13:00:00
26	6	2025-03-11 20:00:00
30	43	2025-03-13 17:00:00
31	43	2025-03-13 18:00:00
32	43	2025-03-14 17:00:00
33	43	2025-03-14 18:00:00
34	43	2025-03-14 20:00:00
35	44	2025-03-12 20:00:00
36	44	2025-03-12 13:00:00
37	44	2025-03-12 10:00:00
38	45	2025-03-19 10:00:00
39	45	2025-03-19 13:00:00
40	45	2025-03-19 20:00:00
41	46	2025-03-24 10:00:00
42	46	2025-03-24 13:00:00
43	46	2025-03-24 20:00:00
\.


--
-- Data for Name: specializations; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.specializations (specialization_id, name_specialization, doctor_id) FROM stdin;
7	Педиатор	6
8	Дерматолог	6
9	Психолог	\N
10	Гинеколог	\N
11	Кардиолог	\N
12	Психолог	\N
15	Терапевт	10
1	Кардиолог	6
16	Психолог	43
17	Психолог	44
18	Гинеколог	45
19	Кардиолог	46
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.users (user_id, fio, username, email, password, role, gender, photo_user, birthdate) FROM stdin;
11	Кретов Игорь	test	test@mail.ru	$2y$13$suPIXEzuHSPWRT.u2.YBdeebjDVP9zc.xQwqKnDIbiWcei74LlXD2	["ROLE_USER"]	male	/uploads/photos/lain-67c55477f0a3e.png	2001-11-25 07:04:23
12	Inna Petrova	doctor	doctor@mail.ru	$2y$13$VCag3DLtoTK1m/Z/Bsb5cOwM7Ys.y0BrK9RpZUZWP1yaH4xZm3/f2	["ROLE_DOCTOR"]	female	default_photo.jpg	2024-12-01 14:10:45
60	Михайлова Юлия Владимировна	doctor2	doctor2@mail.ru	$2y$13$/SyF2TrmJV6VRqi4fdtw5OheSPVqIkwfv20hfptecP6QPnSmc0Vnm	["ROLE_DOCTOR"]	female	/uploads/photos/avatar-doctor2-67d0080dda567.jpg	2001-11-26 13:19:06
62	Борис Кислый Борисович	patient	patient@mail.ru	$2y$13$YFtPcI3wjMOa49Vuzx56QO3G2An.Wtc2t95cN/OAxB60fl8pjrt7e	["ROLE_USER"]	male	/uploads/photos/logo-hse-67dfec3899e1d.png	2001-11-26 11:10:48
20	Владимир Ефремов	vovan	test1@mail.ru	$2y$13$gJS7M1JxrbEIZ/kAMKIN6O3raUUiNPrjIITPFp9Q3KZQof0EXsoRa	["ROLE_USER"]	male	/uploads/photos/lain-67c5a3cd73a80.png	2001-11-26 12:42:53
22	Кретов Игорь	test12	abobus@mail.ru	$2y$13$vqblM5FhIQooBhI6uXWLWuwd.oAKKFl30WO/jXXGEm1onQdk7gxtK	["ROLE_USER"]	male	\N	\N
16	John Doe	john_doe	john@example.com	$2y$13$JC1wC1ydjrUDBwL7AIuC0O0NQdUDH7k.lMNDaP7sAhUN8Hthg9JLK	["ROLE_USER"]	male	\N	\N
17	Владимир Ефремов	vladimir	vovan_v_tanke@mail.ru	$2y$13$PgFmo977rA0dJLh2cYMz..GaJSXAPt/aiIims.1Qxk5AC4knixauq	["ROLE_USER"]	male	\N	\N
26	Игорь Вихорьков	igor	igor@mail.ru	$2y$13$fmdSEWCiAWn4UkkhIN28ueDlsthzArPbkq/csEYXDb6hUL3rcH6Ie	["ROLE_DOCTOR"]	male	\N	\N
63	Михайлова София Яновна	doctorTest	doctorTest@mail.ru	$2y$13$YCPNmfvOIcpJCYpo.iRG3ejdSztyY.1wgw2LEfBtN25wnvP0EepLu	["ROLE_DOCTOR"]	male	/uploads/photos/text-1-67dfed28236cc.jpg	\N
19	Игорь Кретов	rodion	test12@mail.ru	$2y$13$oPpo2X45yv2vMv1w3QRTwulYg9RTzUSVU4UkdcrHMuNXCLWVYI0qa	["ROLE_USER"]	male	/uploads/photos/lain-67c447125d92c.png	2001-11-26 11:53:40
59	Анисия Жанна Петровна	aboba10	new@mail.ru	$2y$13$RIu.roGP9g0YFcXBTSvVy.dXjhj0hnp1VzjisYGr46.LtGLPrqmu6	["ROLE_DOCTOR"]	female	/uploads/photos/avatar-doctor1-67d0045a8d2ec.jpg	2001-11-26 09:37:30
14	Inna Petrova	doctor1	doctor1@mail.ru	$2y$13$zJmZTkZg6UqQ9F/GGimKR.RQRr5P3/SIdyYlFI5mbL6jpkB4t5vIW	["ROLE_USER"]	male	\N	\N
61	Вихорьков Игорь Данилович	doctor10	doctor10@mail.ru	$2y$13$iY4a/mZcXa9Yr5UDfmBEreR2HVnQnX2h.TDNA4/UrVuuLtiFh9aDm	["ROLE_DOCTOR"]	male	\N	\N
18	Кретов Игорь	knigor1	aboba@mail.ru	$2y$13$hfqIlxSZ2huPX8ZU1t8fZeC78Vs1OoBFrTnhMdrK0v7npTEZQXqTW	["ROLE_USER"]	male	/uploads/photos/lain-67c96a3538411.png	2001-11-26 13:07:03
\.


--
-- Name: chats_chats_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.chats_chats_id_seq', 24, true);


--
-- Name: diseases_diseases_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.diseases_diseases_id_seq', 3, true);


--
-- Name: doctors_doctor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.doctors_doctor_id_seq', 46, true);


--
-- Name: messages_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.messages_messages_id_seq', 13, true);


--
-- Name: messageschat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.messageschat_id_seq', 1, false);


--
-- Name: pacient_patient_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.pacient_patient_id_seq', 10, true);


--
-- Name: reviews_reviews_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.reviews_reviews_id_seq', 2, true);


--
-- Name: scheduledoctors_schedule_doctors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.scheduledoctors_schedule_doctors_id_seq', 43, true);


--
-- Name: specializations_specialization_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.specializations_specialization_id_seq', 19, true);


--
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.users_user_id_seq', 63, true);


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
-- Name: messageschat messageschat_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.messageschat
    ADD CONSTRAINT messageschat_pkey PRIMARY KEY (id);


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
-- Name: idx_2d68180f6b899279; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX idx_2d68180f6b899279 ON public.chats USING btree (patient_id);


--
-- Name: idx_2d68180f87f4fb17; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX idx_2d68180f87f4fb17 ON public.chats USING btree (doctor_id);


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
-- Name: chats fk_2d68180f6b899279; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.chats
    ADD CONSTRAINT fk_2d68180f6b899279 FOREIGN KEY (patient_id) REFERENCES public.pacient(patient_id);


--
-- Name: chats fk_2d68180f87f4fb17; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.chats
    ADD CONSTRAINT fk_2d68180f87f4fb17 FOREIGN KEY (doctor_id) REFERENCES public.doctors(doctor_id);


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

