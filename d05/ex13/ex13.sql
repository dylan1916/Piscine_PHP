SELECT ROUND(SUM(`cinema`.`nb_seats`) / COUNT(`cinema`.`nb_seats`)) AS 'average' FROM `cinema`;