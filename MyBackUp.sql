PGDMP                      }            events_manager    17.5 (Debian 17.5-1.pgdg120+1)    17.4 #    k           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                           false            l           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                           false            m           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                           false            n           1262    16384    events_manager    DATABASE     y   CREATE DATABASE events_manager WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.utf8';
    DROP DATABASE events_manager;
                     events    false                        3079    16432    pgcrypto 	   EXTENSION     <   CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;
    DROP EXTENSION pgcrypto;
                        false            o           0    0    EXTENSION pgcrypto    COMMENT     <   COMMENT ON EXTENSION pgcrypto IS 'cryptographic functions';
                             false    2            �            1259    16399    events    TABLE     �  CREATE TABLE public.events (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    description_short text NOT NULL,
    description_long text NOT NULL,
    event_date timestamp without time zone NOT NULL,
    location character varying(255) NOT NULL,
    available_seats integer NOT NULL,
    image_url character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT events_available_seats_check CHECK ((available_seats >= 0))
);
    DROP TABLE public.events;
       public         heap r       events    false            �            1259    16398    events_id_seq    SEQUENCE     �   CREATE SEQUENCE public.events_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.events_id_seq;
       public               events    false    221            p           0    0    events_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.events_id_seq OWNED BY public.events.id;
          public               events    false    220            �            1259    16410    registrations    TABLE     �   CREATE TABLE public.registrations (
    id integer NOT NULL,
    user_id integer NOT NULL,
    event_id integer NOT NULL,
    registered_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
 !   DROP TABLE public.registrations;
       public         heap r       events    false            �            1259    16409    registrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.registrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.registrations_id_seq;
       public               events    false    223            q           0    0    registrations_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.registrations_id_seq OWNED BY public.registrations.id;
          public               events    false    222            �            1259    16386    users    TABLE     ,  CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    email character varying(100) NOT NULL,
    password_hash character varying(255) NOT NULL,
    is_admin boolean DEFAULT false,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.users;
       public         heap r       events    false            �            1259    16385    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public               events    false    219            r           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public               events    false    218            �           2604    16402 	   events id    DEFAULT     f   ALTER TABLE ONLY public.events ALTER COLUMN id SET DEFAULT nextval('public.events_id_seq'::regclass);
 8   ALTER TABLE public.events ALTER COLUMN id DROP DEFAULT;
       public               events    false    220    221    221            �           2604    16413    registrations id    DEFAULT     t   ALTER TABLE ONLY public.registrations ALTER COLUMN id SET DEFAULT nextval('public.registrations_id_seq'::regclass);
 ?   ALTER TABLE public.registrations ALTER COLUMN id DROP DEFAULT;
       public               events    false    223    222    223            �           2604    16389    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public               events    false    218    219    219            f          0    16399    events 
   TABLE DATA           �   COPY public.events (id, title, description_short, description_long, event_date, location, available_seats, image_url, created_at) FROM stdin;
    public               events    false    221   �(       h          0    16410    registrations 
   TABLE DATA           M   COPY public.registrations (id, user_id, event_id, registered_at) FROM stdin;
    public               events    false    223   N1       d          0    16386    users 
   TABLE DATA           Y   COPY public.users (id, username, email, password_hash, is_admin, created_at) FROM stdin;
    public               events    false    219   ;2       s           0    0    events_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.events_id_seq', 16, true);
          public               events    false    220            t           0    0    registrations_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.registrations_id_seq', 53, true);
          public               events    false    222            u           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 9, true);
          public               events    false    218            �           2606    16408    events events_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.events
    ADD CONSTRAINT events_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.events DROP CONSTRAINT events_pkey;
       public                 events    false    221            �           2606    16416     registrations registrations_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.registrations
    ADD CONSTRAINT registrations_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.registrations DROP CONSTRAINT registrations_pkey;
       public                 events    false    223            �           2606    16418 0   registrations registrations_user_id_event_id_key 
   CONSTRAINT     x   ALTER TABLE ONLY public.registrations
    ADD CONSTRAINT registrations_user_id_event_id_key UNIQUE (user_id, event_id);
 Z   ALTER TABLE ONLY public.registrations DROP CONSTRAINT registrations_user_id_event_id_key;
       public                 events    false    223    223            �           2606    16397    users users_email_key 
   CONSTRAINT     Q   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);
 ?   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_key;
       public                 events    false    219            �           2606    16393    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public                 events    false    219            �           2606    16395    users users_username_key 
   CONSTRAINT     W   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_username_key;
       public                 events    false    219            �           1259    16431    idx_events_event_date    INDEX     N   CREATE INDEX idx_events_event_date ON public.events USING btree (event_date);
 )   DROP INDEX public.idx_events_event_date;
       public                 events    false    221            �           1259    16430    idx_registrations_event_id    INDEX     X   CREATE INDEX idx_registrations_event_id ON public.registrations USING btree (event_id);
 .   DROP INDEX public.idx_registrations_event_id;
       public                 events    false    223            �           1259    16429    idx_registrations_user_id    INDEX     V   CREATE INDEX idx_registrations_user_id ON public.registrations USING btree (user_id);
 -   DROP INDEX public.idx_registrations_user_id;
       public                 events    false    223            �           2606    16424 )   registrations registrations_event_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.registrations
    ADD CONSTRAINT registrations_event_id_fkey FOREIGN KEY (event_id) REFERENCES public.events(id) ON DELETE CASCADE;
 S   ALTER TABLE ONLY public.registrations DROP CONSTRAINT registrations_event_id_fkey;
       public               events    false    221    223    3272            �           2606    16419 (   registrations registrations_user_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.registrations
    ADD CONSTRAINT registrations_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;
 R   ALTER TABLE ONLY public.registrations DROP CONSTRAINT registrations_user_id_fkey;
       public               events    false    223    219    3268            f   �  x��W�n#�>����$���n�~o^�.2�=;Xo�0�nJ�"{�n���}��r[�a3�%�\r�"�$������`<�Z�b���)fy�
��J#*�{m>��\�WneU�'�D�{4�ǅ��v��ÓZ��Am�i�_>�����ʪE�{,]����7V^�
|{����(�����S#��=���@�Ƈ64�7��U苅4�R�$S�F�P:��=zeK<h~���k���[�.�QB5��q��S�U�1��NA'כ��O����Ăo�6rL�4]����Y:O�_򕒭U}��ݿe.^k�Ҟ��[�V�(� J2)f�`�J���𪭍�Ux5�N�j6YΦ�����5����nr�MEV̋�Fy^�^6L�1k�;���{�`Q1q��7�GA��V�S�'Bݗ���ZE g��Bq��c����V� ���V^m5}���r��vuR4O��AE+P�ڴt����@��YKy��7�#A-�'�U�F٠�����f�O�-7�4�kg��Mq+��?��پ����������D�@\�X���Ʀ��1�h���j���
 k)%��:��^�~��A����`Ik�����]-��LYz��Ъ����g�͚x�����ً����hTIu�����|���<�G�`4I��I/K�[iP�7��-�U��xJ�$�D��m�<� ��9Q{���֍#��iL�:��d��kWk�	�`+,��U�j���vRp����+��|�R���Z�����([��o?�!H;�tf)�F/��� �.(:�Fd��!\ʘh �� 8� �}����:濃2�����]y ��x�/5mT����w���Z�C��������l��qr�]�����{gZ�+J]m%�/�~�{���n�s4��ܼZ����3U��:�&UDڨ������fʱ����Z4������#jU6����Q$�	��j�{d���9��L?��A{��S6}.1��_�l����v��yK��tS����Fmj�f�Gd��A�t�Dbn�$㢥꾦�d+G�w>�{\u�4�<I�>-<S��F^Hp9`�!@�*��	�s��:]K����5�3 ]mQ�$����rY�l�-�P�n�9�&$-�x>���t��{�g���)�wn�%�k�6zq��m����83����1�I�_R��V#���׃y$9�g0�I
��14u�eX~�b��n�������?�h2�v��<����xvtAV�>yZ�_h�<P���:(
܆�C�~fx~V�#zO'��0�:�TnC�<*L��t���$j�����k��Ĺ�M_T�i��X��P/�3D��� -��xܛ%��J*q�E�h�8 g��vu7E�Aѧ�X(�RK���$�]�C�'�C�E�9n�PϏ,��g2�u%\���s��5:��)Ny�f/#ɣ���(NЏ�J�7��S鈲K�%naؠ��1����ǉ1�2��4ixq	LȽ_d��,��yQޅXΧ>�N�@L��"�R8|��g�J1%�d-�S�趛p��P��a�&��4ED���NM���Q:�T!ľ��c�	���/J�5�MO$�ʢ��QX�JN�G#�QJ�w��8@�k�9
��
P[���L���F��5�1��ݭw	md��Ь�a�ꋆȋɛ�:4�^<���qZAt
��2�b<R�}��J�X	q5Mze���5�4f�]K-�Љ��#�tR��!��:��_��4�'��i��q2@ߐ�2����p�˲�m��8���2\��q7���~�-�C��L��nwI�Up0�9L�t|j�VU'�����ϐ�k�W�p�B���?�`�q�罸�7��vD�Y�=F����L�Vk������Ҏ%�B�\�x����a�G�2�[7������Wm5���&�@��5���6�ڱR��HC�Άa$�_��O�~\�ߑ�W�*���"��F���KZ-�~ ��=�W��Ɏbs���'M#�y�I��d���ݷ�]<7��,s\aǽIru:��?4��l+h��0��S�,eI7/���O��� 9�������te�u���QQ���r4���@���?�v������j�Qj��������oy1y����b\�w���ϳ�`Z��ɬ��A���Q�s
      h   �   x�e��q� г�B�a�jI�u�[֙7�L�̇�����}��c��'�t�>�*W��5}�ȪD�R`[�O!��Fa��=y5��I"�"�)DFuX0X6B���!t2�#HA�K�-�'��f2qh~�|
�1ft� �%q[�C���%`���E�u��?H�z�����E}�P+�c�v�_�i4�c����;c���y�����C�-��nS\_      d   �  x�mӹ��0 ����I��.�����~Өa�ED�������4)�/�$H�yq��Ͽ��I���9ZҮIkQFF�ЅkTP���F\����tƋ[ �Ws�}�~2`��
A����������e@��$b��Qt�&�����v}04,߰=�v}�3�>3w^��l5u���(*z`�7؟�����D���V�J1AD�{�\����$�9��w��0��T��%Ɓ�{{����+��!;��������1�&JE� ��T���0<gW�X�Qc�b@��0�Xt�O?� ���<Uw{����,���g��[���bS+��2�LB��0>'\H�x!f�2ԏ�@���?����#/���X]���%r���m��Ǝ��k�_J�PS*FM��J(D"�w��������j�.��좜I�r�T��^⨭��U�ͳ�![������A/��WPj@��� 
���>��)&/H�
n��:��$ˎ��� �7y�9�lX���[ 7�S��_�����0�B�E&4�3^���}c�m�h�be�4*|�%܈�4R�(�)�Х��Z�����d�_��w��
UA+�����a;_�O����~t:�U7�֠�8��q;-�{�ͬa9��u��p���zȺTD%U� �(��a'�     