# Projecthunt

Projecthunt is a website where anyone can showcase their side-projects and get real-time feedback from other equally enthusiastic users. It can be used as a platform for finding and sharing creative and innovative ideas and view other trending projects in their college and show their support. Another purpose of the website is to provide a common platform for viewing and sharing views about a variety of projects.

## Getting Started

* Clone the repository
* Create the database and tables
* Open hompeage.php in *localhost*

### Prerequisites

Create the following tables with the respective columns:

* **users** - For all users
```
+------------+-------------+------+-----+---------+----------------+
| Field      | Type        | Null | Key | Default | Extra          |
+------------+-------------+------+-----+---------+----------------+
| user_id    | int(11)     | NO   | PRI | NULL    | auto_increment |
| image      | longblob    | YES  |     | NULL    |                |
| user_name  | varchar(50) | YES  |     | NULL    |                |
| user_email | varchar(50) | YES  |     | NULL    |                |
| user_pass  | varchar(50) | YES  |     | NULL    |                |
| image_name | longblob    | YES  |     | NULL    |                |
+------------+-------------+------+-----+---------+----------------+

```

* **projects** - For all projects
```
+--------------+--------------+------+-----+---------+----------------+
| Field        | Type         | Null | Key | Default | Extra          |
+--------------+--------------+------+-----+---------+----------------+
| project_id   | int(11)      | NO   | PRI | NULL    | auto_increment |
| user_id      | int(11)      | NO   |     | NULL    |                |
| project_name | varchar(100) | YES  |     | NULL    |                |
| short_desc   | varchar(50)  | YES  |     | NULL    |                |
| num_likes    | int(11)      | YES  |     | NULL    |                |
| main_image   | longblob     | YES  |     | NULL    |                |
| long_desc    | varchar(200) | YES  |     | NULL    |                |
+--------------+--------------+------+-----+---------+----------------+
```

* **comments** - For all comments
```
+------------+---------+------+-----+---------+----------------+
| Field      | Type    | Null | Key | Default | Extra          |
+------------+---------+------+-----+---------+----------------+
| comment_id | int(11) | NO   | PRI | NULL    | auto_increment |
| user_id    | int(11) | YES  |     | NULL    |                |
| project_id | int(11) | YES  |     | NULL    |                |
+------------+---------+------+-----+---------+----------------+
```

## Built With

* [HTML5](https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/HTML5) - Website structure
* [CSS3](https://developer.mozilla.org/en/docs/Web/CSS/CSS3) - Website Styles
* [JQUERY](https://jquery.com/) - DOM manipulation
* [BOOTSTRAP](https://v4-alpha.getbootstrap.com/) - Responsive designs
* [PHP7](http://php.net/) - Back end functionality
* [MARIADB](https://mariadb.com/) - Database

## Contributors
* **Hardik Surana** - [Hardik](https://github.com/hardiksurana)
* **Gavrish Prabhu** - [Gavrish](https://github.com/Gavrish)
* **Gurunandan N** - [Gurunandan]()
