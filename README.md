Doctrine Extension
==================
BitWeb extension for Doctrine ORM.

###This extension adds the following types to Doctrine:

| Class Name | Description | From version |
|------------|-------------|--------------|
| ```BitWeb\DoctrineExtension\Type\FileType``` | Adds the ability to save files. Filename is saved to database and file itself to filesystem. | 1.0.0 |
| ```BitWeb\DoctrineExtension\Entity\SoftDeletable``` | Adds the ability to "softly" delete data from database. The row itself is not deleted from database, but ```BitWeb\DoctrineExtension\Entity\SoftDeletable::onDelete()``` function is run to mark the entity deleted. | 1.0.0 |
