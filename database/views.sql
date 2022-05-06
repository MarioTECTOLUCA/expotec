CREATE VIEW requests_view AS 
SELECT  `requests`.*, 
        `teams`.`name` AS `name` 
        FROM (`requests` left join `teams` on(`requests`.`fk_team` = `teams`.`id`)) ;

CREATE VIEW team_view AS 
SELECT `students_has_teams`.`id` AS `id`, 
		`teams`.`id` AS `TeamId`, 
        `teams`.`name` AS `Team`, 
        `teams`.`active_invitations` AS `TeamInv`, 
        `teams`.`urldoc` AS `TeamDoc`,
        `teams`.`status` AS `TeamStatus`,
        `teams`.`vbo` AS `TeamVBO`, 
        `students`.`id` AS `StudentId`, 
        `students`.`name` AS `Student`, 
        `advisers`.`id` AS `AdviserId`, 
        `advisers`.`name` AS `Adviser`, 
        `events`.`id` AS `EventId`, 
        `events`.`name` AS `Event`, 
        `categories`.`id` AS `CategorieId`, 
        `categories`.`name` AS `Categorie` 
        FROM (((((`students_has_teams` 
                  left join `teams` on(`students_has_teams`.`fk_teams` = `teams`.`id`)) 
                 left join `students` on(`students_has_teams`.`fk_student` = `students`.`id`)) 
                left join `advisers` on(`teams`.`fk_adviser` = `advisers`.`id`)) 
               left join `events` on(`teams`.`fk_event` = `events`.`id`)) 
              left join `categories` on(`teams`.`fk_categorie` = `categories`.`id`)) ;

CREATE VIEW evaluation_view AS 
SELECT  `evaluations_has_items`.*, 
        `evaluations`.`name` as "EvaluationName", 
        `evaluations`.`score` as "EvaluationScore", 
        `categories`.id as "CategorieId", 
        `categories`.`name` as "CategorieName", 
        `items`.`name` as "ItemName", 
        `items`.`score` as "ItemScore" 
        FROM `evaluations_has_items` 
        LEFT JOIN `evaluations` ON `evaluations_has_items`.`fk_evaluations` = `evaluations`.`id` 
        LEFT JOIN `categories` ON `evaluations`.`fk_categorie` = `categories`.`id` 
        LEFT JOIN `items` ON `evaluations_has_items`.`fk_items` = `items`.`id`;

CREATE VIEW students_view AS 
SELECT  `students`.*, 
        `gender`.`name` as "gender", 
        `careers`.`name` as "career" 
        FROM `students` 
        LEFT JOIN `gender` ON `students`.`fk_gender` = `gender`.`id` 
        LEFT JOIN `careers` ON `students`.`fk_career` = `careers`.`id`;

CREATE VIEW evaluators_view AS
SELECT `evaluators`.*, `events`.`name` as "event", `categories`.`name` as categorie
FROM `evaluators` 
	LEFT JOIN `events` ON `evaluators`.`fk_event` = `events`.`id` 
	LEFT JOIN `categories` ON `evaluators`.`fk_categorie` = `categories`.`id`;

CREATE VIEW califications_view AS 
SELECT  `califications`.*, 
        `teams`.`name` as "teamName", 
        `categories`.`name` as "categorieName" 
FROM `califications` LEFT JOIN `teams` ON `califications`.`fk_team` = `teams`.`id` LEFT JOIN `categories` ON `teams`.`fk_categorie` = `categories`.`id`;