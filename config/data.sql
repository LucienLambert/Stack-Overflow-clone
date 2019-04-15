INSERT INTO `categories` (`id_category`, `name`) VALUES
(1, 'General'),
(2, 'Algorithms'),
(3, 'AI'),
(4, 'Big Data'),
(5, '3D graphic'),
(6, 'Web');

INSERT INTO `members` (`id_member`, `name`, `last_name`, `email`, `state`, `is_admin`, `password`) VALUES
(1, 'Lucien', 'Lambert', 'lucien.lambert@student.vinci.be', 'a', 0, 'groupe14'),
(2, 'Claudy', 'Bougna', 'claudy.bougna@student.vinci.be', 'a', 0, 'groupe14'),
(3, 'admin1name', 'admin1lastname', 'admin1@gmail.com', 'a', 1, 'groupe14');

INSERT INTO `questions` (`id_question`,`title`,`subject`,  `id_category`, `owner`, `creation_date`, `state`, `good_answer`) VALUES
(1, 'What exactly is O(log n)?','what exactly is O(log n)? For example, what does it mean to say that the height of a complete binary tree is O(log n)?',  2, 1, '2019-03-28', 'O', NULL),
(2, 'The Cost of insertion algorithm', 'What is the cost of insertion algorithm?', 1, 2, '2019-03-28', 'O', NULL),
(3, 'Difference betweenn and  javascript ', 'What is the main difference between java and javascript?', 3, 2, '2019-03-28', 'O', NULL),
(4, 's4', 't4', 4, 1, '2019-03-28', 'O', NULL),
(5, 's5', 't5', 5, 2, '2019-03-28', 'O', NULL);

INSERT INTO `answers` (`id_answer`, `subject`, `creation_date`, `id_question`, `id_member`) VALUES
(1, 's11', '2019-03-28', 1, 1),
(2, 's12', '2019-03-28', 1, 2),
(3, 's21', '2019-03-28', 2, 1),
(4, 's2', '2019-03-28', 2, 1),
(5, 's11', '2019-03-28', 2, 1),
(6, 's12', '2019-03-28', 3, 2),
(7, 's21', '2019-03-28', 3, 1),
(8, 's2', '2019-03-28', 4, 1),
(9, 's11', '2019-03-28', 4, 1),
(10, 's12', '2019-03-28', 5, 2),
(11, 's21', '2019-03-28', 5, 1);