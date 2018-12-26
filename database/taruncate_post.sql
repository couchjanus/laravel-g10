truncate table posts restart identity;


truncate table tags restart identity;

-- Table: public.tags

-- DROP TABLE public.tags;

CREATE TABLE public.tags
(
  id integer NOT NULL DEFAULT nextval('tags_id_seq'::regclass),
  name character varying(191) NOT NULL,
  description character varying(191),
  created_at timestamp(0) without time zone,
  updated_at timestamp(0) without time zone,
  slug character varying(191) NOT NULL,
  CONSTRAINT tags_pkey PRIMARY KEY (id),
  CONSTRAINT tags_name_unique UNIQUE (name),
  CONSTRAINT tags_slug_unique UNIQUE (slug)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tags
  OWNER TO dev;
