-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 05:49 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelsvelteinertia`
--

-- --------------------------------------------------------

--
-- Table structure for table `mixes`
--

-- CREATE TABLE `mixes` (
--   `id` bigint(20) UNSIGNED NOT NULL,
--   `name` varchar(255) NOT NULL,
--   `description` varchar(2000) DEFAULT NULL,
--   `img_source` varchar(255) DEFAULT NULL,
--   `user_id` int(11) DEFAULT NULL,
--   `cuisine_id` int(11) NOT NULL DEFAULT 1,
--   `source_url` varchar(255) DEFAULT NULL,
--   `source_name` varchar(255) DEFAULT NULL,
--   `show_alternatives` tinyint(1) NOT NULL DEFAULT 1,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mixes`
--

INSERT INTO `mixes` VALUES 
(4,'Italian','<p><strong>Use in pasta sauces, pizza sauce or garlic bread!</strong></p><p></p><p></p><p><strong>Italian cuisine staples:</strong></p><p>Pasta, Pizza, Risotto, tomatoes, Olive oil, Cheese, Balsamic vinegar, Basil and Pesto, Mozzarella, Red&amp;White cooking wine, (Porcini) Mushrooms, Eggplant, Broccoli Rabe, Artichokes, Arugula, Fennel.</p><p></p><p></p><p>Happy cooking and 🍕Buon Appetito</p>','https://www.pickpik.com/italy-spices-cook-italian-kitchen-herbs-114924',NULL,1,NULL,NULL,0,NULL,NULL,NULL,NULL,1,'2025-04-27 15:11:00','2025-04-27 15:10:00'),
(5,'Garam Masala','<p>When using bay leaves and/or whole cloves, grind to a powder. Store in airtight container in a cool, dry and dark place, up to 6 months. Want an improved recipe? Take whole spices instead of ground ones, and roast them before grindig to a powder. </p><p></p><p><strong>Recipe ideas:</strong></p><p>Cauliflower Tikka Masala, Butter Chicken, Sweet potato curry, Tandoori Chicken, Chicken tikka Masala, Pulav. </p><p><br><strong>Indian Staple foods: </strong><br>Lentils, Beans, Chickpeas, Chicken, Rice, Bread, Naan, Garlic, Ginger, Peanuts, Cilantro, Mint, Spinach, Sesame Seeds, Pakora, Chaat</p>','https://www.flickr.com/photos/hepp/14578454962',NULL,2,NULL,NULL,0,NULL,NULL,NULL,NULL,1,'2025-04-27 15:18:00','2025-04-27 15:22:00'),
(7,'Mexican','<p>Store in airtight container, for up to 6 months in dark, dry and cool place. Or freeze for up to a year. </p><p></p><p><strong>Recipes:</strong><br>Tacos or Burritos! Fajitas. Quesadilla, or season Chicken, Meat, Beef, Pork Fish, Roasted veggies or Roasted potatoes. </p><p></p><p><strong>Mexican cuisine Staples:</strong></p><p>Corn, beans, Chillies, Tomatoes, Rice, Onions, Jalapeños, Bay Leaves, Cheese, Lime,  Avocados &amp; Garlic.<br>Salsa, Nachos, Tortillas.</p><p></p><p>Use 1.5 Tbsp per pound of to-be-seasoned-item. </p>','https://pixabay.com/photos/mexican-food-burrito-mexican-food-2456038/',NULL,4,NULL,NULL,0,NULL,NULL,NULL,NULL,1,'2025-04-27 15:18:00','2025-04-27 15:25:00'),
(8,'Ground beef',NULL,'https://www.pexels.com/photo/a-person-cooking-while-holding-a-pan-and-tongs-5737571/',NULL,11,NULL,NULL,0,NULL,NULL,NULL,NULL,1,'2025-04-17 08:28:19','2025-04-17 08:28:19'),
(9,'Ramen/Noodles','Optional: Replace ground ginger and garlic with grated ginger and crushed garlic\r\n\r\nCommon noodle/soup ingredients: eggs, soy sauce, chili pepper, sesame ooil, sacllions, Schrimp, rice vinegat, ginger, shiitake mushrooms, kale, carrots, panko crumbs for topping.','https://pixabay.com/photos/ramen-noodles-soup-dinner-egg-7187810/',NULL,6,NULL,NULL,0,NULL,NULL,NULL,NULL,1,'2025-04-17 08:52:16','2025-04-17 08:52:43'),
(11,'French herbes de Provence','<p>Officially Oregano, Savory and Rosemary in equal amounts + 10% Thyme.</p><p></p><p></p><p><strong>Recipes to try:</strong></p><p>Ratatouille, Tapenade, brush over chicken or fish, Toss vegetables, vegetable stews, French Lentil and Carrot soup, Cod Provençal, Eggplant/tomato gratin, Niçoise Salad with potatoes, green beans, anchovies, hard-boiled eggs, olives and tomatoes,<br>Tarte Tatin, Quiche, Coq au vin, French onion soup,</p><p></p><p></p><p><strong>Food staples in France:</strong></p><p>Cheese, shallots, leeks, figs and plums, meats, eggs, snails, mussels, potatoes, cod, garlic, olive oil, fleur de sel, nougat, baguette/bread, crème fraîche, wine, Aïoli sauce, olives, tomatoes, stocks, flour, puff pastry, tapenade, capers, anchovies.</p>','https://commons.wikimedia.org/wiki/File:Crudit%C3%A9s_en_Provence.jpg',NULL,1,NULL,NULL,0,0,NULL,NULL,NULL,1,'2025-04-17 10:19:07','2025-04-27 12:35:31'),
(13,'Chicken spices','Pat chicken dry with paper towel, sprinkle seasoning over meat and rub in. Let sit for around 20 minutes minimum before cooking/baking/grilling.','https://www.pexels.com/photo/cooked-chicken-on-white-plate-2673353/',NULL,11,NULL,NULL,0,NULL,NULL,NULL,NULL,1,'2025-04-17 10:27:32','2025-04-17 10:27:32'),
(14,'Fish (any)','Around 2 tbsp seasoning per pound of fish. Season fish right before cooking.','https://www.pexels.com/photo/grilled-salmon-fish-on-top-of-grilled-vegetables-842142/',NULL,11,NULL,NULL,0,NULL,NULL,NULL,NULL,1,'2025-04-17 10:33:35','2025-04-17 10:33:35'),
(15,'Indian Curry','Typical curry ingredients:\r\n\r\nProteins: Chicken, Lamb, Paneer. Other: Onions, Chili peppers, tomatoes, greek yoghurt, ginger, lemon juice, Garam Masala.','https://pixabay.com/photos/curry-food-dish-meal-cuisine-7249247/',NULL,2,NULL,NULL,0,NULL,NULL,NULL,NULL,1,'2025-04-17 10:37:50','2025-04-17 10:43:49'),
(16,'Chinese five spice','Use as spice-rub for Tofu, Pork or Poultry. Use in Ramen.','https://stockcake.com/i/spices-tell-stories_1512182_1171354',NULL,6,NULL,NULL,0,0,NULL,NULL,NULL,1,'2025-04-17 10:51:37','2025-04-27 12:06:40'),
(21,'Pumpkin spice','Use in pumpkin pie, muffins, brownies, bread, spiced nuts, pumpkin spice latte, use in cupcake icing or use as syrup by adding water and sugar and boiling until all has dissolved.','https://www.pexels.com/photo/delectable-sliced-pumpkin-pie-on-white-ceramic-plate-248469/',NULL,4,NULL,NULL,0,0,NULL,NULL,NULL,1,'2025-04-27 12:45:18','2025-04-27 12:45:18'),
(22,'Grillkrydder (bbq spice)','Nordic recipe (Norway/Sweden), \r\nuse to flavor bbq vegetables or meat.','https://www.pexels.com/photo/a-vegetables-cooking-in-the-griller-8523126/',NULL,5,NULL,NULL,0,0,NULL,NULL,NULL,1,'2025-04-27 12:51:20','2025-04-27 12:51:20'),
(23,'Potato seasoning','Use for potato wedges, roasted potatoes, grilled potatoes or fries.\r\nBake with olive oil. Optionally add cheese.','https://www.pexels.com/photo/potato-wedges-on-white-ceramic-plate-9862286/',NULL,10,NULL,NULL,0,0,NULL,NULL,NULL,1,'2025-04-27 12:58:10','2025-04-27 12:58:10'),
(24,'Dry Harissa','<p>Originally, Harissa is a hot chili pepper paste from Tunisia/Moroccan/Algeria and Libya region (that can be made in many different ways), from several roasted chili peppers, garlic, spices, and olive oil.</p><p></p><p><strong>Instructions for dried harissa:</strong> Roast all the seeds and pepper corns, put in a coffee grinder, then add rest of the ingredients. Store in the freezer.</p><p></p><p><strong>For a more authentic recipe</strong>; use dried chili peppers, e.g. New Mexico or Guajillo chiles, chop, then roast them for about 5 minutes over medium heat, let them cool, roast the rest of the seeds/corns separately, and then add everything to a food processor. Use less pepper corns and no chili powder if you go this route. Can also use fresh garlic instead of powder</p><p></p><p><strong>To turn your dried harissa into a paste,</strong> add 1/2ts extra virgin olive oil and 1/4ts water (or lemon juice/red wine vinegar) for every 2 teaspoons of dried harissa. Add more olive oil and water if the paste is too thick.</p><p></p><p><strong>Uses:</strong> Marinate chicken, meatballs, or sardines, use in harissa humus, harissa Mayo, and many other recipes.</p><p></p>','https://pixabay.com/photos/harissa-tunisia-north-africa-4075853/',NULL,1,NULL,NULL,0,0,NULL,NULL,NULL,1,'2025-04-27 13:11:44','2025-04-27 15:28:32'),
(25,'Garlic bread','<p><strong>Uses: </strong>Combine with butter and bake bread untill butter has melted. Use in pizza sauce.</p>','https://pixabay.com/photos/baguette-bread-herb-baguette-fresh-1378049/',NULL,12,NULL,NULL,0,0,NULL,NULL,NULL,1,'2025-04-27 15:15:45','2025-04-27 14:38:42'),
(26,'Herb Salad seasoning',NULL,'https://pixabay.com/photos/salad-fruit-berry-healthy-vitamins-2756467/',NULL,10,NULL,NULL,0,0,NULL,NULL,NULL,1,'2025-04-27 15:17:49','2025-04-27 15:12:49'),
(27,'fried rice (nasi) mix','<p><strong>Common ingredients for fried rice:</strong></p><p>Whole garlic, scallions, vegetable oil, frozen peas and carrots, preferably day-old brown or white rice from the fridge to fry, soy or oyster sauce, eggs</p>','https://pixabay.com/photos/fried-rice-asian-food-meal-rice-7708486/',NULL,6,NULL,NULL,0,0,NULL,NULL,NULL,1,'2025-04-26 15:16:00','2025-04-27 14:05:00');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `mixes`
-- --
-- ALTER TABLE `mixes`
--   ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mixes`
--
-- ALTER TABLE `mixes`
--   MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
