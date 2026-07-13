-- written by meditext
-- Read SETUP.md for instructions.
-- YOU NEED TO RUN THIS SCHEMA ON POSTGRESQL.
-- setup:
-- CREATE DATABASE roblox;

DROP TABLE IF EXISTS "accoutrements";
DROP SEQUENCE IF EXISTS accoutrements_id_seq;
CREATE SEQUENCE accoutrements_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 32767 CACHE 1;

CREATE TABLE "public"."accoutrements" (
    "user_id" bigint,
    "user_asset_id" bigint,
    "created" timestamp,
    "id" smallint DEFAULT nextval('accoutrements_id_seq') NOT NULL,
    CONSTRAINT "accoutrements_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "ads";
DROP SEQUENCE IF EXISTS ads_id_seq;
CREATE SEQUENCE ads_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."ads" (
    "id" bigint DEFAULT nextval('ads_id_seq') NOT NULL,
    "created" timestamp,
    "updated" timestamp,
    CONSTRAINT "ads_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "alerts";
DROP SEQUENCE IF EXISTS alerts_id_seq;
CREATE SEQUENCE alerts_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 32767 CACHE 1;

CREATE TABLE "public"."alerts" (
    "user_id" bigint NOT NULL,
    "text" text NOT NULL,
    "created" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "updated" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "visibility_type_id" bigint DEFAULT '0' NOT NULL,
    "id" smallint DEFAULT nextval('alerts_id_seq') NOT NULL,
    CONSTRAINT "alerts_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "asset_sales";
DROP SEQUENCE IF EXISTS asset_sales_id_seq;
CREATE SEQUENCE asset_sales_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."asset_sales" (
    "id" bigint DEFAULT nextval('asset_sales_id_seq') NOT NULL,
    "sale_id" bigint NOT NULL,
    "asset_id" bigint NOT NULL,
    "asset_type_id" integer NOT NULL,
    "sale_date" timestamptz NOT NULL,
    "total_price" bigint NOT NULL,
    "currency_type_id" integer NOT NULL,
    "seller_id" bigint,
    "created" timestamptz DEFAULT now() NOT NULL,
    "updated" timestamptz DEFAULT now() NOT NULL,
    CONSTRAINT "asset_sales_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx_asset_sales_asset_id" ON "public"."asset_sales" USING btree ("asset_id");

CREATE INDEX "idx_asset_sales_currency_type_id" ON "public"."asset_sales" USING btree ("currency_type_id");

CREATE INDEX "idx_asset_sales_sale_id" ON "public"."asset_sales" USING btree ("sale_id");


DELIMITER ;;

CREATE TRIGGER "set_asset_sales_updated" BEFORE UPDATE ON "public"."asset_sales" FOR EACH ROW EXECUTE FUNCTION update_asset_sales_updated_column();;

DELIMITER ;

DROP TABLE IF EXISTS "asset_types";
DROP SEQUENCE IF EXISTS asset_types_id_seq;
CREATE SEQUENCE asset_types_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."asset_types" (
    "id" bigint DEFAULT nextval('asset_types_id_seq') NOT NULL,
    "value" text NOT NULL,
    "description" text NOT NULL,
    "abbreviation" text NOT NULL,
    "requires_review" boolean NOT NULL,
    "created" timestamp,
    "updated" timestamp,
    CONSTRAINT "asset_types_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

-- this is required to be inserted as it is a static table
INSERT INTO "asset_types" ("id", "value", "description", "abbreviation", "requires_review", "created", "updated") VALUES
(1,	'Image',	'',	'',	'0',	NULL,	NULL),
(2,	'TeeShirt',	'',	'',	'0',	NULL,	NULL),
(3,	'Audio',	'',	'',	'0',	NULL,	NULL),
(4,	'Mesh',	'',	'',	'0',	NULL,	NULL),
(5,	'Lua',	'',	'',	'0',	NULL,	NULL),
(6,	'HTML',	'',	'',	'0',	NULL,	NULL),
(7,	'Text',	'',	'',	'0',	NULL,	NULL),
(8,	'Hat',	'',	'',	'0',	NULL,	NULL),
(9,	'Place',	'',	'',	'0',	NULL,	NULL),
(10,	'Model',	'',	'',	'0',	NULL,	NULL),
(11,	'Shirt',	'',	'',	'0',	NULL,	NULL),
(12,	'Pants',	'',	'',	'0',	NULL,	NULL),
(13,	'Decal',	'',	'',	'0',	NULL,	NULL),
(16,	'Avatar',	'',	'',	'0',	NULL,	NULL),
(17,	'Head',	'',	'',	'0',	NULL,	NULL),
(18,	'Face',	'',	'',	'0',	NULL,	NULL),
(19,	'Gear',	'',	'',	'0',	NULL,	NULL),
(21,	'Badge',	'',	'',	'0',	NULL,	NULL),
(22,	'GroupEmblem',	'',	'',	'0',	NULL,	NULL),
(14,	'VideoClip',	'',	'',	'0',	NULL,	NULL),
(15,	'Article',	'',	'',	'0',	NULL,	NULL),
(24,	'Animation',	'',	'',	'0',	NULL,	NULL),
(25,	'Arms',	'',	'',	'0',	NULL,	NULL),
(26,	'Legs',	'',	'',	'0',	NULL,	NULL),
(27,	'Torso',	'',	'',	'0',	NULL,	NULL),
(28,	'RightArm',	'',	'',	'0',	NULL,	NULL),
(29,	'LeftArm',	'',	'',	'0',	NULL,	NULL),
(30,	'LeftLeg',	'',	'',	'0',	NULL,	NULL),
(31,	'RightLeg',	'',	'',	'0',	NULL,	NULL),
(32,	'Package',	'',	'',	'0',	NULL,	NULL),
(33,	'YouTubeVideo',	'',	'',	'0',	NULL,	NULL),
(34,	'GamePass',	'',	'',	'0',	NULL,	NULL),
(35,	'App',	'',	'',	'0',	NULL,	NULL),
(23,	'Bundle',	'',	'',	'0',	NULL,	NULL),
(20,	'null1',	'',	'',	'0',	NULL,	NULL),
(36,	'Game',	'',	'',	'0',	NULL,	NULL),
(37,	'Code',	'',	'',	'0',	NULL,	NULL),
(38,	'Plugin',	'',	'',	'0',	NULL,	NULL),
(39,	'SolidModel',	'',	'',	'0',	NULL,	NULL);

DROP TABLE IF EXISTS "assetoptions";
DROP SEQUENCE IF EXISTS assetoptions_id_seq;
CREATE SEQUENCE assetoptions_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."assetoptions" (
    "id" bigint DEFAULT nextval('assetoptions_id_seq') NOT NULL,
    "assetid" bigint NOT NULL,
    "enablecomments" boolean DEFAULT true NOT NULL,
    "enableratings" boolean DEFAULT true NOT NULL,
    "iscopylocked" boolean DEFAULT true NOT NULL,
    "isfriendsonly" boolean DEFAULT false NOT NULL,
    "isallowinggear" boolean DEFAULT false NOT NULL,
    "allowedgearcategories" bigint DEFAULT '0' NOT NULL,
    "defaultexpirationinticks" bigint,
    "created" timestamptz DEFAULT now() NOT NULL,
    "updated" timestamptz DEFAULT now() NOT NULL,
    "enforcegenre" boolean DEFAULT true NOT NULL,
    "minmembershiptype" smallint DEFAULT '0' NOT NULL,
    CONSTRAINT "assetoptions_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx_assetoptions_assetid" ON "public"."assetoptions" USING btree ("assetid");


DELIMITER ;;

CREATE TRIGGER "set_assetoptions_updated" BEFORE UPDATE ON "public"."assetoptions" FOR EACH ROW EXECUTE FUNCTION update_assetoptions_updated_column();;

DELIMITER ;

DROP TABLE IF EXISTS "assets";
DROP SEQUENCE IF EXISTS "assets_AssetId_seq";
CREATE SEQUENCE "assets_AssetId_seq" INCREMENT  MINVALUE  MAXVALUE  CACHE ;

CREATE TABLE "public"."assets" (
    "AssetId" bigint DEFAULT nextval('"assets_AssetId_seq"') NOT NULL,
    "Name" text NOT NULL,
    "UpdatedDate" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "PriceInRobux" integer,
    "PriceInTickets" integer,
    "AssetType" integer NOT NULL,
    "Description" text,
    "OwnerId" integer NOT NULL,
    "CreationDate" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "Limited" boolean DEFAULT false NOT NULL,
    "IsArchived" boolean DEFAULT false NOT NULL,
    "CurrentVersionId" bigint DEFAULT '0' NOT NULL,
    "hash" character varying(32),
    "Genres" boolean DEFAULT false NOT NULL,
    "Categories" bigint DEFAULT '0' NOT NULL,
    "HashId" bigint DEFAULT '0' NOT NULL,
    CONSTRAINT "assets_pkey" PRIMARY KEY ("AssetId")
) WITH (oids = false);


DROP TABLE IF EXISTS "badges";
CREATE TABLE "public"."badges" (
    "name" character varying(255),
    "description" inet,
    "image_asset_id" bigint,
    "badge_type_id" bigint,
    "creator_user_id" bigint,
    "is_enabled" boolean
) WITH (oids = false);


DROP TABLE IF EXISTS "feedifications";
DROP SEQUENCE IF EXISTS feedifications_id_seq;
CREATE SEQUENCE feedifications_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."feedifications" (
    "id" integer DEFAULT nextval('feedifications_id_seq') NOT NULL,
    "message" text NOT NULL,
    "title" text NOT NULL,
    "created_at" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "feedifications_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "feeds";
DROP SEQUENCE IF EXISTS feeds_post_id_seq;
CREATE SEQUENCE feeds_post_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."feeds" (
    "author_id" bigint,
    "content" text,
    "post_id" bigint DEFAULT nextval('feeds_post_id_seq') NOT NULL,
    "posted_at" integer NOT NULL,
    CONSTRAINT "feeds_pkey" PRIMARY KEY ("post_id")
) WITH (oids = false);

-- this is required to be inserted as it is a static table
DROP TABLE IF EXISTS "forum_groups";
DROP SEQUENCE IF EXISTS forum_groups_id_seq;
CREATE SEQUENCE forum_groups_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."forum_groups" (
    "id" integer DEFAULT nextval('forum_groups_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    "sort_order" integer DEFAULT '0' NOT NULL,
    CONSTRAINT "forum_groups_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "forum_groups" ("id", "name", "sort_order") VALUES
(1,	'ROBLOX',	1),
(8,	'Club Houses',	2),
(9,	'Game Creation and Development',	3),
(6,	'Entertainment',	4);

DROP TABLE IF EXISTS "forums";
DROP SEQUENCE IF EXISTS forums_id_seq;
CREATE SEQUENCE forums_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."forums" (
    "id" integer DEFAULT nextval('forums_id_seq') NOT NULL,
    "group_id" integer NOT NULL,
    "name" character varying(255) NOT NULL,
    "description" text,
    "threads_count" integer DEFAULT '0' NOT NULL,
    "posts_count" integer DEFAULT '0' NOT NULL,
    "sort_order" integer DEFAULT '0' NOT NULL,
    CONSTRAINT "forums_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "forums" ("id", "group_id", "name", "description", "threads_count", "posts_count", "sort_order") VALUES
(46,	1,	'All Things ROBLOX',	'The area for discussions purely about ROBLOX – the features, the games, and company news.',	2,	4,	1),
(14,	1,	'Help (Technical Support and Account Issues)',	'Seeking account or technical help? Post your questions here.',	1,	0,	2),
(52,	1,	'Video Creations with ROBLOX',	'Specifically for videos recorded in the ROBLOX game. Use this forum to announce your Twitch.tv or YouTube channel, and to find actors, set builders, and other contributors for your video project.',	0,	0,	3),
(21,	1,	'Suggestions & Ideas',	'Do you have a suggestion and ideas for ROBLOX? Share your feedback here.',	0,	0,	4),
(54,	1,	'BLOXFaires Around the Globe',	'ROBLOX is going to be at various Maker Faires and conferences around the globe. Discuss those events here!',	0,	0,	5),
(43,	1,	'ROBLOX Contests',	'Get involved with ROBLOX Contests! We''re discussing ongoing and future contests in this forum.',	0,	0,	6),
(44,	1,	'I Made That',	'Calling all creative ROBLOXians! Model builders, clothing creators, decal artists and re-texturers - this is your forum.',	0,	0,	7),
(13,	8,	'ROBLOX Talk',	'A popular hangout where ROBLOXians talk about various topics.',	0,	0,	1),
(18,	8,	'Off Topic',	'When no other forum makes sense for your post, Off Topic will help it make even less sense.',	0,	0,	2),
(32,	8,	'Clans & Guilds',	'Talk about what’s going on in your Clans, Groups, Companies, and Guilds, and about the Groups feature in general.',	0,	0,	3),
(35,	8,	'Let''s Make a Deal',	'A fast paced community dedicated to mastering the Limited Trades and Sales market, and divining the subtleties of the ROBLOX Currency Exchange.',	0,	0,	4),
(45,	8,	'Global Chat',	'This forum is the place to discuss the country you are from, world travel, find online pen pals.',	0,	0,	5),
(19,	9,	'Building Helpers',	'Learn the ins and outs of building structures in ROBLOX. Share your techniques with other builders, discuss designs, and draft plans. Help others!',	0,	0,	1),
(20,	9,	'Scripting Helpers',	'Need help with a script you are writing? Need to edit an existing script? This is the place to share your 1337 Lua programming skills and help others.',	0,	0,	2),
(40,	9,	'Game Design',	'The place to discuss about the novel game ideas that you are possibly working on. This is not the place to hire people nor post help requests.',	0,	0,	3),
(37,	9,	'Game Test',	'This is the place to post about www.gametest1.roblox.com about the ROBLOX game and Studio. [Note: Test servers may not be up all the time.]',	0,	0,	4),
(36,	9,	'Website Test',	'Post about sitetest.roblox.com about ROBLOX website features here. [Note: Test servers may not be up all the time.]',	0,	0,	5),
(41,	9,	'ROBLOX Mobile',	'Discuss mobile versions of the ROBLOX website, the iPhone app, and playing ROBLOX on the iPad.',	0,	0,	6),
(39,	9,	'ROBLOX Studio',	'This is the place to post about ROBLOX Studio for Mac and Windows.',	0,	0,	7),
(33,	9,	'Scripters',	'This is the place for discussion about scripting. Anything about scripting that is not a help request or topic belongs here.',	0,	0,	8),
(42,	6,	'Video Game Fans',	'Talk about your favorite video and computer games outside of ROBLOX, with other fanatical video gamers!',	0,	0,	1);


DROP TABLE IF EXISTS "groups";
CREATE TABLE "public"."groups" (
    "agent_id" bigint,
    "owner_user_id" bigint,
    "previous_owner_user_id" bigint,
    "name" character varying(255),
    "description" inet,
    "emblem_id" bigint,
    "public_entry_allowed" text,
    "bc_only_join" text,
    "is_locked" boolean,
    "created" timestamp,
    "updated" timestamp
) WITH (oids = false);


DROP TABLE IF EXISTS "payments";
DROP SEQUENCE IF EXISTS payments_id_seq;
CREATE SEQUENCE payments_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."payments" (
    "id" bigint DEFAULT nextval('payments_id_seq') NOT NULL,
    "sale_id" bigint NOT NULL,
    "unit_price" bigint NOT NULL,
    "currency_type_id" integer NOT NULL,
    "payment_status_type_id" smallint NOT NULL,
    "payment_date" timestamptz NOT NULL,
    "created" timestamptz DEFAULT now() NOT NULL,
    "updated" timestamptz DEFAULT now() NOT NULL,
    CONSTRAINT "payments_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DELIMITER ;;

CREATE TRIGGER "set_payments_updated" BEFORE UPDATE ON "public"."payments" FOR EACH ROW EXECUTE FUNCTION update_payments_updated_column();;

DELIMITER ;

DROP TABLE IF EXISTS "posts";
DROP SEQUENCE IF EXISTS posts_id_seq;
CREATE SEQUENCE posts_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."posts" (
    "id" integer DEFAULT nextval('posts_id_seq') NOT NULL,
    "thread_id" integer NOT NULL,
    "user_id" integer NOT NULL,
    "content" text NOT NULL,
    "created_at" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "posts_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "products";
DROP SEQUENCE IF EXISTS products_id_seq;
CREATE SEQUENCE products_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."products" (
    "id" bigint DEFAULT nextval('products_id_seq') NOT NULL,
    "product_type_id" smallint NOT NULL,
    "is_public_domain" boolean DEFAULT false NOT NULL,
    "is_for_sale" boolean DEFAULT false NOT NULL,
    "price_in_robux" bigint,
    "price_in_tickets" bigint,
    "roblox_product_id" integer,
    "asset_id" bigint,
    "asset_type_id" integer,
    "creator_id" bigint,
    "asset_genres" bigint DEFAULT '0' NOT NULL,
    "asset_categories" bigint DEFAULT '0' NOT NULL,
    "affiliate_fee_percentage" integer,
    "created" timestamptz DEFAULT now() NOT NULL,
    "updated" timestamptz DEFAULT now() NOT NULL,
    CONSTRAINT "products_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DELIMITER ;;

CREATE TRIGGER "set_products_updated" BEFORE UPDATE ON "public"."products" FOR EACH ROW EXECUTE FUNCTION update_products_updated_column();;

DELIMITER ;

DROP TABLE IF EXISTS "promocode_redemptions";
DROP SEQUENCE IF EXISTS promocode_redemptions_id_seq;
CREATE SEQUENCE promocode_redemptions_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."promocode_redemptions" (
    "id" bigint DEFAULT nextval('promocode_redemptions_id_seq') NOT NULL,
    "promocode_id" bigint NOT NULL,
    "user_id" bigint NOT NULL,
    "created" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "updated" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "promocode_redemptions_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "unique_redemption" UNIQUE ("promocode_id", "user_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "promocodes";
DROP SEQUENCE IF EXISTS promocodes_id_seq;
CREATE SEQUENCE promocodes_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."promocodes" (
    "id" bigint DEFAULT nextval('promocodes_id_seq') NOT NULL,
    "code" text NOT NULL,
    "expiration" timestamp,
    "max_redemptions" integer DEFAULT '0' NOT NULL,
    "created" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "updated" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "promocodes_code_key" UNIQUE ("code"),
    CONSTRAINT "promocodes_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

--- this is required to be inserted as it is a static table
DROP TABLE IF EXISTS "roblox_products";
DROP SEQUENCE IF EXISTS roblox_products_id_seq;
CREATE SEQUENCE roblox_products_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."roblox_products" (
    "id" bigint DEFAULT nextval('roblox_products_id_seq') NOT NULL,
    "name" text NOT NULL,
    "description" text,
    "created" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "updated" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "roblox_products_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "roblox_products" ("id", "name", "description", "created", "updated") VALUES
(1,	'User Ad: 728x90',	'',	'2025-10-04 12:10:31.880341',	'2025-10-04 12:10:31.880341'),
(2,	'User Ad: 160x600',	NULL,	'2025-10-04 12:10:43.461508',	'2025-10-04 12:10:43.461508'),
(3,	'User Ad: 300x250',	NULL,	'2025-10-04 12:10:52.625871',	'2025-10-04 12:10:52.625871'),
(4,	'UserAd: PromotedUniverseDesktop',	NULL,	'2025-10-04 12:11:02.010407',	'2025-10-04 12:11:02.010407'),
(5,	'UserAd: PromotedUniverseTablet',	NULL,	'2025-10-04 12:11:08.76935',	'2025-10-04 12:11:08.76935'),
(6,	'UserAd: PromotedUniversePhone',	NULL,	'2025-10-04 12:11:18.506122',	'2025-10-04 12:11:18.506122'),
(7,	'Group',	NULL,	'2025-10-04 12:11:31.68323',	'2025-10-04 12:11:31.68323'),
(8,	'Badge',	NULL,	'2025-10-04 12:11:35.488352',	'2025-10-04 12:11:35.488352'),
(9,	'GroupRoleSet',	NULL,	'2025-10-04 12:11:41.972131',	'2025-10-04 12:11:41.972131'),
(10,	'YouTubeMediaItem',	NULL,	'2025-10-04 12:11:46.333893',	'2025-10-04 12:11:46.333893'),
(11,	'ImageMediaItem',	NULL,	'2025-10-04 12:11:52.13253',	'2025-10-04 12:11:52.13253'),
(12,	'Game Pass',	NULL,	'2025-10-04 12:11:57.428525',	'2025-10-04 12:11:57.428525'),
(13,	'Cash Out',	NULL,	'2025-10-04 12:12:05.033933',	'2025-10-04 12:12:05.033933'),
(14,	'Audio',	NULL,	'2025-10-04 12:12:09.968344',	'2025-10-04 12:12:09.968344'),
(15,	'Username Change',	NULL,	'2025-10-04 12:12:17.25315',	'2025-10-04 12:12:17.25315'),
(16,	'Animation',	NULL,	'2025-10-04 12:12:23.163719',	'2025-10-04 12:12:23.163719'),
(17,	'Clan',	NULL,	'2025-10-04 12:12:29.317726',	'2025-10-04 12:12:29.317726'),
(18,	'PrivateServer',	NULL,	'2025-10-04 12:12:33.992388',	'2025-10-04 12:12:33.992388'),
(19,	'Audio: Short Sound Effect',	NULL,	'2025-10-04 12:12:49.857383',	'2025-10-04 12:12:49.857383'),
(20,	'Audio: Long Sound Effect',	NULL,	'2025-10-04 12:12:55.606097',	'2025-10-04 12:12:55.606097'),
(21,	'Audio: Music',	NULL,	'2025-10-04 12:13:01.998975',	'2025-10-04 12:13:01.998975'),
(22,	'Audio: Long Music',	NULL,	'2025-10-04 12:13:06.762456',	'2025-10-04 12:13:06.762456');

DROP TABLE IF EXISTS "sales";
DROP SEQUENCE IF EXISTS sales_id_seq;
CREATE SEQUENCE sales_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."sales" (
    "id" integer DEFAULT nextval('sales_id_seq') NOT NULL,
    "purchaser_id" integer NOT NULL,
    "seller_id" integer,
    "product_id" integer NOT NULL,
    "quantity" integer DEFAULT '1' NOT NULL,
    "currency_type_id" smallint NOT NULL,
    "unit_price" integer DEFAULT '0' NOT NULL,
    "discount" integer DEFAULT '0' NOT NULL,
    "total_price" integer DEFAULT '0' NOT NULL,
    "marketplace_fee" integer DEFAULT '0' NOT NULL,
    "created" timestamp DEFAULT now() NOT NULL,
    "updated" timestamp DEFAULT now() NOT NULL,
    CONSTRAINT "sales_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "threads";
DROP SEQUENCE IF EXISTS threads_id_seq;
CREATE SEQUENCE threads_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."threads" (
    "id" integer DEFAULT nextval('threads_id_seq') NOT NULL,
    "forum_id" integer NOT NULL,
    "user_id" integer NOT NULL,
    "subject" character varying(255) NOT NULL,
    "created_at" timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "last_post_at" timestamp,
    "last_post_user_id" integer,
    "views_count" integer DEFAULT '0' NOT NULL,
    "replies_count" integer DEFAULT '0' NOT NULL,
    "is_pinned" boolean DEFAULT false NOT NULL,
    "is_locked" boolean DEFAULT false NOT NULL,
    "is_popular" boolean DEFAULT false NOT NULL,
    CONSTRAINT "threads_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

DROP TABLE IF EXISTS "transaction_history";
DROP SEQUENCE IF EXISTS transaction_history_id_seq;
CREATE SEQUENCE transaction_history_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."transaction_history" (
    "id" bigint DEFAULT nextval('transaction_history_id_seq') NOT NULL,
    "transaction_type_id" smallint NOT NULL,
    "transaction_origin_type_id" smallint NOT NULL,
    "currency_type_id" smallint NOT NULL,
    "user_id" bigint NOT NULL,
    "sale_id" bigint,
    "amount" bigint NOT NULL,
    "is_processed" boolean DEFAULT false NOT NULL,
    "created" timestamp DEFAULT now() NOT NULL,
    "updated" timestamp DEFAULT now() NOT NULL,
    CONSTRAINT "transaction_history_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "idx_transaction_history_user" ON "public"."transaction_history" USING btree ("user_id", "currency_type_id", "transaction_type_id", "transaction_origin_type_id");


DROP TABLE IF EXISTS "user_assets";
CREATE TABLE "public"."user_assets" (
    "user_id" bigint,
    "asset_id" bigint,
    "asset_type_id" bigint,
    "created" timestamp,
    "updated" timestamp
) WITH (oids = false);


DROP TABLE IF EXISTS "user_badges";
CREATE TABLE "public"."user_badges" (
    "user_id" bigint,
    "badge_id" bigint,
    "awarded_at" timestamp
) WITH (oids = false);


DROP TABLE IF EXISTS "user_login_awards";
DROP SEQUENCE IF EXISTS user_login_awards_id_seq;
CREATE SEQUENCE user_login_awards_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."user_login_awards" (
    "id" integer DEFAULT nextval('user_login_awards_id_seq') NOT NULL,
    "user_id" bigint NOT NULL,
    "last_awarded" timestamp,
    "created" timestamp DEFAULT CURRENT_TIMESTAMP,
    "updated" timestamp DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT "user_login_awards_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "users";
DROP SEQUENCE IF EXISTS users_id_seq;
CREATE SEQUENCE users_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."users" (
    "id" bigint DEFAULT nextval('users_id_seq') NOT NULL,
    "birthdate" date,
    "gender" integer,
    "created" timestamp NOT NULL,
    "updated" timestamp NOT NULL,
    "use_super_safe_privacy_mode" boolean,
    "username" character varying(255) NOT NULL,
    "description" text,
    "account_status_id" integer DEFAULT '0' NOT NULL,
    "membership_type" integer DEFAULT '0' NOT NULL,
    "moderation_status" integer DEFAULT '0' NOT NULL,
    "lastactive" bigint,
    "robux" bigint DEFAULT '0' NOT NULL,
    "tickets" bigint DEFAULT '0' NOT NULL,
    "ips" text,
    "email" character varying(255),
    "password" text,
    "knockouts" integer DEFAULT '0' NOT NULL,
    "wipeouts" integer DEFAULT '0' NOT NULL,
    "bodycolor" jsonb,
    "InventoryPrivacy" boolean DEFAULT false NOT NULL,
    "post_count" integer DEFAULT '0' NOT NULL,
    "language" character varying(25) DEFAULT 'en' NOT NULL,
    CONSTRAINT "users_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE TABLE IF NOT EXISTS messages_v2 (
    id BIGSERIAL PRIMARY KEY,
    message_type_id INTEGER NOT NULL,
    subject VARCHAR(256),
    body TEXT,
    author_id BIGINT,
    recipient_id BIGINT,
    is_system_message BOOLEAN NOT NULL DEFAULT FALSE,
    is_broadcast_message BOOLEAN NOT NULL DEFAULT FALSE,
    is_read BOOLEAN NOT NULL DEFAULT FALSE,
    is_archived BOOLEAN NOT NULL DEFAULT FALSE,
    created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_messages_v2_recipient_id ON messages_v2(recipient_id);
CREATE INDEX IF NOT EXISTS idx_messages_v2_author_id ON messages_v2(author_id);
CREATE INDEX IF NOT EXISTS idx_messages_v2_created ON messages_v2(created DESC);
CREATE INDEX IF NOT EXISTS idx_messages_v2_recipient_read ON messages_v2(recipient_id, is_read);
CREATE INDEX IF NOT EXISTS idx_messages_v2_recipient_archived ON messages_v2(recipient_id, is_archived);
CREATE INDEX IF NOT EXISTS idx_messages_v2_recipient_type ON messages_v2(recipient_id, message_type_id);

CREATE OR REPLACE FUNCTION messages_v2_insert_message_v2(
    p_message_type_id INTEGER,
    p_subject VARCHAR(256),
    p_body TEXT,
    p_author_id BIGINT,
    p_recipient_id BIGINT,
    p_is_system_message BOOLEAN,
    p_is_broadcast_message BOOLEAN,
    p_is_read BOOLEAN,
    p_is_archived BOOLEAN,
    p_created TIMESTAMP,
    p_updated TIMESTAMP
)
RETURNS BIGINT AS $$
DECLARE
    v_id BIGINT;
BEGIN
    INSERT INTO messages_v2 (
        message_type_id, subject, body, author_id, recipient_id,
        is_system_message, is_broadcast_message, is_read, is_archived,
        created, updated
    ) VALUES (
        p_message_type_id, p_subject, p_body, p_author_id, p_recipient_id,
        p_is_system_message, p_is_broadcast_message, p_is_read, p_is_archived,
        p_created, p_updated
    )
    RETURNING id INTO v_id;
    
    RETURN v_id;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_update_message_v2_by_id(
    p_id BIGINT,
    p_message_type_id INTEGER,
    p_subject VARCHAR(256),
    p_body TEXT,
    p_author_id BIGINT,
    p_recipient_id BIGINT,
    p_is_system_message BOOLEAN,
    p_is_broadcast_message BOOLEAN,
    p_is_read BOOLEAN,
    p_is_archived BOOLEAN,
    p_created TIMESTAMP,
    p_updated TIMESTAMP
)
RETURNS VOID AS $$
BEGIN
    UPDATE messages_v2
    SET 
        message_type_id = p_message_type_id,
        subject = p_subject,
        body = p_body,
        author_id = p_author_id,
        recipient_id = p_recipient_id,
        is_system_message = p_is_system_message,
        is_broadcast_message = p_is_broadcast_message,
        is_read = p_is_read,
        is_archived = p_is_archived,
        created = p_created,
        updated = p_updated
    WHERE id = p_id;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_delete_message_v2_by_id(p_id BIGINT)
RETURNS VOID AS $$
BEGIN
    DELETE FROM messages_v2 WHERE id = p_id;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_message_v2_by_id(p_id BIGINT)
RETURNS TABLE (
    id BIGINT,
    message_type_id INTEGER,
    subject VARCHAR(256),
    body TEXT,
    author_id BIGINT,
    recipient_id BIGINT,
    is_system_message BOOLEAN,
    is_broadcast_message BOOLEAN,
    is_read BOOLEAN,
    is_archived BOOLEAN,
    created TIMESTAMP,
    updated TIMESTAMP
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        m.id, m.message_type_id, m.subject, m.body, m.author_id, m.recipient_id,
        m.is_system_message, m.is_broadcast_message, m.is_read, m.is_archived,
        m.created, m.updated
    FROM messages_v2 m
    WHERE m.id = p_id;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_messages_v2_by_ids(p_ids BIGINT[])
RETURNS TABLE (
    id BIGINT,
    message_type_id INTEGER,
    subject VARCHAR(256),
    body TEXT,
    author_id BIGINT,
    recipient_id BIGINT,
    is_system_message BOOLEAN,
    is_broadcast_message BOOLEAN,
    is_read BOOLEAN,
    is_archived BOOLEAN,
    created TIMESTAMP,
    updated TIMESTAMP
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        m.id, m.message_type_id, m.subject, m.body, m.author_id, m.recipient_id,
        m.is_system_message, m.is_broadcast_message, m.is_read, m.is_archived,
        m.created, m.updated
    FROM messages_v2 m
    WHERE m.id = ANY(p_ids);
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_message_v2_ids(
    p_exclusive_start_id BIGINT,
    p_maximum_rows INTEGER
)
RETURNS TABLE (id BIGINT) AS $$
BEGIN
    RETURN QUERY
    SELECT m.id
    FROM messages_v2 m
    WHERE m.id > p_exclusive_start_id
    ORDER BY m.id
    LIMIT p_maximum_rows;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_message_v2_ids_by_recipient_id_paged_and_sorted(
    p_recipient_id BIGINT,
    p_start_row_index BIGINT,
    p_maximum_rows INTEGER,
    p_sort_expression VARCHAR(50)
)
RETURNS TABLE (id BIGINT) AS $$
DECLARE
    v_order_clause TEXT;
BEGIN
    v_order_clause := CASE 
        WHEN p_sort_expression = 'Created DESC' THEN 'created DESC'
        WHEN p_sort_expression = 'Created ASC' THEN 'created ASC'
        ELSE 'created DESC'
    END;

    RETURN QUERY EXECUTE format('
        SELECT m.id
        FROM messages_v2 m
        WHERE m.recipient_id = $1
        ORDER BY %s
        OFFSET $2 LIMIT $3
    ', v_order_clause)
    USING p_recipient_id, p_start_row_index - 1, p_maximum_rows;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_message_v2_ids_excluding_invitations_by_recipient_id_paged_and_sorted(
    p_recipient_id BIGINT,
    p_start_row_index BIGINT,
    p_maximum_rows INTEGER,
    p_sort_expression VARCHAR(50)
)
RETURNS TABLE (id BIGINT) AS $$
DECLARE
    v_order_clause TEXT;
BEGIN
    v_order_clause := CASE 
        WHEN p_sort_expression = 'Created DESC' THEN 'created DESC'
        WHEN p_sort_expression = 'Created ASC' THEN 'created ASC'
        ELSE 'created DESC'
    END;

    RETURN QUERY EXECUTE format('
        SELECT m.id
        FROM messages_v2 m
        WHERE m.recipient_id = $1 AND m.message_type_id != 2
        ORDER BY %s
        OFFSET $2 LIMIT $3
    ', v_order_clause)
    USING p_recipient_id, p_start_row_index - 1, p_maximum_rows;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_unread_message_v2_ids_excluding_invitations_by_recipient_id_paged_and_sorted(
    p_recipient_id BIGINT,
    p_start_row_index BIGINT,
    p_maximum_rows INTEGER,
    p_sort_expression VARCHAR(50)
)
RETURNS TABLE (id BIGINT) AS $$
DECLARE
    v_order_clause TEXT;
BEGIN
    v_order_clause := CASE 
        WHEN p_sort_expression = 'Created DESC' THEN 'created DESC'
        WHEN p_sort_expression = 'Created ASC' THEN 'created ASC'
        ELSE 'created DESC'
    END;

    RETURN QUERY EXECUTE format('
        SELECT m.id
        FROM messages_v2 m
        WHERE m.recipient_id = $1 
            AND m.message_type_id != 2
            AND m.is_read = FALSE
        ORDER BY %s
        OFFSET $2 LIMIT $3
    ', v_order_clause)
    USING p_recipient_id, p_start_row_index - 1, p_maximum_rows;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_archived_message_v2_ids_excluding_invitations_by_recipient_id_paged_and_sorted(
    p_recipient_id BIGINT,
    p_start_row_index BIGINT,
    p_maximum_rows INTEGER,
    p_sort_expression VARCHAR(50)
)
RETURNS TABLE (id BIGINT) AS $$
DECLARE
    v_order_clause TEXT;
BEGIN
    v_order_clause := CASE 
        WHEN p_sort_expression = 'Created DESC' THEN 'created DESC'
        WHEN p_sort_expression = 'Created ASC' THEN 'created ASC'
        ELSE 'created DESC'
    END;

    RETURN QUERY EXECUTE format('
        SELECT m.id
        FROM messages_v2 m
        WHERE m.recipient_id = $1 
            AND m.message_type_id != 2
            AND m.is_archived = TRUE
        ORDER BY %s
        OFFSET $2 LIMIT $3
    ', v_order_clause)
    USING p_recipient_id, p_start_row_index - 1, p_maximum_rows;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_unarchived_message_v2_ids_excluding_invitations_by_recipient_id_paged_and_sorted(
    p_recipient_id BIGINT,
    p_start_row_index BIGINT,
    p_maximum_rows INTEGER,
    p_sort_expression VARCHAR(50)
)
RETURNS TABLE (id BIGINT) AS $$
DECLARE
    v_order_clause TEXT;
BEGIN
    v_order_clause := CASE 
        WHEN p_sort_expression = 'Created DESC' THEN 'created DESC'
        WHEN p_sort_expression = 'Created ASC' THEN 'created ASC'
        ELSE 'created DESC'
    END;

    RETURN QUERY EXECUTE format('
        SELECT m.id
        FROM messages_v2 m
        WHERE m.recipient_id = $1 
            AND m.message_type_id != 2
            AND m.is_archived = FALSE
        ORDER BY %s
        OFFSET $2 LIMIT $3
    ', v_order_clause)
    USING p_recipient_id, p_start_row_index - 1, p_maximum_rows;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_unread_archived_message_v2_ids_excluding_invitations_by_recipient_id_paged_and_sorted(
    p_recipient_id BIGINT,
    p_start_row_index BIGINT,
    p_maximum_rows INTEGER,
    p_sort_expression VARCHAR(50)
)
RETURNS TABLE (id BIGINT) AS $$
DECLARE
    v_order_clause TEXT;
BEGIN
    v_order_clause := CASE 
        WHEN p_sort_expression = 'Created DESC' THEN 'created DESC'
        WHEN p_sort_expression = 'Created ASC' THEN 'created ASC'
        ELSE 'created DESC'
    END;

    RETURN QUERY EXECUTE format('
        SELECT m.id
        FROM messages_v2 m
        WHERE m.recipient_id = $1 
            AND m.message_type_id != 2
            AND m.is_read = FALSE
            AND m.is_archived = TRUE
        ORDER BY %s
        OFFSET $2 LIMIT $3
    ', v_order_clause)
    USING p_recipient_id, p_start_row_index - 1, p_maximum_rows;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_unread_unarchived_message_v2_ids_excluding_invitations_by_recipient_id_paged_and_sorted(
    p_recipient_id BIGINT,
    p_start_row_index BIGINT,
    p_maximum_rows INTEGER,
    p_sort_expression VARCHAR(50)
)
RETURNS TABLE (id BIGINT) AS $$
DECLARE
    v_order_clause TEXT;
BEGIN
    v_order_clause := CASE 
        WHEN p_sort_expression = 'Created DESC' THEN 'created DESC'
        WHEN p_sort_expression = 'Created ASC' THEN 'created ASC'
        ELSE 'created DESC'
    END;

    RETURN QUERY EXECUTE format('
        SELECT m.id
        FROM messages_v2 m
        WHERE m.recipient_id = $1 
            AND m.message_type_id != 2
            AND m.is_read = FALSE
            AND m.is_archived = FALSE
        ORDER BY %s
        OFFSET $2 LIMIT $3
    ', v_order_clause)
    USING p_recipient_id, p_start_row_index - 1, p_maximum_rows;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_system_messages_v2_by_recipient_id_paged(
    p_recipient_id BIGINT,
    p_start_row_index BIGINT,
    p_maximum_rows INTEGER
)
RETURNS TABLE (id BIGINT) AS $$
BEGIN
    RETURN QUERY
    SELECT m.id
    FROM messages_v2 m
    WHERE m.recipient_id = p_recipient_id 
        AND m.is_system_message = TRUE
    ORDER BY m.created DESC
    OFFSET p_start_row_index - 1 LIMIT p_maximum_rows;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_unarchived_messages_v2_excluding_invitations_and_system_by_recipient_id_paged(
    p_recipient_id BIGINT,
    p_start_row_index BIGINT,
    p_maximum_rows INTEGER
)
RETURNS TABLE (id BIGINT) AS $$
BEGIN
    RETURN QUERY
    SELECT m.id
    FROM messages_v2 m
    WHERE m.recipient_id = p_recipient_id 
        AND m.message_type_id != 2
        AND m.is_system_message = FALSE
        AND m.is_archived = FALSE
    ORDER BY m.created DESC
    OFFSET p_start_row_index - 1 LIMIT p_maximum_rows;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_archived_message_v2_ids_excluding_invitations_and_system_by_recipient_id_paged(
    p_recipient_id BIGINT,
    p_start_row_index BIGINT,
    p_maximum_rows INTEGER
)
RETURNS TABLE (id BIGINT) AS $$
BEGIN
    RETURN QUERY
    SELECT m.id
    FROM messages_v2 m
    WHERE m.recipient_id = p_recipient_id 
        AND m.message_type_id != 2
        AND m.is_system_message = FALSE
        AND m.is_archived = TRUE
    ORDER BY m.created DESC
    OFFSET p_start_row_index - 1 LIMIT p_maximum_rows;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_message_v2_ids_excluding_invitations_by_author_id_paged(
    p_author_id BIGINT,
    p_start_row_index BIGINT,
    p_maximum_rows INTEGER
)
RETURNS TABLE (id BIGINT) AS $$
BEGIN
    RETURN QUERY
    SELECT m.id
    FROM messages_v2 m
    WHERE m.author_id = p_author_id 
        AND m.message_type_id != 2
    ORDER BY m.created DESC
    OFFSET p_start_row_index - 1 LIMIT p_maximum_rows;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_total_number_of_messages_v2_by_recipient_id(p_recipient_id BIGINT)
RETURNS INTEGER AS $$
DECLARE
    v_count INTEGER;
BEGIN
    SELECT COUNT(*)::INTEGER INTO v_count
    FROM messages_v2
    WHERE recipient_id = p_recipient_id;
    RETURN v_count;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_total_number_of_messages_v2_excluding_invitations_by_recipient_id(p_recipient_id BIGINT)
RETURNS INTEGER AS $$
DECLARE
    v_count INTEGER;
BEGIN
    SELECT COUNT(*)::INTEGER INTO v_count
    FROM messages_v2
    WHERE recipient_id = p_recipient_id 
        AND message_type_id != 2;
    RETURN v_count;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_total_number_of_unread_messages_v2_excluding_invitations_by_recipient_id(p_recipient_id BIGINT)
RETURNS INTEGER AS $$
DECLARE
    v_count INTEGER;
BEGIN
    SELECT COUNT(*)::INTEGER INTO v_count
    FROM messages_v2
    WHERE recipient_id = p_recipient_id 
        AND message_type_id != 2
        AND is_read = FALSE;
    RETURN v_count;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_total_number_of_archived_messages_v2_excluding_invitations_by_recipient_id(p_recipient_id BIGINT)
RETURNS INTEGER AS $$
DECLARE
    v_count INTEGER;
BEGIN
    SELECT COUNT(*)::INTEGER INTO v_count
    FROM messages_v2
    WHERE recipient_id = p_recipient_id 
        AND message_type_id != 2
        AND is_archived = TRUE;
    RETURN v_count;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_total_number_of_unarchived_messages_v2_excluding_invitations_by_recipient_id(p_recipient_id BIGINT)
RETURNS INTEGER AS $$
DECLARE
    v_count INTEGER;
BEGIN
    SELECT COUNT(*)::INTEGER INTO v_count
    FROM messages_v2
    WHERE recipient_id = p_recipient_id 
        AND message_type_id != 2
        AND is_archived = FALSE;
    RETURN v_count;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_total_number_of_unread_archived_messages_v2_excluding_invitations_by_recipient_id(p_recipient_id BIGINT)
RETURNS INTEGER AS $$
DECLARE
    v_count INTEGER;
BEGIN
    SELECT COUNT(*)::INTEGER INTO v_count
    FROM messages_v2
    WHERE recipient_id = p_recipient_id 
        AND message_type_id != 2
        AND is_read = FALSE
        AND is_archived = TRUE;
    RETURN v_count;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_total_number_of_unread_unarchived_messages_v2_excluding_invitations_by_recipient_id(p_recipient_id BIGINT)
RETURNS INTEGER AS $$
DECLARE
    v_count INTEGER;
BEGIN
    SELECT COUNT(*)::INTEGER INTO v_count
    FROM messages_v2
    WHERE recipient_id = p_recipient_id 
        AND message_type_id != 2
        AND is_read = FALSE
        AND is_archived = FALSE;
    RETURN v_count;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_total_number_of_unarchived_messages_v2_excluding_invitations_and_system_by_recipient_id(p_recipient_id BIGINT)
RETURNS INTEGER AS $$
DECLARE
    v_count INTEGER;
BEGIN
    SELECT COUNT(*)::INTEGER INTO v_count
    FROM messages_v2
    WHERE recipient_id = p_recipient_id 
        AND message_type_id != 2
        AND is_system_message = FALSE
        AND is_archived = FALSE;
    RETURN v_count;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_total_number_of_archived_messages_v2_excluding_invitations_and_system_by_recipient_id(p_recipient_id BIGINT)
RETURNS INTEGER AS $$
DECLARE
    v_count INTEGER;
BEGIN
    SELECT COUNT(*)::INTEGER INTO v_count
    FROM messages_v2
    WHERE recipient_id = p_recipient_id 
        AND message_type_id != 2
        AND is_system_message = FALSE
        AND is_archived = TRUE;
    RETURN v_count;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_total_number_of_system_messages_v2_by_recipient_id(p_recipient_id BIGINT)
RETURNS INTEGER AS $$
DECLARE
    v_count INTEGER;
BEGIN
    SELECT COUNT(*)::INTEGER INTO v_count
    FROM messages_v2
    WHERE recipient_id = p_recipient_id 
        AND is_system_message = TRUE;
    RETURN v_count;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION messages_v2_get_total_number_of_sent_messages_v2_excluding_invitations_by_author_id(p_author_id BIGINT)
RETURNS INTEGER AS $$
DECLARE
    v_count INTEGER;
BEGIN
    SELECT COUNT(*)::INTEGER INTO v_count
    FROM messages_v2
    WHERE author_id = p_author_id 
        AND message_type_id != 2;
    RETURN v_count;
END;
$$ LANGUAGE plpgsql;

ALTER TABLE ONLY "public"."forums" ADD CONSTRAINT "forums_group_id_fkey" FOREIGN KEY (group_id) REFERENCES forum_groups(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."posts" ADD CONSTRAINT "posts_thread_id_fkey" FOREIGN KEY (thread_id) REFERENCES threads(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."posts" ADD CONSTRAINT "posts_user_id_fkey" FOREIGN KEY (user_id) REFERENCES users(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."promocode_redemptions" ADD CONSTRAINT "promocode_redemptions_promocode_id_fkey" FOREIGN KEY (promocode_id) REFERENCES promocodes(id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."threads" ADD CONSTRAINT "threads_forum_id_fkey" FOREIGN KEY (forum_id) REFERENCES forums(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."threads" ADD CONSTRAINT "threads_last_post_user_id_fkey" FOREIGN KEY (last_post_user_id) REFERENCES users(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."threads" ADD CONSTRAINT "threads_user_id_fkey" FOREIGN KEY (user_id) REFERENCES users(id) NOT DEFERRABLE;