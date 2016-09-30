# crmapp
Study code of Web Application Development with Yii 2 and PHP [eBook]
--------------------------------------------------------------------

After clone the repository in your htdocs, update composer dependency whit:
	
	>composer.phar update

then configure database (config/db.php) and execute migration:

	>./yii migrate

Manually, for example with route crmapp/web/customer-records/create insert almost 
one master record and with route crmapp/web/phone/create, crmapp/web/address/create
and crmapp/web/email/create one or more detail record. It's possible use acceptance 
tests for the insertion of records.

N.B: In the file changelog.txt there are evolution of study referring to versions.