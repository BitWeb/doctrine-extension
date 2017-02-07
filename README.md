Doctrine Extension
==================
BitWeb extension for Doctrine ORM.

#### This extension adds the following types to Doctrine:

| Class Name | Description | From version |
|------------|-------------|--------------|
| ```BitWeb\DoctrineExtension\Type\FileType``` | Adds the ability to save files. Filename is saved to database and file itself to filesystem. | 1.0.0 |
| ```BitWeb\DoctrineExtension\Entity\SoftDeletable``` | Adds the ability to "softly" delete data from database. The row itself is not deleted from database, but ```SoftDeletable::onDelete()``` function is called to mark the entity deleted. | 1.0.0 |


#### The following listeners are added:
| Class Name | Description | From version |
|------------|-------------|--------------|
| ```BitWeb\DoctrineExtension\Listener\IpListener``` | Automatically adds IP address to the specified column. | 1.0.0 |
| ```BitWeb\DoctrineExtension\Listener\UserAgentListener``` | Automatically adds user agent data to the specified column. | 1.0.0 |
