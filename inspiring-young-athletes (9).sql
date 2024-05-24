-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2024 at 12:23 PM
-- Server version: 11.2.2-MariaDB
-- PHP Version: 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inspiring-young-athletes`
--

-- --------------------------------------------------------

--
-- Table structure for table `ask_question`
--

CREATE TABLE `ask_question` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `coachandatheletes` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ask_question`
--

INSERT INTO `ask_question` (`id`, `full_name`, `email`, `coachandatheletes`, `description`, `created_at`, `update_at`) VALUES
(1, 'Dave Turnbull', 'dave@tlimporters.com.au', 'Le Bron', 'Why are you so tall?', '2024-03-14 03:48:00', NULL),
(2, 'Phil', 'noreplyhere@aol.com', 'Phil Stewart', 'Hey, looking to boost your ad game? Picture your message hitting website contact forms worldwide, grabbing attention from potential customers everywhere! Starting at just under a hundred bucks my budget-friendly packages are designed to make an impact. Drop me an email now to discuss how you can get more leads and sales now!\r\n\r\nP. Stewart\r\nEmail: ms7qj6@gomail2.xyz\r\nSkype: live:.cid.2bc4ed65aa40fb3b', '2024-03-17 19:38:12', NULL),
(3, 'Mike Walter', 'mikeFek@gmail.com', 'Mike Walter', 'Hello \r\n \r\nThis is Mike Walter\r\n \r\nLet me show you our latest research results from our constant SEO feedbacks that we have from our plans: \r\n \r\nhttps://www.strictlydigital.net/product/semrush-backlinks/ \r\n \r\nThe new Semrush Backlinks, which will make your inspiringyoungathletes.com SEO trend have an immediate push. \r\nThe method is actually very simple, we are building links from domains that have a high number of keywords ranking for them.  \r\n \r\nForget about the SEO metrics or any other factors that so many tools try to teach you that is good. The most valuable link is the one that comes from a website that has a healthy trend and lots of ranking keywords. \r\nWe thought about that, so we have built this plan for you \r\n \r\nCheck in detail here: \r\nhttps://www.strictlydigital.net/product/semrush-backlinks/ \r\n \r\nCheap and effective \r\n \r\nTry it anytime soon \r\n \r\nRegards \r\nMike Walter\r\n \r\nmike@strictlydigital.net', '2024-03-18 07:49:07', NULL),
(4, 'Mike Dunce', 'mikeLelmAneree@gmail.com', 'Mike Dunce', 'Hi there, \r\n \r\nI have reviewed your domain in MOZ and have observed that you may benefit from an increase in authority. \r\n \r\nOur solution guarantees you a high-quality domain authority score within a period of three months. This will increase your organic visibility and strengthen your website authority, thus making it stronger against Google updates. \r\n \r\nCheck out our deals for more details. \r\nhttps://www.monkeydigital.co/domain-authority-plan/ \r\n \r\nNEW: Ahrefs Domain Rating \r\nhttps://www.monkeydigital.co/ahrefs-seo/ \r\n \r\n \r\nThanks and regards \r\nMike Dunce', '2024-03-21 02:39:17', NULL),
(5, 'James Durward', 'jamesdurward@emailcheka.com', 'James Durward', 'Greetings From Mr. James, \r\n \r\nI trust this message finds you well? We are an Investment Company offering Corporate and Personal Investment Funding at 4.5% Interest Rate for a duration of 5 to 10 Years depending on the kind of your project. \r\n \r\nWe also pay a 1% commission to brokers, who introduce project owners for finance or other opportunities. \r\n \r\nPlease get back to me if you are interested in more details via email:- jamesdurwardconsultant@gmail.com \r\n \r\nKind regards \r\n \r\nJames Durward \r\nFinance Partner \r\njamesdurwardconsultant@gmail.com', '2024-03-26 20:31:47', NULL),
(6, 'Mike Jacobson', 'mikeEnrifs@gmail.com', 'Mike Jacobson', 'Hi there, \r\n \r\nMy name is Mike from Monkey Digital, \r\n \r\nAllow me to present to you a lifetime revenue opportunity of 35% \r\nThat\'s right, you can earn 35% of every order made by your affiliate for life. \r\n \r\nSimply register with us, generate your affiliate links, and incorporate them on your website, and you are done. It takes only 5 minutes to set up everything, and the payouts are sent each month. \r\n \r\nClick here to enroll with us today: \r\nhttps://www.monkeydigital.org/affiliate-dashboard/ \r\n \r\nThink about it, \r\nEvery website owner requires the use of search engine optimization (SEO) for their website. This endeavor holds significant potential for both parties involved. \r\n \r\nThanks and regards \r\nMike Jacobson\r\n \r\nMonkey Digital', '2024-03-29 03:56:54', NULL),
(7, 'Mike Oswald', 'mikeLighemodomiGerne@gmail.com', 'Mike Oswald', 'This service is perfect for boosting your local business\' visibility on the map in a specific location. \r\n \r\nWe provide Google Maps listing management, optimization, and promotion services that cover everything needed to rank in the Google 3-Pack. \r\n \r\nMore info: \r\nhttps://www.speed-seo.net/ranking-in-the-maps-means-sales/ \r\n \r\n \r\nThanks and Regards \r\nMike Oswald\r\n \r\n \r\nPS: Want a ONE-TIME comprehensive local plan that covers everything? \r\nhttps://www.speed-seo.net/product/local-seo-bundle/', '2024-03-30 20:10:16', NULL),
(8, 'NATREGTEGH1525394NEWETREWT', 'sylvialarson1906@noissmail.com', 'NATREGTEGH1525394NEWETREWT', 'MERYTRH1525394MAWRERGTRH', '2024-04-01 09:51:18', NULL),
(9, 'Mike Gardner', 'mikeDymn@gmail.com', 'Mike Gardner', 'Hi there \r\n \r\nJust checked your inspiringyoungathletes.com baclink profile, I noticed a moderate percentage of toxic links pointing to your website \r\n \r\nWe will investigate each link for its toxicity and perform a professional clean up for you free of charge. \r\n \r\nStart recovering your ranks today: \r\nhttps://www.hilkom-digital.de/professional-linksprofile-clean-up-service/ \r\n \r\nRegards \r\nMike Gardner\r\nHilkom Digital SEO Experts \r\nhttps://www.hilkom-digital.de/', '2024-04-02 04:21:43', NULL),
(10, 'Phil', 'noreplyhere@aol.com', 'Phil Stewart', 'Interested in maximizing your reach? You\'re reading this message and I can get others to read your ad the exact same way! Drop me an email below to learn more about our services and start spreading your message effectively!\r\n\r\nPhil Stewart\r\nEmail: yyj4pg@mail-to-form.xyz\r\nSkype: form-blasting', '2024-04-04 04:50:11', NULL),
(11, 'Wilson', 'wilson.connell@googlemail.com', 'Wilson Connell', 'Get Found On The First Page of Google in Less Than 2 weeks by Using our Priority Stealth S.E.O. Syndication Method.\r\n\r\nPay us once and you\'ll get Organic Search Engine Results using videos that will continue to drive traffic 24/7 year round!\r\n \r\nThe Benefits are incredible - since by paying us once there will be:\r\n\r\n- No Additional Ad spend needed!\r\n\r\n- No Additional Costs for Ad copy!\r\n\r\n- No Additional Costs per Clicks!\r\n\r\n- No Commercial Licensing fees ever!\r\n\r\nGet Started Today and Get Seen Tomorrow!\r\n\r\nLearn More: Reviews2Videos.com', '2024-04-04 08:10:15', NULL),
(12, 'Dave Turnbull', 'dave@tlimporters.com.au', 'Le Bron', 'How tall are you?', '2024-04-06 06:29:25', NULL),
(13, 'Emily Jones', 'emilyjones2250@gmail.com', 'Emily Jones', 'Hi there,\r\n\r\nWe run a Youtube  growth service, where we can increase your subscriber count safely and practically. \r\n\r\n- Guaranteed: We guarantee to gain you 700-1500 new subscribers each month.\r\n- Real, human subscribers who subscribe because they are interested in your channel/videos.\r\n- Safe: All actions are done, without using any automated tasks / bots.\r\n\r\nOur price is just $60 (USD) per month and we can start immediately.\r\n\r\nWe also grow Instagram followers (300-1000 for $60).\r\n\r\nGet in touch if you would like to know more.\r\n\r\nKind Regards,\r\nEmily', '2024-04-07 22:58:58', NULL),
(14, 'Libby Evans', 'libbyevans461@gmail.com', 'Libby Evans', 'Hi there,\r\n\r\nWe run an Instagram growth service, which increases your number of followers both safely and practically. \r\n\r\n- We guarantee to gain you 300-1000+ followers per month.\r\n- People follow you because they are interested in you, increasing likes, comments and interaction.\r\n- All actions are made manually by our team. We do not use any \'bots\'.\r\n\r\nThe price is just $60 (USD) per month, and we can start immediately.\r\n\r\nIf you have any questions, let me know, and we can discuss further.\r\n\r\nKind Regards,\r\nLibby', '2024-04-09 00:50:07', NULL),
(15, 'Danielle Simpson', 'simpsondanielle800@gmail.com', 'Danielle Simpson', 'Hi,\r\n\r\nWe\'d like to introduce to you our explainer video service, which we feel can benefit your site inspiringyoungathletes.com.\r\n\r\nCheck out some of our existing videos here:\r\nhttps://www.youtube.com/watch?v=8S4l8_bgcnc\r\nhttps://www.youtube.com/watch?v=bWz-ELfJVEI\r\nhttps://www.youtube.com/watch?v=Y46aNG-Y3rM\r\nhttps://www.youtube.com/watch?v=hJCFX1AjHKk\r\n\r\nOur prices start from as little as $195 and include a professional script and voice-over.\r\n\r\nIf this is something you would like to discuss further, don\'t hesitate to reply.\r\n\r\nKind Regards,\r\nDanielle', '2024-04-09 14:32:16', NULL),
(16, 'Rachel Simpson', 'rachsimpson1972@gmail.com', 'Rachel Simpson', 'Hi,\r\n\r\nStruggling to find relevant websites accepting guest posts? We\'ve got you covered!\r\n\r\nWe\'ve compiled a premium list of over 4,000 high-quality websites and contacts – all personally verified to accept guest posts.\r\n\r\nBenefits:\r\n\r\n1. Expand your reach: Gain exposure to new audiences in your niche.\r\n2. Boost SEO: Build valuable backlinks to improve your website\'s ranking.\r\n3. Save time: No more scouring the web for guest post opportunities.\r\n\r\nThe list is conveniently categorized for easy browsing and immediate use.\r\n\r\nLearn more and download your copy here: https://furtherinfo.org/guestposts\r\n\r\nIf you not interested, simply delete this mail.\r\n\r\nThanks for your time,\r\nRachel', '2024-04-10 19:19:02', NULL),
(17, 'Mike Ellington', 'peterwraks@gmail.com', 'Mike Ellington', 'Howdy \r\n \r\nI have just analyzed  inspiringyoungathletes.com for  the current search visibility and saw that your website could use a push. \r\n \r\nWe will enhance your ranks organically and safely, using only state of the art AI and whitehat methods, while providing monthly reports and outstanding support. \r\n \r\nMore info: \r\nhttps://www.digital-x-press.com/unbeatable-seo/ \r\n \r\n \r\nRegards \r\nMike Ellington\r\n \r\nDigital X SEO Experts', '2024-04-12 00:01:28', NULL),
(18, 'marie', 'marie.lahousse@gmail.com', 'marie', 'Salut,\r\n\r\nJ\'ai retrouvé le lien du site dont j\'avais entendu parler dans la vidéo pour les BL pas chers, c\'est là : https://bit.ly/backlinkspaschers\r\n\r\nJ\'ai regardé deux trois vidéos et les retours semblent tous bons. Ton gars pourra regarder si ça lui va ou pas.\r\n\r\nBiz\r\n\r\nMarie', '2024-04-13 09:46:11', NULL),
(19, 'Mike Howard', 'mikeFek@gmail.com', 'Mike Howard', 'Hi \r\n \r\nThis is Mike Howard\r\n \r\nLet me show you our latest research results from our constant SEO feedbacks that we have from our plans: \r\n \r\nhttps://www.strictlydigital.net/product/semrush-backlinks/ \r\n \r\nThe new Semrush Backlinks, which will make your inspiringyoungathletes.com SEO trend have an immediate push. \r\nThe method is actually very simple, we are building links from domains that have a high number of keywords ranking for them.  \r\n \r\nForget about the SEO metrics or any other factors that so many tools try to teach you that is good. The most valuable link is the one that comes from a website that has a healthy trend and lots of ranking keywords. \r\nWe thought about that, so we have built this plan for you \r\n \r\nCheck in detail here: \r\nhttps://www.strictlydigital.net/product/semrush-backlinks/ \r\n \r\nCheap and effective \r\n \r\nTry it anytime soon \r\n \r\nRegards \r\nMike Howard\r\n \r\nmike@strictlydigital.net', '2024-04-16 09:59:09', NULL),
(20, 'Richardsix', 'yasen.krasen.13+82629@mail.ru', 'Richardsix', 'Odowidjwoidwo wojdwkslqmwjfbjjdwkd jkwlsqswknfbjwjdmkqendj kedwjdbwhbdqjswkdwjfj eqwkdwknf inspiringyoungathletes.com', '2024-04-16 23:11:48', NULL),
(21, 'best_hoSi', 'conmusicha1977@raiz-pr.com', 'best_hoSi', 'Lightweight Options \r\nEmergency Preparedness: The Best Solar Generator for Home Backup  \r\nsolar home backup generator <a href=https://olargener-ackup.com>https://olargener-ackup.com</a> .', '2024-04-19 13:09:16', NULL),
(22, 'Dora Verburen', 'doraverburen@gmail.com', 'Dora Verburen', 'Hi\r\n\r\nI was doing some research for my client. While browsing through your website, I ran into an issue accessing inspiringyoungathletes.com.\r\n\r\nI understand it can be difficult to maintain every aspect of a website.\r\n\r\nFor my own needs, I regularly turn to tools like https://websitecheckhealth.com to ensure I\'m getting the most out of my health-related websites. It offers a comprehensive report at no cost.\r\n\r\nIf you need any assistance in this area, feel free to reach out.\r\n\r\nWarm regards, Dora', '2024-04-20 13:28:17', NULL),
(23, 'Phil Stewart', 'noreplyhere@aol.com', 'Phil Stewart', 'Ready to blast your message across the digital universe? Just as you\'re engaging with this ad, imagine your brand message reaching countless website contact forms worldwide! Starting at just under $100, unlock the potential to reach 1 million forms. Reach out to me below for details\r\n\r\nP. Stewart\r\nEmail: h6x4pu@submitmaster.xyz\r\nSkype: form-blasting', '2024-04-21 01:06:06', NULL),
(24, 'Mike Enderson', 'mikeLelmAneree@gmail.com', 'Mike Enderson', 'Hi there, \r\n \r\nI have reviewed your domain in MOZ and have observed that you may benefit from an increase in authority. \r\n \r\nOur solution guarantees you a high-quality domain authority score within a period of three months. This will increase your organic visibility and strengthen your website authority, thus making it stronger against Google updates. \r\n \r\nCheck out our deals for more details. \r\nhttps://www.monkeydigital.co/domain-authority-plan/ \r\n \r\nNEW: Ahrefs Domain Rating \r\nhttps://www.monkeydigital.co/ahrefs-seo/ \r\n \r\n \r\nThanks and regards \r\nMike Enderson', '2024-04-21 02:29:16', NULL),
(25, 'Mike Adrian', 'mikeLighemodomiGerne@gmail.com', 'Mike Adrian', 'This service is perfect for boosting your local business\' visibility on the map in a specific location. \r\n \r\nWe provide Google Maps listing management, optimization, and promotion services that cover everything needed to rank in the Google 3-Pack. \r\n \r\nMore info: \r\nhttps://www.speed-seo.net/ranking-in-the-maps-means-sales/ \r\n \r\n \r\nThanks and Regards \r\nMike Adrian\r\n \r\n \r\nPS: Want a ONE-TIME comprehensive local plan that covers everything? \r\nhttps://www.speed-seo.net/product/local-seo-bundle/', '2024-04-22 11:29:20', NULL),
(26, 'Mike Kennett', 'mikeEnrifs@gmail.com', 'Mike Kennett', 'Hi there, \r\n \r\nMy name is Mike from Monkey Digital, \r\n \r\nAllow me to present to you a lifetime revenue opportunity of 35% \r\nThat\'s right, you can earn 35% of every order made by your affiliate for life. \r\n \r\nSimply register with us, generate your affiliate links, and incorporate them on your website, and you are done. It takes only 5 minutes to set up everything, and the payouts are sent each month. \r\n \r\nClick here to enroll with us today: \r\nhttps://www.monkeydigital.org/affiliate-dashboard/ \r\n \r\nThink about it, \r\nEvery website owner requires the use of search engine optimization (SEO) for their website. This endeavor holds significant potential for both parties involved. \r\n \r\nThanks and regards \r\nMike Kennett\r\n \r\nMonkey Digital', '2024-04-24 12:04:50', NULL),
(27, 'Mike Waller', 'mikeDymn@gmail.com', 'Mike Waller', 'Hi there \r\n \r\nJust checked your inspiringyoungathletes.com baclink profile, I noticed a moderate percentage of toxic links pointing to your website \r\n \r\nWe will investigate each link for its toxicity and perform a professional clean up for you free of charge. \r\n \r\nStart recovering your ranks today: \r\nhttps://www.hilkom-digital.de/professional-linksprofile-clean-up-service/ \r\n \r\nRegards \r\nMike Waller\r\nHilkom Digital SEO Experts \r\nhttps://www.hilkom-digital.de/', '2024-05-02 10:51:29', NULL),
(28, 'Pillsrip', 'iunskiygipertonik@gmail.com', 'Pillsrip', 'Erectile dysfunction treatments available online from TruePills. \r\nDiscreet, next day delivery and lowest price guarantee. \r\n \r\nViagra is a well-known, branded and common erectile dysfunction (ED) treatment for men. \r\nIt\'s available through our Online TruePills service. \r\n \r\nTrial ED Pack consists of the following ED drugs: \r\n \r\nViagra Active Ingredient: Sildenafil 100mg 5 pills \r\nCialis 20mg 5 pills \r\nLevitra 20mg 5 pills \r\n \r\nhttps://cutt.ly/dw7ChH4s \r\nhttp://vgg.ermis.su/bitrix/redirect.php?goto=https://true-pill.top/\r\nhttp://alt1.toolbarqueries.google.hu/url?q=https://true-pill.top/\r\nhttps://zol-kino.ru/redirect?url=https://true-pill.top/\r\nhttps://allpremial.ru/bitrix/redirect.php?goto=https://true-pill.top/\r\nhttps://silkyline.ru/bitrix/redirect.php?goto=https://true-pill.top/\r\n \r\n \r\nRoaccutane\r\nPiglitazone\r\nBenostan\r\nZerlin\r\nKlamaxin\r\nLanzap\r\nNeodex\r\nZymoplex\r\nPantobex\r\nIsoskin\r\nClaritrox\r\nLevitra Professional\r\nUniklar\r\nFurotabs\r\nErythra-derm\r\nKanprim\r\nSelan\r\nRofex\r\nEstreva\r\nFenytoin dak\r\nOgast\r\nDiapresan\r\nCardace comp\r\nMinostad\r\nDeponit\r\nAlerviden\r\nReliveran\r\nIzra\r\nTopicil\r\nParkinel\r\nFramycort\r\nOmind\r\nZantic\r\nPhysma\r\nKetolex\r\nZilopur\r\nRetinide\r\nNatrii pantoprazolum\r\nAmlopres\r\nRidamin', '2024-05-04 20:31:09', NULL),
(29, 'Mike Ramacey', 'peterwraks@gmail.com', 'Mike Ramacey', 'Hello \r\n \r\nI have just verified your SEO on  inspiringyoungathletes.com for  the current search visibility and saw that your website could use a push. \r\n \r\nWe will increase your ranks organically and safely, using only state of the art AI and whitehat methods, while providing monthly reports and outstanding support. \r\n \r\nMore info: \r\nhttps://www.digital-x-press.com/unbeatable-seo/ \r\n \r\n \r\nRegards \r\nMike Ramacey\r\n \r\nDigital X SEO Experts', '2024-05-07 00:50:01', NULL),
(30, 'Mike Foster', 'peterwraks@gmail.com', 'Mike Foster', 'Hi there \r\n \r\nAre you tired of spending money on advertising that doesn’t work? \r\nWe have the right strategy for you, to meet the right audience within your City boundaries. \r\n \r\nB2B Local City Marketing that works: \r\nhttps://www.onlinelocalmarketing.org/product/local-research-advertising/ \r\n \r\nWith our innovative marketing approach, you will receive calls, leads, and website interactions within a week. \r\n \r\nRegards \r\nMike Foster\r\n https://www.onlinelocalmarketing.org', '2024-05-07 10:02:57', NULL),
(31, 'Mike Lewis', 'mikeFek@gmail.com', 'Mike Lewis', 'Hi there \r\n \r\nThis is Mike Lewis\r\n \r\nLet me introduce to you our latest research results from our constant SEO feedbacks that we have from our plans: \r\n \r\nhttps://www.strictlydigital.net/product/semrush-backlinks/ \r\n \r\nThe new Semrush Backlinks, which will make your inspiringyoungathletes.com SEO trend have an immediate push. \r\nThe method is actually very simple, we are building links from domains that have a high number of keywords ranking for them.  \r\n \r\nForget about the SEO metrics or any other factors that so many tools try to teach you that is good. The most valuable link is the one that comes from a website that has a healthy trend and lots of ranking keywords. \r\nWe thought about that, so we have built this plan for you \r\n \r\nCheck in detail here: \r\nhttps://www.strictlydigital.net/product/semrush-backlinks/ \r\n \r\nCheap and effective \r\n \r\nTry it anytime soon \r\n \r\nRegards \r\nMike Lewis\r\n \r\nmike@strictlydigital.net', '2024-05-15 05:21:03', NULL),
(32, 'Mike Campbell', 'mikeLelmAneree@gmail.com', 'Mike Campbell', 'Hi there, \r\n \r\nI have reviewed your domain in MOZ and have observed that you may benefit from an increase in authority. \r\n \r\nOur solution guarantees you a high-quality domain authority score within a period of three months. This will increase your organic visibility and strengthen your website authority, thus making it stronger against Google updates. \r\n \r\nCheck out our deals for more details. \r\nhttps://www.monkeydigital.co/domain-authority-plan/ \r\n \r\nNEW: Ahrefs Domain Rating \r\nhttps://www.monkeydigital.co/ahrefs-seo/ \r\n \r\n \r\nThanks and regards \r\nMike Campbell', '2024-05-16 05:15:54', NULL),
(33, 'Ronaldtrupe', 'crypto.adviser00004@gmail.com', 'Ronaldtrupe', 'Hi, I\'m Michael Yoshioka from Crypto Adviser LTD. Here\'s a wallet & debit card for cryptocurrencies. Use your crypto assets more easily with this. \r\n \r\nRedotPay WALLET: \r\nRedotPay partners with Binance, offering a popular wallet & VISA debit card. Pay directly with crypto. Apply for the card by installing the wallet app from the URL, App Store, or Google Play. \r\n \r\nWallet Fee: Free \r\nCard Fee: Virtual VISA $5 / Physical VISA $100 \r\nURL: https://redotpay.cards/register/ \r\n \r\nOCTPASS WALLET: \r\nJDB Bank, Laos\'s largest private bank, partners with the \"Octopus\" wallet. Apply for a VISA debit cash card. Withdraw cash from ATMs and make international transfers. \r\n \r\nWallet Fee: Free \r\nBank Account Fee: $800 ($300 deposit) \r\nURL: https://laos-bank.jp/en/ \r\n \r\nUse these cards at VISA stores worldwide. Get an affiliate account by applying from the URLs above. \r\n \r\nAffiliate rewards: Up to $40/card + up to 0.25% fee for RedotPay, and up to $150/card for JDB Bank. \r\n \r\nFor questions, contact: \r\n \r\nCrypto Adviser LTD \r\nMichael Yoshioka \r\nE-mail: info@crypto-adviser.co', '2024-05-18 10:05:25', NULL),
(34, 'Mike Hardman', 'mikeEnrifs@gmail.com', 'Mike Hardman', 'Hi there, \r\n \r\nMy name is Mike from Monkey Digital, \r\n \r\nAllow me to present to you a lifetime revenue opportunity of 35% \r\nThat\'s right, you can earn 35% of every order made by your affiliate for life. \r\n \r\nSimply register with us, generate your affiliate links, and incorporate them on your website, and you are done. It takes only 5 minutes to set up everything, and the payouts are sent each month. \r\n \r\nClick here to enroll with us today: \r\nhttps://www.monkeydigital.org/affiliate-dashboard/ \r\n \r\nThink about it, \r\nEvery website owner requires the use of search engine optimization (SEO) for their website. This endeavor holds significant potential for both parties involved. \r\n \r\nThanks and regards \r\nMike Hardman\r\n \r\nMonkey Digital', '2024-05-21 03:11:32', NULL),
(35, 'Georgina Haynes', 'georginahaynes620@gmail.com', 'Georgina Haynes', 'Hi,\r\n\r\nI just visited inspiringyoungathletes.com and wondered if you\'d ever thought about having an engaging video to explain what you do?\r\n\r\nOur prices start from just $195.\r\n\r\nLet me know if you\'re interested in seeing samples of our previous work.\r\n\r\nRegards,\r\nGeorgina\r\n\r\nUnsubscribe: https://removeme.click/ev/unsubscribe.php?d=inspiringyoungathletes.com', '2024-05-22 07:01:50', NULL),
(36, 'Mike Fitzgerald', 'mikeLighemodomiGerne@gmail.com', 'Mike Fitzgerald', 'This service is perfect for boosting your local business\' visibility on the map in a specific location. \r\n \r\nWe provide Google Maps listing management, optimization, and promotion services that cover everything needed to rank in the Google 3-Pack. \r\n \r\nMore info: \r\nhttps://www.speed-seo.net/ranking-in-the-maps-means-sales/ \r\n \r\nWhatsapp us: https://wa.link/t9gzao \r\n \r\n \r\nThanks and Regards \r\nMike Fitzgerald\r\n \r\nPS: Want a ONE-TIME comprehensive local plan that covers everything? \r\nhttps://www.speed-seo.net/product/local-seo-bundle/', '2024-05-23 14:38:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `category_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`, `category_status`, `created_at`, `updated_at`, `deleted_at`, `category_slug`) VALUES
(1, 'Football', 'categories/football.svg', '1', NULL, NULL, NULL, 'football'),
(2, 'Swimming', 'categories/swimming.svg', '1', NULL, NULL, NULL, 'swimming'),
(3, 'AFL', 'categories/afl.svg', '1', NULL, NULL, NULL, 'afl'),
(4, 'Rugby', 'categories/rugby.svg', '1', NULL, NULL, NULL, 'rugby'),
(5, 'Golf', 'categories/golf.svg', '1', NULL, NULL, NULL, 'golf'),
(6, 'Motor Sport', 'categories/motor-sport.svg', '1', NULL, NULL, NULL, 'motor-sport'),
(7, 'Surfing', 'categories/surfing.svg', '1', NULL, NULL, NULL, 'surfing'),
(8, 'Cricket', 'categories/cricket.svg', '1', NULL, NULL, NULL, 'cricket'),
(9, 'Basketball', 'categories/basketball.svg', '1', NULL, NULL, NULL, 'basketball'),
(10, 'Cycling', 'categories/cycling.svg', '1', NULL, NULL, NULL, 'cycling'),
(11, 'Athletics', 'categories/athletics.svg', '1', NULL, NULL, NULL, 'athletics'),
(12, 'Canoeing', 'categories/canoeing.svg', '1', NULL, NULL, NULL, 'canoeing'),
(13, 'Para sport', 'categories/para-sport.svg', '1', NULL, NULL, NULL, 'para-sport'),
(14, 'Skate', 'categories/skateboard.svg', '1', NULL, NULL, NULL, 'skate'),
(15, 'Tennis', 'categories/tennis.svg', '1', NULL, NULL, NULL, 'tennis'),
(16, 'Field Hockey', 'categories/field-hockey.svg', '1', NULL, NULL, NULL, 'field-hockey'),
(17, 'Winter Olympics', 'categories/winter-olympics.svg', '1', NULL, NULL, NULL, 'winter-olympics'),
(18, 'Summer Olympics', 'categories/summer-olympics.svg', '1', NULL, NULL, NULL, 'summer-olympics'),
(19, 'NFL', 'categories/nfl.svg', '1', NULL, NULL, NULL, 'nfl'),
(20, 'Baseball', 'categories/baseball.svg', '1', NULL, NULL, NULL, 'baseball'),
(21, 'Ice Hockey', 'categories/ice-hockey.svg', '1', NULL, NULL, NULL, 'ice-hockey'),
(22, 'Netball', 'categories/netball.svg', '1', NULL, NULL, NULL, 'netball'),
(23, 'Triathlon', 'categories/Triathlon.svg', '1', NULL, NULL, NULL, 'triathlon'),
(24, 'Surf Lifesaving', 'categories/Surf Lifesaving.svg', '1', NULL, NULL, NULL, 'surf-lifesaving'),
(25, 'Boxing/MMA', 'categories/gloves.svg', '1', NULL, NULL, NULL, 'boxing-mma');

-- --------------------------------------------------------

--
-- Table structure for table `contact-us`
--

CREATE TABLE `contact-us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `organisation` varchar(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'What inspirational content can I expect on the website?', 'Every athlete has an inspirational story behind their success and our mission is to have over 300 athletes on board within 2 years', '2024-02-29 03:52:08', '2024-02-29 04:04:56', NULL),
(3, 'Are there success stories of young athletes overcoming obstacles?', 'Some of our professional athletes are still fairly young athletes but all our athletes have overcome obstacles at some stage in their journey.', '2024-02-29 10:09:38', '2024-02-29 10:09:38', NULL),
(4, 'Do you provide tips for balancing academics and sports for young athletes?', 'If this is not one of the questions asked online, we do have an ‘ask a question to an athlete’ button on the page where your question will be sent to a specific  athlete that you may want to ask it to and if time allows, they may answer it for you.', '2024-02-29 10:09:56', '2024-02-29 10:09:56', NULL),
(5, 'Are there exclusive features or interviews with professional athletes and coaches?', 'Every athlete or coach is asked 8 questions to activate their profile and after that can give any advice after that. They can download unlimited videos with advice.', '2024-02-29 10:10:18', '2024-02-29 10:10:18', NULL),
(6, 'How can young athletes benefit from joining the community or forum on the site?', 'Aspiring Young Athletes would have unlimited resources to choose from seeing athletes from numerous sporting codes talk each answering a minimum of 8 questions from their journey through their teen years so the benefits are immense.', '2024-02-29 10:10:36', '2024-02-29 10:10:36', NULL),
(7, 'Do you offer training resources and workout plans for specific sports?', 'Unfortunately, we don’t offer training plans as each athlete is different and this would need to be advised by a specialist coach or mentor who understand that athlete.', '2024-02-29 10:10:56', '2024-02-29 10:10:56', NULL),
(8, 'gfdg', 'dfgfdg', '2024-03-06 11:03:09', '2024-03-08 11:09:28', '2024-03-08 11:09:28'),
(9, 'asas', NULL, '2024-03-08 11:09:35', '2024-03-08 11:09:44', '2024-03-08 11:09:44'),
(10, NULL, NULL, '2024-03-08 11:09:52', '2024-03-08 11:09:55', '2024-03-08 11:09:55'),
(11, NULL, NULL, '2024-03-08 11:57:33', '2024-03-08 11:57:38', '2024-03-08 11:57:38'),
(12, 'htj', 'ghjghjhg', '2024-04-04 06:44:41', '2024-04-04 06:44:48', '2024-04-04 06:44:48'),
(13, 'qwqw', 'qw', '2024-04-04 06:48:32', '2024-04-04 06:48:37', '2024-04-04 06:48:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_04_064117_create_category', 1),
(6, '2024_01_04_070455_add_slug_to_category', 1),
(7, '2024_01_04_114624_create_role', 1),
(8, '2024_01_04_121455_add_fields_to_users', 1),
(9, '2024_01_04_122711_add_category_to_users', 1),
(10, '2024_01_05_055900_add_feilds_to_users', 2),
(11, '2024_01_08_102441_create_question', 2),
(12, '2024_01_09_104732_add_feilds_to_users', 3),
(13, '2024_01_09_111525_create_user_queston', 4),
(14, '2024_01_11_091819_add_profile_to_users_table', 5),
(15, '2024_01_11_125158_create_vedio', 6);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `created_at`, `updated_at`) VALUES
(0, NULL, '2024-04-11 05:45:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('abhishek10@mailinator.com', 'B0UeznWkFlEiHA3jIHYvoLHd1IlNWEjcmxxH5zajfDSvrRWRl43RygoU88Vc7yDu', '2024-04-12 11:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `payout`
--

CREATE TABLE `payout` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `year` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `name` varchar(400) DEFAULT NULL,
  `duration` enum('yearly','monthly') DEFAULT 'monthly',
  `plan` varchar(400) DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `apple_plan_id` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `duration`, `plan`, `price`, `apple_plan_id`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'basic plan', 'monthly', 'price_1P14DeG802RDia5tQ35GuvAt', 3.95, 'Monthly1', 'Perfect for an individual financial advisor', 0, '2023-06-06 08:11:45', '2023-06-06 08:11:45', NULL),
(2, 'basic plan', 'monthly', 'price_1P14EkG802RDia5tVkvtfT5e', 3.95, 'Monthly1', 'Perfect for an individual financial advisor', 1, '2023-06-06 08:11:45', '2023-06-06 08:11:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `question_type` enum('for_athletes','for_parents','for_athletes_coaches','for_friday_frenzy','for_coaches') NOT NULL DEFAULT 'for_athletes',
  `question` text NOT NULL,
  `question_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `question_type`, `question`, `question_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'for_athletes', 'What was the best advice you were ever given?', '1', NULL, NULL, NULL),
(2, 'for_athletes', 'Did you play multi sports, if so, what sports? Do you believe in young kids playing multiple sports and if so what and at what age did you start to specialise?', '1', NULL, NULL, NULL),
(3, 'for_athletes', 'Given the mental game and pressure put on young kids with social media, what advice would you give kids of today for mental strength?', '1', NULL, NULL, NULL),
(4, 'for_athletes', 'If you could go back in time, what would you do differently or change in regards to prep/training/down time/mobility/maintenance/nutrition etc?', '1', NULL, NULL, NULL),
(5, 'for_athletes', 'What is your most important pre-game routine?', '1', NULL, NULL, NULL),
(6, 'for_athletes', 'What did you do differently to those around you as a teenager to make your dreams come true ?', '1', NULL, NULL, NULL),
(7, 'for_athletes', 'Knowing what you know now about nutrition, sports psychology, stretching and breathing techniques, when did you start doing these things and what value do they add? In a perfect world, when should young athletes start doing these things?', '1', NULL, NULL, NULL),
(8, 'for_athletes', 'As a teenager did you play sport all year round or did you have down time and if down time, what did you do in that time? Knowing what you know now, would you have had more downtime in your younger years?', '1', NULL, NULL, NULL),
(9, 'for_athletes', 'What was your biggest set-back and how did you overcome it?', '1', NULL, NULL, NULL),
(10, 'for_athletes', 'What was the hardest moment for you as a young athlete that made you really question yourself if you wanted to go pro or walk away (we want to show kids just how hard it can be)', '1', NULL, NULL, NULL),
(11, 'for_athletes', 'What would you tell your teen self, knowing what you know?', '1', NULL, NULL, NULL),
(12, 'for_athletes', 'What bad habits do you look back on and wish you could change?', '1', NULL, NULL, NULL),
(13, 'for_athletes', 'Did you ever consider quitting and if so, why and how did you overcome that?', '1', NULL, NULL, NULL),
(14, 'for_athletes', 'What was your dream as a young child sports wise?', '1', NULL, NULL, NULL),
(15, 'for_athletes', 'Did you always play sport in your own age or did you always compete in age groups higher than your own and what advice would you give on this?', '1', NULL, NULL, NULL),
(16, 'for_athletes', 'At what age did you start laying out goals and a weekly planner. What did your weekly planner look like in your early teens?', '1', NULL, NULL, NULL),
(17, 'for_athletes', 'How did you balance school work, social and training?', '1', NULL, NULL, NULL),
(18, 'for_athletes', 'How do you structure your training sessions to maximize performance?', '1', NULL, NULL, NULL),
(19, 'for_athletes', 'Are there specific drills or exercises you find particularly beneficial for your sport?', '1', NULL, NULL, NULL),
(20, 'for_athletes', 'How do you balance strength training, endurance, and skill development in your routine?', '1', NULL, NULL, NULL),
(21, 'for_athletes', 'How do you stay focused and maintain a positive mindset, especially during challenging times?', '1', NULL, NULL, NULL),
(22, 'for_athletes', 'What mental strategies do you use to overcome pressure and perform your best in high-stakes situations?', '1', NULL, NULL, NULL),
(23, 'for_athletes', 'How did you handle setbacks or injuries and bounce back stronger', '1', NULL, NULL, NULL),
(24, 'for_athletes', 'What role does nutrition play in your performance and do you follow a specific diet? Is your calorie intake different on game day versus training days?', '1', NULL, NULL, NULL),
(25, 'for_athletes', 'How did you work out what was your optimum calories needed to perform at your best in your teen years?', '1', NULL, NULL, NULL),
(26, 'for_athletes', 'How do you prioritize recovery, and what recovery techniques have you found most effective?', '1', NULL, NULL, NULL),
(27, 'for_athletes', 'Are there any specific habits or rituals you follow to ensure optimal physical well-being?', '1', NULL, NULL, NULL),
(28, 'for_athletes', 'How did you navigate the pathway from amateur to professional sports?', '1', NULL, NULL, NULL),
(29, 'for_athletes', 'How do you handle pre-game nerves or anxiety?', '1', NULL, NULL, NULL),
(30, 'for_athletes', 'What is your approach to analyzing opponents and adapting your game plan?', '1', NULL, NULL, NULL),
(31, 'for_athletes', 'Can you share any memorable experiences from your most challenging or rewarding competitions?', '1', NULL, NULL, NULL),
(32, 'for_athletes', 'How do you contribute to team cohesion and foster a positive team culture?', '1', NULL, NULL, NULL),
(33, 'for_athletes', 'What leadership qualities do you think are crucial for success in team sports?', '1', NULL, NULL, NULL),
(34, 'for_athletes', 'How do you handle conflicts or disagreements within the team?', '1', NULL, NULL, NULL),
(35, 'for_athletes', 'How do you maintain a high level of performance over the course of your career?', '1', NULL, NULL, NULL),
(36, 'for_athletes', 'What steps do you take to prevent burnout and ensure the sustainability of your athletic career?', '1', NULL, NULL, NULL),
(37, 'for_athletes', 'Are there lifestyle choices you believe contribute to long-term success in sports?', '1', NULL, NULL, NULL),
(38, 'for_athletes', 'How do you approach the off-season in terms of rest, reflection, and improvement?', '1', NULL, NULL, NULL),
(39, 'for_athletes', 'How do you set and prioritize your goals for the upcoming season?', '1', NULL, NULL, NULL),
(40, 'for_athletes', 'What advice do you have for young athletes in setting realistic and achievable goals?', '1', NULL, NULL, NULL),
(41, 'for_parents', 'What would you say to parents of talented young kids based on your learnings with your child?', '1', NULL, NULL, NULL),
(42, 'for_parents', 'What do you think you got right or wrong as a parent of an professional athlete?', '1', NULL, NULL, NULL),
(43, 'for_parents', 'What made your child stand out as a teenage athlete, what did they do differently to other kids?', '1', NULL, NULL, NULL),
(44, 'for_athletes_coaches', 'What was this athlete like as a teenager to coach and what made them different to the other kids you coached? What do you think was their biggest asset allowing them to go pro?', '1', NULL, NULL, NULL),
(45, 'for_friday_frenzy', 'We need a 30 second clip to tell kids what your advice is going into a weekend of matches (whatever that might be). What advice would you give for game day in 30 seconds.', '1', NULL, NULL, NULL),
(46, 'for_coaches', 'What factors influence your decisions during a game, such as substitutions or tactical adjustments?', '1', NULL, NULL, NULL),
(47, 'for_coaches', 'How do you provide constructive feedback to players to help them improve?', '1', NULL, NULL, NULL),
(48, 'for_coaches', 'What role do you see parents playing in the overall success of young athletes?', '1', NULL, NULL, NULL),
(49, 'for_coaches', 'How do you work with players to develop mental toughness and resilience?', '1', NULL, NULL, NULL),
(50, 'for_coaches', 'What qualities do you look for in team leaders, and how do you nurture leadership skills within the squad?', '1', NULL, NULL, NULL),
(51, 'for_coaches', 'How can parent’s best support their child\'s athletic development without adding unnecessary pressure?', '1', NULL, NULL, NULL),
(52, 'for_coaches', 'How do you balance the demands of training and competition with the need for rest and recovery?', '1', NULL, NULL, NULL),
(53, 'for_coaches', 'How can athletes make the most of their time in youth and amateur levels to prepare for higher levels of competition?', '1', NULL, NULL, NULL),
(54, 'for_coaches', 'Are there specific drills or exercises you find particularly effective for skill development?', '1', NULL, NULL, NULL),
(55, 'for_coaches', 'How can parents support their child\'s aspirations while maintaining a healthy perspective on the journey?', '1', NULL, NULL, NULL),
(56, 'for_coaches', 'How do you help athletes manage the pressure and expectations of competition?', '1', NULL, NULL, NULL),
(58, 'for_coaches', 'What would you tell a good teen athlete from a coaching perspective?', '1', NULL, NULL, NULL),
(59, 'for_coaches', 'What is the best advice you would give to a young sports person?', '1', NULL, NULL, NULL),
(60, 'for_coaches', 'Would you encourage playing multi sports, if so, why? At what age would you advise they start to specialise?', '1', NULL, NULL, NULL),
(61, 'for_coaches', 'Given the mental game and pressure put on young kids with social media, what advice would you give kids of today for mental strength?', '1', NULL, NULL, NULL),
(62, 'for_coaches', 'What advice would you give to parents of talented young kids based on what you see as being ‘right’ or ‘wrong’?', '1', NULL, NULL, NULL),
(63, 'for_coaches', 'What would you say to kids considering quitting when the chips are down?', '1', NULL, NULL, NULL),
(64, 'for_coaches', 'What are some of the best pre-game routines you could recommend?', '1', NULL, NULL, NULL),
(65, 'for_coaches', 'What should kids do differently to those around them as teenager athletes to make their dreams come true?', '1', NULL, NULL, NULL),
(66, 'for_coaches', 'Knowing what you know now about nutrition, sports psychology, stretching and breathing techniques, when would you advise kids to start doing these things and what value do they add? In a perfect world, when should young athletes start doing these things?', '1', NULL, NULL, NULL),
(67, 'for_coaches', 'Would you advocate time off per season for young athletes and if so, how much?', '1', NULL, NULL, NULL),
(68, 'for_coaches', 'What are your best training tips for aspiring young athletes, if there is one or two stand out tips you would push as basics specific to the sport you coach?', '1', NULL, NULL, NULL),
(69, 'for_coaches', 'Would you advise talented young athletes to play in their own age group or play up a year or two where possible? What are the pro’s and cons in your sport?', '1', NULL, NULL, NULL),
(70, 'for_coaches', 'What is your coaching philosophy, and how does it shape your approach to training and competition?', '1', NULL, NULL, '0000-00-00 00:00:00'),
(71, 'for_coaches', 'What role does team chemistry play in achieving success, and how do you build and maintain it?', '1', NULL, NULL, NULL),
(72, 'for_coaches', 'What advice do you have for young athletes aspiring to pursue a career in the sport?', '1', NULL, NULL, NULL),
(73, 'for_coaches', 'How do you balance the development of individual skills with team dynamics and strategy?', '1', NULL, NULL, NULL),
(74, 'for_coaches', 'Are there specific habits or traits you believe contribute to long-term success in sports?', '1', NULL, NULL, NULL),
(75, 'for_athletes', '<b>Female athletes only</b> - how did you deal with puberty/menstrual cycle and sport when you were a teenager? What advice would you give young girls coming into this stage of their lives and possibly being embarrassed by it?', '1', NULL, NULL, NULL),
(76, 'for_athletes', '<b>Female athletes only</b> - how did you manage your energy levels during your menstrual cycle and what were the benefits of exercising through period pain or which exercises best suited different stages of the cycle', '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `referralhistory`
--

CREATE TABLE `referralhistory` (
  `id` int(11) NOT NULL,
  `referral_by` int(11) NOT NULL,
  `referral_to` varchar(255) NOT NULL,
  `status` enum('accepted','pending') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2024-01-04 06:27:58', NULL, NULL),
(2, 'User', '2024-01-03 13:00:00', NULL, NULL),
(3, 'Athlete', '2024-01-05 06:28:54', NULL, NULL),
(4, 'Coach', '2024-01-05 13:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `stripe_status` varchar(255) NOT NULL,
  `stripe_price` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `stripe_product` varchar(255) NOT NULL,
  `stripe_price` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `transaction_type` enum('payout','subscription') DEFAULT 'payout',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roles` varchar(255) NOT NULL,
  `referral_by` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `category` bigint(20) NOT NULL DEFAULT 0,
  `user_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1 => Active',
  `quetion_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1 => Active',
  `stripe_connect_id` varchar(255) DEFAULT NULL,
  `stripe_account_status` int(11) NOT NULL DEFAULT 0,
  `profile` varchar(255) DEFAULT NULL,
  `referral_token` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `stripe_id` varchar(255) DEFAULT NULL,
  `pm_type` varchar(255) DEFAULT NULL,
  `pm_last_four` varchar(4) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roles`, `referral_by`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `phone`, `category`, `user_status`, `quetion_status`, `stripe_connect_id`, `stripe_account_status`, `profile`, `referral_token`, `linkedin`, `tiktok`, `instagram`, `facebook`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
(1, 'Admin', 0, 'Admin', 'admin@inspiringyoungathletes.com', NULL, '$2y$12$dtZhQA9P0torl04ld2Y9VebIw4G7SEZX.lXGoJM6d3xMuIgUjZFqe', NULL, '2024-02-19 06:47:02', '2024-04-04 06:50:19', NULL, '1234567890', 0, '1', '0', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 'Athlete', 0, 'Shannon Eckstein', 'Shannon@iya.com', '2024-04-15 21:36:53', '$2y$12$7ag/K/npv5GF.o4TMxdALeIUmmzTtxEjAdcVMzA4a4J00X69CPONy', NULL, '2024-04-15 21:36:53', '2024-04-25 09:44:52', NULL, '0123456789', 24, '1', '1', NULL, 0, 'storage/user/104/profile/1714038292.jpg', 'JP5yQN9EiF', NULL, NULL, NULL, NULL, 'cus_PwNQcVK9jmgTYb', NULL, NULL, NULL),
(105, 'Athlete', 0, 'Chad Le Clos', 'Chad@iya.com', '2024-04-16 20:46:58', '$2y$12$gXzhBLBa6PQTiwiyyd4mkO0zwk7JzZdu7MgSmfhQRKidWQufs415S', NULL, '2024-04-16 20:46:58', '2024-04-28 01:01:18', NULL, '1122334455', 2, '1', '1', NULL, 0, 'storage/user/105/profile/1714030692.jpg', 'm0oWMwhed8', NULL, NULL, 'https://www.instagram.com/chadleclos92', NULL, 'cus_PwCFDPAtDem1ad', NULL, NULL, NULL),
(108, 'Athlete', 0, 'Johan Botha', 'Johan@iya.com', '2024-04-25 07:43:10', '$2y$12$DxK3yvoGUsA.N8AEuz1xm.6Yq1mJ0TY8GfYN98d1uAAlfY7hTEnbC', NULL, '2024-04-25 07:43:10', '2024-04-25 08:13:52', NULL, '1234543210', 8, '1', '1', NULL, 0, 'storage/user/108/profile/1714032733.jpg', 'eZA5BiaNLJ', NULL, NULL, 'https://www.instagram.com/johanb22', NULL, NULL, NULL, NULL, NULL),
(109, 'Athlete', 0, 'Trevor Hendy', 'trevor@iya.com', '2024-04-25 08:15:20', '$2y$12$15jwurVIQIeLE8Mp10C4Euo37m49TWRVwRYbXsQ4c8nJ61ZJwWMia', NULL, '2024-04-25 08:15:20', '2024-04-25 08:30:24', NULL, '9876545678', 24, '1', '1', NULL, 0, 'storage/user/109/profile/1714033824.jpg', 'sFj85xfGIh', NULL, NULL, 'https://www.instagram.com/hendytrev', NULL, NULL, NULL, NULL, NULL),
(110, 'Coach', 0, 'Justin Holbrook', 'Justin@iya.com', '2024-04-25 08:32:36', '$2y$12$Cr40XrnqBKoMGLgjcHHPH.BJhHHA4eSZ3kfOVVPgCfaIkOuJxGR5a', NULL, '2024-04-25 08:32:36', '2024-04-25 08:42:02', NULL, '1472583690', 4, '1', '1', NULL, 0, 'storage/user/110/profile/1714034522.jpg', 'DJAjISi0pU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_incomes`
--

CREATE TABLE `user_incomes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `videorevenue` double(8,2) NOT NULL DEFAULT 0.00,
  `referralrevenue` double(8,2) NOT NULL DEFAULT 0.00,
  `month` varchar(255) DEFAULT NULL,
  `years` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_incomes`
--

INSERT INTO `user_incomes` (`id`, `user_id`, `videorevenue`, `referralrevenue`, `month`, `years`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 104, 0.00, 0.00, 'May', 2024, '2024-05-01 09:00:02', '2024-05-01 09:00:02', NULL),
(2, 105, 0.00, 0.00, 'May', 2024, '2024-05-01 09:00:02', '2024-05-01 09:00:02', NULL),
(3, 108, 0.00, 0.00, 'May', 2024, '2024-05-01 09:00:02', '2024-05-01 09:00:02', NULL),
(4, 109, 0.00, 0.00, 'May', 2024, '2024-05-01 09:00:02', '2024-05-01 09:00:02', NULL),
(5, 110, 0.00, 0.00, 'May', 2024, '2024-05-01 09:00:02', '2024-05-01 09:00:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_queston`
--

CREATE TABLE `user_queston` (
  `user_queston_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `user_queston_type` enum('for_athletes','for_parents','for_athletes_coaches','for_friday_frenzy','for_coaches') NOT NULL DEFAULT 'for_athletes',
  `answere_video` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_queston`
--

INSERT INTO `user_queston` (`user_queston_id`, `user_id`, `question_id`, `user_queston_type`, `answere_video`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 105, 0, '', 1, NULL, NULL, NULL),
(2, 105, 1, 'for_athletes', 2, NULL, NULL, NULL),
(3, 105, 2, 'for_athletes', 3, NULL, NULL, NULL),
(4, 105, 3, 'for_athletes', 4, NULL, NULL, NULL),
(5, 105, 11, 'for_athletes', 5, NULL, NULL, NULL),
(6, 105, 12, 'for_athletes', 6, NULL, NULL, NULL),
(7, 105, 13, 'for_athletes', 7, NULL, NULL, NULL),
(8, 105, 41, 'for_parents', 8, NULL, NULL, NULL),
(9, 105, 45, 'for_friday_frenzy', 9, NULL, NULL, NULL),
(10, 106, 0, '', 10, NULL, NULL, NULL),
(11, 106, 46, 'for_coaches', 11, NULL, NULL, NULL),
(12, 106, 51, 'for_coaches', 12, NULL, NULL, NULL),
(13, 106, 47, 'for_coaches', 13, NULL, NULL, NULL),
(14, 106, 48, 'for_coaches', 14, NULL, NULL, NULL),
(15, 106, 49, 'for_coaches', 15, NULL, NULL, NULL),
(16, 106, 53, 'for_coaches', 16, NULL, NULL, NULL),
(17, 106, 52, 'for_coaches', 17, NULL, NULL, NULL),
(18, 106, 50, 'for_coaches', 18, NULL, NULL, NULL),
(19, 104, 0, '', 19, NULL, NULL, NULL),
(20, 104, 11, 'for_athletes', 20, NULL, NULL, NULL),
(21, 104, 12, 'for_athletes', 21, NULL, NULL, NULL),
(22, 104, 13, 'for_athletes', 22, NULL, NULL, NULL),
(23, 104, 1, 'for_athletes', 23, NULL, NULL, NULL),
(24, 104, 2, 'for_athletes', 24, NULL, NULL, NULL),
(25, 104, 3, 'for_athletes', 25, NULL, NULL, NULL),
(26, 104, 41, 'for_parents', 26, NULL, NULL, NULL),
(27, 104, 45, 'for_friday_frenzy', 27, NULL, NULL, NULL),
(28, 107, 0, '', 28, NULL, NULL, NULL),
(29, 107, 1, 'for_athletes', 29, NULL, NULL, NULL),
(30, 107, 2, 'for_athletes', 30, NULL, NULL, NULL),
(31, 107, 3, 'for_athletes', 31, NULL, NULL, NULL),
(32, 107, 4, 'for_athletes', 32, NULL, NULL, NULL),
(33, 107, 5, 'for_athletes', 33, NULL, NULL, NULL),
(34, 107, 6, 'for_athletes', 34, NULL, NULL, NULL),
(35, 107, 7, 'for_athletes', 35, NULL, NULL, NULL),
(36, 107, 8, 'for_athletes', 36, NULL, NULL, NULL),
(37, 108, 0, '', 37, NULL, NULL, NULL),
(38, 108, 1, 'for_athletes', 38, NULL, NULL, NULL),
(39, 108, 2, 'for_athletes', 39, NULL, NULL, NULL),
(40, 108, 3, 'for_athletes', 40, NULL, NULL, NULL),
(41, 108, 12, 'for_athletes', 41, NULL, NULL, NULL),
(42, 108, 13, 'for_athletes', 42, NULL, NULL, NULL),
(43, 108, 41, 'for_parents', 43, NULL, NULL, NULL),
(44, 108, 45, 'for_friday_frenzy', 44, NULL, NULL, NULL),
(45, 108, 11, 'for_athletes', 45, NULL, NULL, NULL),
(46, 109, 0, '', 46, NULL, NULL, NULL),
(47, 109, 1, 'for_athletes', 47, NULL, NULL, NULL),
(48, 109, 12, 'for_athletes', 48, NULL, NULL, NULL),
(49, 109, 11, 'for_athletes', 49, NULL, NULL, NULL),
(50, 109, 2, 'for_athletes', 50, NULL, NULL, NULL),
(51, 109, 3, 'for_athletes', 51, NULL, NULL, NULL),
(52, 109, 13, 'for_athletes', 52, NULL, NULL, NULL),
(53, 109, 41, 'for_parents', 53, NULL, NULL, NULL),
(54, 109, 45, 'for_friday_frenzy', 54, NULL, NULL, NULL),
(55, 110, 0, '', 55, NULL, NULL, NULL),
(56, 110, 55, 'for_coaches', 56, NULL, NULL, NULL),
(57, 110, 59, 'for_coaches', 57, NULL, NULL, NULL),
(58, 110, 60, 'for_coaches', 58, NULL, NULL, NULL),
(59, 110, 62, 'for_coaches', 59, NULL, NULL, NULL),
(60, 110, 61, 'for_coaches', 60, NULL, NULL, NULL),
(61, 110, 47, 'for_coaches', 61, NULL, NULL, NULL),
(62, 110, 51, 'for_coaches', 62, NULL, NULL, NULL),
(63, 110, 52, 'for_coaches', 63, NULL, NULL, NULL),
(64, 111, 0, '', 64, NULL, NULL, NULL),
(90, 111, 1, 'for_athletes', 90, NULL, NULL, NULL),
(91, 111, 2, 'for_athletes', 91, NULL, NULL, NULL),
(92, 111, 3, 'for_athletes', 92, NULL, NULL, NULL),
(93, 111, 4, 'for_athletes', 93, NULL, NULL, NULL),
(94, 111, 5, 'for_athletes', 94, NULL, NULL, NULL),
(95, 111, 6, 'for_athletes', 95, NULL, NULL, NULL),
(96, 111, 7, 'for_athletes', 96, NULL, NULL, NULL),
(97, 111, 8, 'for_athletes', 97, NULL, NULL, NULL),
(98, 112, 0, '', 98, NULL, NULL, NULL),
(99, 112, 1, 'for_athletes', 99, NULL, NULL, NULL),
(100, 112, 2, 'for_athletes', 100, NULL, NULL, NULL),
(101, 112, 3, 'for_athletes', 101, NULL, NULL, NULL),
(102, 112, 4, 'for_athletes', 102, NULL, NULL, NULL),
(103, 112, 5, 'for_athletes', 103, NULL, NULL, NULL),
(104, 112, 6, 'for_athletes', 104, NULL, NULL, NULL),
(105, 112, 7, 'for_athletes', 105, NULL, NULL, NULL),
(106, 112, 8, 'for_athletes', 106, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `video_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `video_title` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `video_type` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '1 => paid , 2 => Free',
  `video_veiw_count` bigint(20) NOT NULL DEFAULT 0,
  `video_ext` varchar(255) NOT NULL,
  `video_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '1 => Active , 2 => Inactive , 0 => pending	',
  `thumbnails` varchar(255) DEFAULT NULL,
  `video_from` enum('QA','video') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`video_id`, `user_id`, `video_title`, `video`, `video_type`, `video_veiw_count`, `video_ext`, `video_status`, `thumbnails`, `video_from`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 105, 'Intro Video', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video/Chad%20Le%20Clos%20Intro.MP4', '2', 0, 'MP4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video_thumbnail/1713300454_1050385477.jpg', 'QA', '2024-04-16 20:47:34', '2024-04-16 21:45:34', NULL),
(2, 105, 'What was the best advice you were ever given?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video/Chad%20Le%20Clos%20best%20advice.MP4', '2', 0, 'MP4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video_thumbnail/1713300501_1197712806.jpg', 'QA', '2024-04-16 20:48:22', '2024-04-16 21:46:04', NULL),
(3, 105, 'Did you play multi sports, if so, what sports? Do you believe in young kids playing multiple sports and if so what and at what age did you start to specialise?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video/Chad%20Le%20Clos%20multisports.MP4', '2', 0, 'MP4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video_thumbnail/1713300568_2054368661.jpg', 'QA', '2024-04-16 20:49:29', '2024-04-16 21:46:38', NULL),
(4, 105, 'Given the mental game and pressure put on young kids with social media, what advice would you give kids of today for mental strength?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video/Chad%20Le%20Clos.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video_thumbnail/1713300624_865361538.jpg', 'QA', '2024-04-16 20:50:25', NULL, NULL),
(5, 105, 'What would you tell your teen self, knowing what you know?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video/Chad%20Le%20Clos%20what%20would%20i%20say%20to%208%20yr%20old%20myself.MP4', '2', 1, 'MP4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video_thumbnail/1713300661_1298217676.jpg', 'QA', '2024-04-16 20:51:01', '2024-05-07 03:25:41', NULL),
(6, 105, 'What bad habits do you look back on and wish you could change?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video/8e2dc534-b630-4335-8511-cbc8fa1e4e9c.MP4', '0', 0, 'MP4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video_thumbnail/1713300724_941957136.jpg', 'QA', '2024-04-16 20:52:05', NULL, NULL),
(7, 105, 'Did you ever consider quitting and if so, why and how did you overcome that?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video/Chad%20Le%20Clos%20did%20you%20ever%20consider%20quitting.MP4', '2', 0, 'MP4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video_thumbnail/1713300751_1143562026.jpg', 'QA', '2024-04-16 20:52:32', '2024-04-17 09:10:50', NULL),
(8, 105, 'What would you say to parents of talented young kids based on your learnings with your child?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video/Chad%20Le%20Clos%20parent%20question.MP4', '2', 0, 'MP4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video_thumbnail/1713300793_712071588.jpg', 'QA', '2024-04-16 20:53:14', '2024-04-17 09:11:31', NULL),
(9, 105, 'We need a 30 second clip to tell kids what your advice is going into a weekend of matches (whatever that might be). What advice would you give for game day in 30 seconds.', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video/Chad%20Le%20Clos.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/105/video_thumbnail/1713300822_216624553.jpg', 'QA', '2024-04-16 20:53:43', NULL, NULL),
(19, 104, 'Intro Video', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video/My%20Movie%203.mov', '2', 0, 'mov', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video_thumbnail/1713345655_958118935.jpg', 'QA', '2024-04-17 09:20:56', '2024-04-28 00:47:20', NULL),
(20, 104, 'What would you tell your teen self, knowing what you know?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video/My%20Movie%204.mov', '2', 0, 'mov', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video_thumbnail/1713345703_1061479327.jpg', 'QA', '2024-04-17 09:21:44', '2024-04-28 00:50:21', NULL),
(21, 104, 'What bad habits do you look back on and wish you could change?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video/Shannon%20Eckstein%20bad%20habits.MP4', '2', 0, 'MP4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video/1714265733_411987501.jpg', 'QA', '2024-04-17 09:22:12', '2024-04-28 00:58:19', NULL),
(22, 104, 'Did you ever consider quitting and if so, why and how did you overcome that?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video/74787c70-e95a-4e4f-b25a-e41f7f8b09af.mp4', '2', 0, 'mp4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video_thumbnail/1713345749_168974047.jpg', 'QA', '2024-04-17 09:22:29', '2024-04-28 00:51:41', NULL),
(23, 104, 'What was the best advice you were ever given?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video/3a80cef3-0411-4eb2-83ca-9c777f6a55f8.mp4', '2', 0, 'mp4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video_thumbnail/1713345781_1325352471.jpg', 'QA', '2024-04-17 09:23:02', '2024-04-28 00:48:04', NULL),
(24, 104, 'Did you play multi sports, if so, what sports? Do you believe in young kids playing multiple sports and if so what and at what age did you start to specialise?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video/f56e5aaf-3698-4eb0-9e1d-7df8c35d3575.mp4', '2', 0, 'mp4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video_thumbnail/1713345816_798796293.jpg', 'QA', '2024-04-17 09:23:36', '2024-04-28 00:48:39', NULL),
(25, 104, 'Given the mental game and pressure put on young kids with social media, what advice would you give kids of today for mental strength?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video/a39aead8-f6a8-4bbf-8766-b5bc7e55b016.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video_thumbnail/1713345915_513238608.jpg', 'QA', '2024-04-17 09:25:15', NULL, NULL),
(26, 104, 'What would you say to parents of talented young kids based on your learnings with your child?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video/a39aead8-f6a8-4bbf-8766-b5bc7e55b016.mp4', '2', 0, 'mp4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video_thumbnail/1713345971_2133260621.jpg', 'QA', '2024-04-17 09:26:12', '2024-04-28 00:52:39', NULL),
(27, 104, 'We need a 30 second clip to tell kids what your advice is going into a weekend of matches (whatever that might be). What advice would you give for game day in 30 seconds.', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video/My%20Movie%204.mov', '0', 0, 'mov', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/104/video_thumbnail/1713346056_664023916.jpg', 'QA', '2024-04-17 09:27:37', NULL, NULL),
(37, 108, 'Intro Video', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video/My%20Movie%205.MOV', '2', 0, 'MOV', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video_thumbnail/1714031539_383054664.jpg', 'QA', '2024-04-25 07:52:19', '2024-04-28 00:35:25', NULL),
(38, 108, 'What was the best advice you were ever given?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video/Johan%20Botha%20best%20advice%20given.MP4', '2', 0, 'MP4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video_thumbnail/1714031598_568909342.jpg', 'QA', '2024-04-25 07:53:18', '2024-04-28 00:36:25', NULL),
(39, 108, 'Did you play multi sports, if so, what sports? Do you believe in young kids playing multiple sports and if so what and at what age did you start to specialise?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video/Johan%20Botha%20what%20other%20sports%20did%20i%20play%20and%20when%20did%20i%20specialise.MP4', '2', 0, 'MP4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video_thumbnail/1714031609_1061431315.jpg', 'QA', '2024-04-25 07:53:29', '2024-04-28 00:37:38', NULL),
(40, 108, 'Given the mental game and pressure put on young kids with social media, what advice would you give kids of today for mental strength?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video/Johan%20Botha%20advice%20on%20the%20mental%20side%20of%20the%20game.MP4', '2', 0, 'MP4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video_thumbnail/1714031629_890282776.jpg', 'QA', '2024-04-25 07:53:49', '2024-04-28 00:39:17', NULL),
(41, 108, 'What bad habits do you look back on and wish you could change?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video/Johan%20Botha%20bad%20habits.MP4', '2', 0, 'MP4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video_thumbnail/1714031704_1842143188.jpg', 'QA', '2024-04-25 07:55:04', '2024-04-28 00:41:15', NULL),
(42, 108, 'Did you ever consider quitting and if so, why and how did you overcome that?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video/Johan%20Botha%20did%20i%20ever%20consider%20quitting.mp4', '2', 0, 'mp4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video_thumbnail/1714031714_63025001.jpg', 'QA', '2024-04-25 07:55:14', '2024-04-28 00:42:17', NULL),
(43, 108, 'What would you say to parents of talented young kids based on your learnings with your child?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video/Johan%20Botha%20advice%20to%20parents%20of%20young%20athletes.MP4', '2', 0, 'MP4', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video_thumbnail/1714031768_305590887.jpg', 'QA', '2024-04-25 07:56:09', '2024-04-28 00:43:50', NULL),
(44, 108, 'We need a 30 second clip to tell kids what your advice is going into a weekend of matches (whatever that might be). What advice would you give for game day in 30 seconds.', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video/Johan%20Botha%20did%20i%20ever%20consider%20quitting.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video_thumbnail/1714032441_1071921852.jpg', 'QA', '2024-04-25 08:07:22', NULL, NULL),
(45, 108, 'What would you tell your teen self, knowing what you know?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video/Justin%20Intro.MOV', '0', 0, 'MOV', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/108/video_thumbnail/1714032476_1412173066.jpg', 'QA', '2024-04-25 08:07:56', NULL, NULL),
(46, 109, 'Intro Video', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video/Trevor%20Hendy%20intro.mov', '2', 0, 'mov', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video_thumbnail/1714032950_1265570541.jpg', 'QA', '2024-04-25 08:15:51', '2024-04-28 00:20:27', NULL),
(47, 109, 'What was the best advice you were ever given?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video/Trevor%20Hendy%20Best%20Advice.mov', '2', 0, 'mov', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video_thumbnail/1714033269_320403235.jpg', 'QA', '2024-04-25 08:21:10', '2024-04-28 00:21:48', NULL),
(48, 109, 'What bad habits do you look back on and wish you could change?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video/Trevor%20Hendy%20Bad%20Habits.MOV', '2', 0, 'MOV', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video_thumbnail/1714033280_996056768.jpg', 'QA', '2024-04-25 08:21:21', '2024-04-28 00:29:21', NULL),
(49, 109, 'What would you tell your teen self, knowing what you know?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video/Trevor%20Hendy%208%20year%20old.mov', '2', 0, 'mov', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video_thumbnail/1714033363_2066792560.jpg', 'QA', '2024-04-25 08:22:44', '2024-04-28 00:28:21', NULL),
(50, 109, 'Did you play multi sports, if so, what sports? Do you believe in young kids playing multiple sports and if so what and at what age did you start to specialise?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video/Trevor%20Hendy%20Multisports.MOV', '2', 0, 'MOV', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video_thumbnail/1714033442_685462022.jpg', 'QA', '2024-04-25 08:24:03', '2024-04-28 00:23:07', NULL),
(51, 109, 'Given the mental game and pressure put on young kids with social media, what advice would you give kids of today for mental strength?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video/Trevor%20Hendy%20Mental%20side.MOV', '2', 0, 'MOV', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video_thumbnail/1714033471_761111651.jpg', 'QA', '2024-04-25 08:24:32', '2024-04-28 00:26:44', NULL),
(52, 109, 'Did you ever consider quitting and if so, why and how did you overcome that?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video/Trevor%20Hendy%20Ever%20consider%20quitting.MOV', '2', 0, 'MOV', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video_thumbnail/1714033539_889226671.jpg', 'QA', '2024-04-25 08:25:40', '2024-04-28 00:33:04', NULL),
(53, 109, 'What would you say to parents of talented young kids based on your learnings with your child?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video/Trevor%20Hendy%20parents.MOV', '2', 0, 'MOV', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video_thumbnail/1714033593_1036422356.jpg', 'QA', '2024-04-25 08:26:34', '2024-04-28 00:34:27', NULL),
(54, 109, 'We need a 30 second clip to tell kids what your advice is going into a weekend of matches (whatever that might be). What advice would you give for game day in 30 seconds.', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video/Justin%20Intro%20%281%29.MOV', '0', 0, 'MOV', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/109/video_thumbnail/1714033794_1586578884.jpg', 'QA', '2024-04-25 08:29:54', NULL, NULL),
(55, 110, 'Intro Video', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video/Justin%20Intro%20%281%29.MOV', '2', 0, 'MOV', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video_thumbnail/1714033982_2110067575.jpg', 'QA', '2024-04-25 08:33:03', '2024-04-25 09:49:05', NULL),
(56, 110, 'How can parents support their child\'s aspirations while maintaining a healthy perspective on the journey?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video/Justin%20Holbrook%20parents%20of%20kids.MOV', '2', 0, 'MOV', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video_thumbnail/1714034056_1881972752.jpg', 'QA', '2024-04-25 08:34:17', '2024-04-28 00:13:23', NULL),
(57, 110, 'What is the best advice you would give to a young sports person?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video/Justin%20Holbrook%20best%20advice%20for%20a%20young%20kid.MOV', '2', 0, 'MOV', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video_thumbnail/1714034145_1660677754.jpg', 'QA', '2024-04-25 08:35:45', '2024-04-28 00:14:48', NULL),
(58, 110, 'Would you encourage playing multi sports, if so, why? At what age would you advise they start to specialise?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video/Justin%20Holbrook%20multi%20sports.MOV', '2', 0, 'MOV', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video_thumbnail/1714034196_529652455.jpg', 'QA', '2024-04-25 08:36:36', '2024-04-28 00:15:56', NULL),
(59, 110, 'What advice would you give to parents of talented young kids based on what you see as being ‘right’ or ‘wrong’?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video/Justin%20Holbrook%20parents%20of%20kids.MOV', '0', 0, 'MOV', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video_thumbnail/1714034216_599123183.jpg', 'QA', '2024-04-25 08:36:56', NULL, NULL),
(60, 110, 'Given the mental game and pressure put on young kids with social media, what advice would you give kids of today for mental strength?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video/Justin%20Holbrook%20mental%20side.MOV', '2', 0, 'MOV', '1', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video_thumbnail/1714034281_1995880581.jpg', 'QA', '2024-04-25 08:38:02', '2024-04-28 00:17:39', NULL),
(61, 110, 'How do you provide constructive feedback to players to help them improve?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video/Justin%20Holbrook%20skill%20or%20attitude.mov', '0', 0, 'mov', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video_thumbnail/1714034352_1885771925.jpg', 'QA', '2024-04-25 08:39:13', NULL, NULL),
(62, 110, 'How can parent’s best support their child\'s athletic development without adding unnecessary pressure?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video/Justin%20Intro.MOV', '0', 0, 'MOV', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video_thumbnail/1714034375_932026400.jpg', 'QA', '2024-04-25 08:39:36', NULL, NULL),
(63, 110, 'How do you balance the demands of training and competition with the need for rest and recovery?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video/Justin%20Intro%20%281%29.MOV', '0', 0, 'MOV', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/110/video_thumbnail/1714034384_321991071.jpg', 'QA', '2024-04-25 08:39:44', NULL, NULL),
(64, 111, 'Intro Video', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video/big_buck_bunny_720p_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video_thumbnail/1714985584_1606639991.jpg', 'QA', '2024-05-06 08:53:05', NULL, NULL),
(90, 111, 'What was the best advice you were ever given?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video/big_buck_bunny_720p_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video_thumbnail/1714986162_847675610.jpg', 'QA', '2024-05-06 09:02:42', NULL, NULL),
(91, 111, 'Did you play multi sports, if so, what sports? Do you believe in young kids playing multiple sports and if so what and at what age did you start to specialise?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video/big_buck_bunny_720p_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video_thumbnail/1714986167_1955570399.jpg', 'QA', '2024-05-06 09:02:48', NULL, NULL),
(92, 111, 'Given the mental game and pressure put on young kids with social media, what advice would you give kids of today for mental strength?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video/big_buck_bunny_720p_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video_thumbnail/1714986172_1264233471.jpg', 'QA', '2024-05-06 09:02:53', NULL, NULL),
(93, 111, 'If you could go back in time, what would you do differently or change in regards to prep/training/down time/mobility/maintenance/nutrition etc?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video/big_buck_bunny_720p_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video_thumbnail/1714986177_1965486985.jpg', 'QA', '2024-05-06 09:02:58', NULL, NULL),
(94, 111, 'What is your most important pre-game routine?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video/big_buck_bunny_720p_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video_thumbnail/1714986185_1516826106.jpg', 'QA', '2024-05-06 09:03:06', NULL, NULL),
(95, 111, 'What did you do differently to those around you as a teenager to make your dreams come true ?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video/big_buck_bunny_720p_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video_thumbnail/1714986191_339700619.jpg', 'QA', '2024-05-06 09:03:11', NULL, NULL),
(96, 111, 'Knowing what you know now about nutrition, sports psychology, stretching and breathing techniques, when did you start doing these things and what value do they add? In a perfect world, when should young athletes start doing these things?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video/big_buck_bunny_720p_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video_thumbnail/1714986195_754163412.jpg', 'QA', '2024-05-06 09:03:16', NULL, NULL),
(97, 111, 'As a teenager did you play sport all year round or did you have down time and if down time, what did you do in that time? Knowing what you know now, would you have had more downtime in your younger years?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video/big_buck_bunny_720p_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/111/video_thumbnail/1714986200_1734631056.jpg', 'QA', '2024-05-06 09:03:21', NULL, NULL),
(98, 112, 'Intro Video', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video/SampleVideo_1280x720_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video_thumbnail/1715163391_1188006303.jpg', 'QA', '2024-05-08 10:16:32', NULL, NULL),
(99, 112, 'What was the best advice you were ever given?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video/SampleVideo_1280x720_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video_thumbnail/1715163424_537354070.jpg', 'QA', '2024-05-08 10:17:05', NULL, NULL),
(100, 112, 'Did you play multi sports, if so, what sports? Do you believe in young kids playing multiple sports and if so what and at what age did you start to specialise?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video/SampleVideo_1280x720_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video_thumbnail/1715163440_750862186.jpg', 'QA', '2024-05-08 10:17:21', NULL, NULL),
(101, 112, 'Given the mental game and pressure put on young kids with social media, what advice would you give kids of today for mental strength?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video/SampleVideo_1280x720_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video_thumbnail/1715163445_25020083.jpg', 'QA', '2024-05-08 10:17:26', NULL, NULL),
(102, 112, 'If you could go back in time, what would you do differently or change in regards to prep/training/down time/mobility/maintenance/nutrition etc?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video/SampleVideo_1280x720_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video_thumbnail/1715163447_2133792161.jpg', 'QA', '2024-05-08 10:17:28', NULL, NULL),
(103, 112, 'What is your most important pre-game routine?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video/SampleVideo_1280x720_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video_thumbnail/1715163452_448689448.jpg', 'QA', '2024-05-08 10:17:33', NULL, NULL),
(104, 112, 'What did you do differently to those around you as a teenager to make your dreams come true ?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video/SampleVideo_1280x720_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video_thumbnail/1715163463_11284486.jpg', 'QA', '2024-05-08 10:17:44', NULL, NULL),
(105, 112, 'Knowing what you know now about nutrition, sports psychology, stretching and breathing techniques, when did you start doing these things and what value do they add? In a perfect world, when should young athletes start doing these things?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video/SampleVideo_1280x720_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video_thumbnail/1715163479_657258594.jpg', 'QA', '2024-05-08 10:18:00', NULL, NULL),
(106, 112, 'As a teenager did you play sport all year round or did you have down time and if down time, what did you do in that time? Knowing what you know now, would you have had more downtime in your younger years?', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video/SampleVideo_1280x720_1mb.mp4', '0', 0, 'mp4', '0', 'https://ins-youth-health.s3.eu-north-1.amazonaws.com/uploads/user/112/video_thumbnail/1715163482_1732552016.jpg', 'QA', '2024-05-08 10:18:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `video_comment_history`
--

CREATE TABLE `video_comment_history` (
  `id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video_comment_history`
--

INSERT INTO `video_comment_history` (`id`, `video_id`, `comment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, 'test', '2024-04-17 04:03:11', '2024-04-17 04:03:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `video_history`
--

CREATE TABLE `video_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video_history`
--

INSERT INTO `video_history` (`id`, `user_id`, `video_id`, `created_at`) VALUES
(1, 1, 5, '2024-05-07 03:25:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ask_question`
--
ALTER TABLE `ask_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact-us`
--
ALTER TABLE `contact-us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payout`
--
ALTER TABLE `payout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `referralhistory`
--
ALTER TABLE `referralhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscription_items_subscription_id_stripe_price_index` (`subscription_id`,`stripe_price`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `stripe_id` (`stripe_id`);

--
-- Indexes for table `user_incomes`
--
ALTER TABLE `user_incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queston`
--
ALTER TABLE `user_queston`
  ADD PRIMARY KEY (`user_queston_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`);

--
-- Indexes for table `video_comment_history`
--
ALTER TABLE `video_comment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_history`
--
ALTER TABLE `video_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ask_question`
--
ALTER TABLE `ask_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payout`
--
ALTER TABLE `payout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `referralhistory`
--
ALTER TABLE `referralhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `user_incomes`
--
ALTER TABLE `user_incomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_queston`
--
ALTER TABLE `user_queston`
  MODIFY `user_queston_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `video_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `video_comment_history`
--
ALTER TABLE `video_comment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `video_history`
--
ALTER TABLE `video_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
