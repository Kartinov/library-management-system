CREATE TABLE `categories` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(64) UNIQUE NOT NULL,
    `is_archived` BOOLEAN DEFAULT 0,
	
	PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `authors` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(64) NOT NULL,
    `last_name` VARCHAR(64) NOT NULL,
    `bio` TEXT NOT NULL,
    `is_archived` BOOLEAN DEFAULT 0,
	
	PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `books` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`author_id` INT UNSIGNED NOT NULL,
	`categorie_id` INT UNSIGNED NOT NULL,
    `title` VARCHAR(64) NOT NULL,
    `year_of_publication` YEAR NOT NULL,
    `num_of_pages` SMALLINT UNSIGNED NOT NULL,
    `image_url` TEXT NOT NULL,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    PRIMARY KEY(`id`),
    FOREIGN KEY(`author_id`) REFERENCES `authors`(`id`),
    FOREIGN KEY(`categorie_id`) REFERENCES `categories`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `roles` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `role` VARCHAR(32) NOT NULL,
    
    PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `role_id` INT UNSIGNED NOT NULL,
	`first_name` VARCHAR(64) NOT NULL,
    `last_name` VARCHAR(64) NOT NULL,
    `email` VARCHAR(64) UNIQUE NOT NULL,
    `password` VARCHAR(512) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    PRIMARY KEY(`id`),
    FOREIGN KEY(`role_id`) REFERENCES `roles`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `comments` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED NOT NULL,
    `book_id` INT UNSIGNED NOT NULL,
    `comment_text` TEXT NOT NULL,
    `is_approved` BOOLEAN DEFAULT 0,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY(`id`),
    FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY(`book_id`) REFERENCES `books`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `notes` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED NOT NULL,
    `book_id` INT UNSIGNED NOT NULL,
    `note_text` TEXT NOT NULL,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    PRIMARY KEY(`id`),
    FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY(`book_id`) REFERENCES `books`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- roles TABLE

INSERT INTO `roles` (`role`) VALUES ('admin'), ('viewer');

-- users TABLE

INSERT INTO `users` 
		(`role_id`, `first_name`, `last_name`, `email`, `password`) 
	VALUES 
		('1', 'admin', 'admin', 'admin', '$2y$10$GGq8sf9CYE3Hm2UggfeuGO/hCW2/JgWWuBBTgJdu814dYj3eeTx4m'),
		('2', 'guest', 'guest', 'guest', '$2y$10$ZrlEoqf6vXx5v6bveFJFqeUWFAPdSqv73q6uDWKNOcYXSuiVkT002');
        
-- categories TABLE

INSERT INTO `categories` (`name`) 
	VALUES 
		('technology'),
        ('education'),
        ('biography'),
        ('lifestyle'),
        ('environment'),
        ('business'),
        ('art');
        
INSERT INTO `authors` (`first_name`, `last_name`, `bio`) 
	VALUES 
		('Kevin', 'Beaver', 'Beaver’s research examines the biosocial underpinnings to antisocial behaviors. He has employed behavioral genetic and molecular genetic methodologies to unpack the gene-environmental basis to a range of criminal and delinquent outcomes. He is the past recipient of the American Society of Criminology Ruth Shonle Cavan Young Scholar Award and the National Institute of Justice’s graduate research fellowship. Beaver has published more than 150 articles and more than 25 book chapters and is the author/editor of 10 books including Biosocial Criminology: A Primer. His research has appeared in journals as diverse as American Journal of Public Health, Biological Psychiatry, Criminology, Developmental Psychology, and Sexual Abuse.'),
        ('Carey', 'Blyton', 'He achieved success in many aspects of both disciplines, from the composing of incidental music (early Dr Who episodes and many TV and documentary films) to the composing of opera as well as songs, chamber and orchestral music; and then, as a writer, from success as the creator of Bananas in Pyjamas to the author of the fascinating travel diary In Search of Serendipity. The breadth and variety of his interests, reflected in his work, was phenomenal.'),
        ('Linda', 'Crane', 'In my quest to master secret knowledge, I have traveled the world and studied many forms of healing and spiritual practices. I hold certifications in many natural healing disciplines, including Bach Flower Registered Practitioner,  Holistic Alternative Psychology Practitioner, Certified Hypnotherapist, Reiki and Karuna Reiki Master Teacher, Practitioner of the Reconnection and Reconnective Healing, Self-I-Dentity Through Ho’oponopono, Aromatherapist, Herbalist, former Hospital Advocate and Crisis Services Counselor, and Ordained Minister.'),
        ('Mark', 'Murphy', 'Mark Murphy is an author and contributor to organizational leadership and employee engagement. Murphy has authored or contributed to four books, including Hundred Percenters: Challenge Your Employees to Give it Their All and They\'ll Give You Even More, Generation Y and the New Rules of Management, The Deadly Sins of Employee Retention, and his most recent title, HARD Goals: The Secret to Getting From Where You Are to Where You Want to Be.'),
        ('Hossein', 'Bidgoli', 'Hossein Bidgoli, Ph.D., is professor of Management Information Systems at California State University. Dr. Bidgoli helped set up the first PC lab in the United States and served as its first director. He is the author of 47 textbooks, 27 manuals, and over five dozen technical articles and papers on various aspects of computer applications, information systems, network security, e-commerce, and decision support systems published and presented throughout the world. Dr. Bidgoli also serves as the editor-in-chief of The Handbook of Technology Management, The Handbook of Computer Networks, The Handbook of Information Security, The Internet Encyclopedia, and The Encyclopedia of Information Systems.'),
        ('Bryan', 'Greetham', 'Bryan Greetham was born in Faversham, Kent, in England. He was educated at the University of Kent, where he gained a BA Hons in History, and at the University of Sussex, where he completed his MA in Intellectual History. He was awarded his PhD at the University of Newcastle in Australia for his work in moral thinking. After gaining a Postgraduate Certificate in Education at the University of London he taught at colleges and universities in Britain, Portugal and at the University of Maryland before moving to Australia in 1999 to undertake research and to teach philosophy at the University of Newcastle.'),
        ('James', 'Vance', 'James David Vance was born on August 2, 1984, in Middletown, Ohio, located between Cincinnati and Dayton, as James Donald Bowman, the son of Donald Bowman and Bev Vance. He is of Scots-Irish descent. His mother and father divorced when Vance was a toddler. Shortly afterward, Vance was adopted by his mother\'s third husband. Vance and his sister were raised primarily by his grandparents, James and Bonnie Vance, whom they called "Mamaw and Papaw". J. D. later went by the name James Hamel, the surname of his stepfather, until adopting the surname Vance in honor of his grandparents.'),
        ('Daniel', 'Lacerda', 'He was born and raised in Toronto, Canada. Tired of the rat race he hit rock bottom and moved to Brazil. While living in Brazil, Daniel began studying yoga and looking inward to find his life’s purpose. He took a vow of poverty and lived in a 300-square-foot apartment to eliminate all distractions and meditate daily for hours following the Ancient Yogic principals. While his pledge left Daniel malnourished and significantly underweight, his yoga practice also allowed him to have several personal life changing breakthroughs. This led him to become a yoga teacher in order to help others overcome their barriers too.'),
        ('Tyler', 'Miller', 'G. Tyler Miller was the third President of James Madison University, serving from 1945 to 1971. Miller Hall on the JMU campus is named for him. He was an environmental science textbook writer.');
        
INSERT INTO `books` (`author_id`, `categorie_id`, `title`, `year_of_publication`, `num_of_pages`, `image_url`)
	VALUES
		(1, 1, 'Hacking for Dummies', 2014, 614, 'https://cdn.asaha.com/assets/thumbs/14a/14a098772692e961057750876de07277.jpg'),
        (2, 1, 'Social Media Marketing', 2016, 320, 'https://cdn.asaha.com/assets/thumbs/3d7/3d721cafb681643e52c1824ba07cdf0d.jpg'),
        (3, 1, 'PC Hardware ', 2009, 673, 'https://cdn.asaha.com/assets/thumbs/045/04573a7c6a7567a8170299e13f38f869.jpg'),
        (4, 1, 'Android Programming', 2017, 512, 'https://cdn.asaha.com/assets/thumbs/141/141f43f08eeb4dcc6aa5ed65913567c5.jpg'),
        (4, 1, 'Internet of Things', 2020, 312, 'https://cdn.asaha.com/assets/thumbs/51f/51f81ad1f15c986d9665cddaa084ebbc.jpg'),
        (5, 1, 'The Internet Encyclopedia', 2019, 416, 'https://cdn.asaha.com/assets/thumbs/5b7/5b73f96e5df95f298ac026d5ab9e0831.jpg'),
        (5, 2, 'Basic Engineering Mathematics', 2013, 377, 'https://cdn.asaha.com/assets/thumbs/829/829426c016a4ed74fa144c70a493f176.jpg'),
        (5, 2, 'Higher Engineering Mathematics', 2016, 705, 'https://cdn.asaha.com/assets/thumbs/b49/b49da3a85c56f1a2ac91ff22443e641e.jpg'),
        (6, 2, 'How to Write Better Essays', 2007, 298, 'https://cdn.asaha.com/assets/thumbs/1af/1af3f1cbe06c29843d36b1f53a36b32f.jpg'),
        (7, 3, 'Napoleon', 2009, 767, 'https://cdn.asaha.com/assets/thumbs/cbc/cbccfdcf43fe538b39780f4f00ef21a9.jpg'),
        (7, 3, 'Hillbilly Elegy', 2016, 720, 'https://cdn.asaha.com/assets/thumbs/4d3/4d35b9671c7a9c43bc332ab2a4d08d4b.jpg'),
        (8, 4, 'The Complete Yoga Poses', 2016, 1132, 'https://cdn.asaha.com/assets/thumbs/8c7/8c763848a19615e858bee15ad828e858.jpg'),
        (8, 4, 'Lonely Planet Guide', 2016, 80, 'https://cdn.asaha.com/assets/thumbs/da2/da21dc2822dbba462d0c55df46d402a3.jpg'),
        (9, 5, 'Essentials of Ecology', 2010, 383, 'https://cdn.asaha.com/assets/thumbs/3ee/3eeb289ec59d3aa12e4041848c8a50b2.jpg'),
        (9, 5, 'Earth Science', 2015, 352, 'https://cdn.asaha.com/assets/thumbs/523/523efec31e81a9460dda085cebeae6fa.jpg'),
        (3, 6, 'The Power of Now', 2006, 124, 'https://cdn.asaha.com/assets/thumbs/697/6975b8d733d37ac2edd4d3240525b631.jpg'),
        (4, 6, 'Living in the Light', 2001, 258, 'https://cdn.asaha.com/assets/thumbs/9b8/9b88b7c17f496a61fc78505130af288e.jpg'),
        (9, 7, 'Art of Drawing the Human Body', 2007, 162, 'https://cdn.asaha.com/assets/thumbs/40a/40a376954631afafa275af19fe6b3154.jpg'),
        (5, 7, ' Pencil Drawing Techniques', 2006, 138, 'https://cdn.asaha.com/assets/thumbs/58e/58e011302c7db09496ad4c1c05448dfc.jpg');
